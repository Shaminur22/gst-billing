@extends('layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title font-weight-bold"> CREATE BILL </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--Include alert file-->
                    @include('include.alert')

                    <h4 class="header-title text-uppercase">Invoice Basic Info</h4>
                    <hr>
                    <form action="{{ route('create-gst-bill') }}" method="post">
                        @csrf
                        <div class="row">



                            <div class="form-group mb-3">
                                <label>Select Party ID</label>
                                <select class="form-control border-bottom" required name="party_id" id="partyIdDropdown">
                                    <option value="">Please select Party ID</option>
                                    @foreach($parties as $party)
                                        <option value="{{ $party->id }}">{{ $party->id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Invoice Date</label>
                                    <input type="date" required name="invoice_date" class="form-control border-bottom" id="validationCustom02">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Invoice Number</label>
                                    <input type="text" required value="{{ $invoice_no }}" name="invoice_no" class="form-control border-bottom" id="validationCustom02" placeholder="Enter Invoice number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="header-title text-uppercase">Item Details</h4>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 border p-1 text-center">
                                <b>DESCRIPTIONS</b>
                            </div>
                            <div class="col-md-3 border p-1 text-center">
                                <b>TOTAL AMOUNT</b>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 border p-2">
                                <input class="form-control" required name="item_description" placeholder="Enter description" />
                            </div>
                            <div class="col-md-3 border p-2">
                                <input class="form-control" required type="number" name="total_amount" id="totalAmountInput" placeholder="Enter BDT amount" oninput="calculateNetAmount()">
                            </div>

                        </div>

                        <div class="row mt-0">
                            <div class="col-md-3">
                                <label>VAT (%)</label>
                                <input type="number" class="form-control border-bottom" placeholder="VAT Rate" name="cgst_rate" id="cgst" oninput="calculateNetAmount()">
                                <span class="float-right gststyle" id="cgstDisplay">0</span>
                                <input type="hidden" id="cgstAmount" name="cgst_amount" value="0">
                            </div>

                            <div class="col-md-3">
                                <label>SDT (%)</label>
                                <input type="number" class="form-control border-bottom" placeholder="SDT Rate" name="sgst_rate" id="sgst" oninput="calculateNetAmount()">
                                <span class="float-right gststyle" id="sgstDisplay">0</span>
                                <input type="hidden" id="sgstAmount" name="sgst_amount" value="0">
                            </div>

                            <div class="col-md-3">
                                <label>CDT (%)</label>
                                <input type="number" class="form-control border-bottom" placeholder="CDT Rate" name="igst_rate" id="igst" oninput="calculateNetAmount()">
                                <span class="float-right gststyle" id="igstDisplay">0</span>
                                <input type="hidden" id="igstAmount" name="igst_amount" value="0">
                            </div>

                            <div class="col-md-3">
                                <ul style="list-style: none;float: right;">
                                    <li>
                                        <b>Total Amount:</b> ৳ <span id="totalAmountDisplay"> 0</span>
                                    </li>
                                    <li>
                                        <b>Tax:</b> ৳ <span id="taxDisplay">0</span>
                                        <input type="hidden" value="0" name="tax_amount" id="taxAmount">
                                    </li>
                                    <li>
                                        <b>Net Amount:</b> ৳ <span id="netAmountDisplay">0</span>
                                        <input type="hidden" value="0" name="net_amount" id="netAmount">
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="declaration" class="form-control border-bottom" id="validationCustom05" placeholder="Declaration">
                                </div>

                                <button type="submit" class="btn btn-primary float-right mb-2">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Script for GST Calculation and Party Type Filter -->
<script>
    // Filter party dropdown by type
    document.getElementById('partyTypeFilter').addEventListener('change', function () {
        let selectedType = this.value;
        let partyOptions = document.querySelectorAll('#partyDropdown option');

        partyOptions.forEach(option => {
            if (option.value === "") return; // skip placeholder

            if (!selectedType || option.dataset.type === selectedType) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        });

        document.getElementById('partyDropdown').value = ""; // reset selection
    });

    // GST Calculation function
    function calculateNetAmount() {
        let total = parseFloat(document.getElementById('totalAmountInput').value) || 0;
        let cgstRate = parseFloat(document.getElementById('cgst').value) || 0;
        let sgstRate = parseFloat(document.getElementById('sgst').value) || 0;
        let igstRate = parseFloat(document.getElementById('igst').value) || 0;

        let cgstAmount = total * (cgstRate / 100);
        let sgstAmount = total * (sgstRate / 100);
        let igstAmount = total * (igstRate / 100);

        let totalTax = cgstAmount + sgstAmount + igstAmount;
        let netAmount = total + totalTax;

        // Update displays
        document.getElementById('cgstDisplay').innerText = cgstAmount.toFixed(2);
        document.getElementById('sgstDisplay').innerText = sgstAmount.toFixed(2);
        document.getElementById('igstDisplay').innerText = igstAmount.toFixed(2);
        document.getElementById('totalAmountDisplay').innerText = total.toFixed(2);
        document.getElementById('taxDisplay').innerText = totalTax.toFixed(2);
        document.getElementById('netAmountDisplay').innerText = netAmount.toFixed(2);

        // Hidden inputs for form submit
        document.getElementById('cgstAmount').value = cgstAmount.toFixed(2);
        document.getElementById('sgstAmount').value = sgstAmount.toFixed(2);
        document.getElementById('igstAmount').value = igstAmount.toFixed(2);
        document.getElementById('taxAmount').value = totalTax.toFixed(2);
        document.getElementById('netAmount').value = netAmount.toFixed(2);
    }
</script>
@endsection
