@extends('layout.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid" style="color:#fff;">

    <!-- Company Header -->
<div class="row">
    <div class="col text-center">
        <h1 style="color:#000;">{{ $company->name ?? 'ABC Company' }}</h1>
        <p style="color:#000;">{{ $company->address_line1 ?? 'Address ABC' }}<br>
           <strong>Email:</strong> {{ $company->email ?? 'abc@gmail.com' }}
           | <strong>Web:</strong> {{ $company->website ?? 'www.abc.com' }}
           | <strong>Mob:</strong> {{ $company->phone ?? '******' }}</p>
        <p style="color:#000;"><strong>PAN NO:</strong> {{ $company->pan_no ?? '******' }}
           | <strong>GSTIN NO:</strong> {{ $company->gstin ?? '********' }}</p>
    </div>
</div>


    <!-- GST Invoice Title -->
    <div class="row">
        <div class="col-12 text-center border py-2" 
             style="background: linear-gradient(to right, #00e5ff, #2196f3); color:#fff;">
            <h3 class="m-0">GST INVOICE</h3>
        </div>
    </div>

    <!-- Client & Invoice Details -->
    <div class="row text-center my-3">
        <div class="col-md-6 border p-2" style="background: #f8f9fa; color:#000;">
            <h5 class="border-bottom pb-1 font-weight-bold">Details of the Client | Billed to</h5>
            <p><strong>Name:</strong> {{ optional($bill->party)->full_name }}</p>
            <p><strong>Address:</strong> {{ optional($bill->party)->address }}</p>
            <p><strong>Phone:</strong> {{ optional($bill->party)->phone_no }}</p>
        </div>

        <div class="col-md-6 border p-2" style="background: #f8f9fa; color:#000;">
            <h5 class="border-bottom pb-1 font-weight-bold">Invoice Details</h5>
            <p><strong>Reverse Charge:</strong> No</p>
            <p><strong>Invoice No:</strong> #{{ $bill->invoice_no }}</p>
            <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($bill->invoice_date)->format('d-m-Y') }}</p>
        </div>
    </div>

    <!-- Item Table -->
    <div class="row">
        <div class="col-12 p-0">
            <div class="table-responsive table-bordered">
                <table class="table mb-0">
                    <thead style="background: linear-gradient(to right, #00e5ff, #2196f3); color:#fff;">
                        <tr>
                            <th style="width:8%">SR NO.</th>
                            <th>DESCRIPTION</th>
                            <th style="width:15%" class="text-center">
                                AMOUNT ({{ $currency==='usd' ? 'USD' : 'BDT' }})
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <strong>{{ $bill->item_description }}</strong>
                            </td>
                            <td class="text-center">
                                {{ $currency==='usd' 
                                    ? number_format($bill->total_amount_usd, 2) 
                                    : number_format($bill->total_amount, 2) 
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bank Details & Totals -->
    <div class="row border mt-3" style="background:#f8f9fa; color:#000;">
        <div class="col-lg-9 p-2">
            <div class="p-3 rounded" style="background:#e9f5ff;">
                <h5 class="mb-1"><strong>Branches Details</strong></h5>
                <p>
                    <strong>Branch Name:</strong> <br>
                    <strong>Phone Number:</strong> <br>
                    <strong>Email:</strong> <br>
                    <strong>Branch Location:</strong> 
                </p>
            </div>
        </div>
        <div class="col-lg-3 p-2">
            <ul class="list-unstyled mb-0">
                <li><strong>Total :</strong>
                    <span class="float-right">৳ {{ number_format($bill->total_amount, 2) }}</span>
                </li>
                <li><strong>VAT :</strong>
                    <span class="float-right">৳ {{ number_format($bill->cgst_amount, 2) }}</span>
                </li>
                <li><strong>SDT :</strong>
                    <span class="float-right">৳ {{ number_format($bill->sgst_amount, 2) }}</span>
                </li>
                <li><strong>CDT :</strong>
                    <span class="float-right">৳ {{ number_format($bill->igst_amount, 2) }}</span>
                </li>
                <li><strong>Total Tax :</strong>
                    <span class="float-right">৳ {{ number_format($bill->tax_amount, 2) }}</span>
                </li>
                <li><strong>Grand Total :</strong>
                    <span class="float-right font-weight-bold">৳ {{ number_format($bill->net_amount, 2) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Print Controls -->
    <div class="text-right my-3 d-print-none">
        <button onclick="window.print()" class="btn" 
                style="background: linear-gradient(to right, #00e5ff, #2196f3); color:#fff;">
            <i class="mdi mdi-printer"></i> Print
        </button>
        <a href="{{ route('manage-gst-bills') }}" class="btn btn-secondary">
            <i class="fas fa-list"></i> All Bills
        </a>
    </div>

</div>
@endsection
