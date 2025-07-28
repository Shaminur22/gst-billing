@extends('layout.app')

@section('content')
<div class="container-fluid" style="color:#fff;">

    <!-- Page Title -->
    <h2 class="mt-4 mb-3 font-weight-bold" style="color:black;">
        Manage Bills
    </h2>

    <!-- Add New Bill Button -->
    <a href="{{ route('add-gst-bill') }}" 
       class="btn mb-3" 
       style="background: black; color:#fff;">
        <i class="mdi mdi-plus"></i> New Bill
    </a>

    <!-- Bills Table -->
    <table id="bill-table" class="table table-bordered table-hover" 
           style="background: linear-gradient(to right, #00e5ff, #2196f3); color:#fff;">
        <thead>
            <tr style="color:#fff;">
                <th>Sr No</th>
                <th>Invoice No</th>
                <th>Client’s Info</th>
                <th>Billing Info</th>
                <th>Invoice Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $i => $bill)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>#{{ $bill->invoice_no }}</td>

                <td>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Name:</strong>
                            {{ optional($bill->party)->full_name ?? '—' }}
                        </li>
                        <li><strong>Phone:</strong>
                            {{ optional($bill->party)->phone_no ?? '—' }}
                        </li>
                    </ul>
                </td>

                <td>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Total:</strong> ৳{{ $bill->total_amount }}</li>
                        <li><strong>Tax:</strong> ৳{{ $bill->tax_amount }}</li>
                        <li><strong>Net:</strong> ৳{{ $bill->net_amount }}</li>
                    </ul>
                </td>

                <td>{{ \Carbon\Carbon::parse($bill->invoice_date)->format('d-m-Y') }}</td>

                <td>
                    <div class="btn-group">
                        <a href="{{ route('delete', ['gst_bills', $bill->id]) }}"
                           onclick="return confirm('Delete this bill?')"
                           class="btn btn-sm btn-danger">Delete</a>
                        <a href="{{ route('print-gst-bill', $bill->id) }}"
                           class="btn btn-sm btn-secondary">Print</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- DataTables Script --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(function(){
        $('#bill-table').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true
        });
    });
</script>

<style>
/* Hover effect for table rows */
.table-hover tbody tr:hover {
    background-color: #d3ddebff !important;
    color: black;
    transition: background-color 0.2s ease-in-out;
}

/* Gradient button hover */
.btn:hover {
    opacity: 0.9;
    transform: scale(1.02);
    transition: 0.2s ease-in-out;
}
</style>
@endsection
