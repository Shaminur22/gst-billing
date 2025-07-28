@extends('layout.app')

@section('content')
<div class="content-page" style="color:#fff;">
    <div class="row">
        <div class="col">
            <div class="page-title-box">
                <h2 class="page-title font-weight-bold text-uppercase" style="color:black;">Manage Clients</h2>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background: linear-gradient(to right, #00e5ff, #2196f3); color:#fff;">
                <!-- Add Client Button -->
                <a href="{{ route('add-party') }}" class="btn btn-sm btn-dark waves-effect waves-light float-right">
                    <i class="mdi mdi-plus-circle"></i> Add Client
                </a>

                <!-- Alert messages -->
                @include('include.alert')

                <h4 class="header-title mb-4 text-uppercase" style="color:#fff;">Manage Clients</h4>

                <!-- Search and Length -->
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-10">
                        <div class="dataTables_length">
                            <label style="color:#fff;">Show
                                <select class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="dataTables_filter">
                            <label style="color:#fff;">Search:
                                <input type="search" class="form-control form-control-sm" placeholder="">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Clients Table -->
                <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100 table-bordered" style="color:#fff;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Client Type</th>
                            <th>Client Info</th>
                            <th>Created On</th>
                            <th class="hidden-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($parties))
                            @foreach($parties as $party)
                            <tr>
                                <td><b>#{{ $party->id }}</b></td>
                                <td>
                                    <span class="badge badge-light">{{ $party->party_type }}</span>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        <li><b>Name :</b> {{ $party->full_name }}</li>
                                        <li><b>Phone/Email :</b> {{ $party->phone_no }}</li>
                                        <li><b>Address :</b> {{ $party->address }}</li>
                                        <li><b>Unique Code :</b> {{ $party->ifsc_code }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <span class="badge badge-light">{{ $party->created_at->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <a href="javascript:void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm"
                                           data-toggle="dropdown" aria-expanded="false">
                                           <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- Details button (Modal) -->
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#detailsModal{{ $party->id }}">
                                                <i class="mdi mdi-eye mr-2 text-muted font-18 vertical-middle"></i>Details
                                            </a>
                                            <!-- Edit button -->
                                            <a class="dropdown-item" href="{{ route('edit-party', $party->id) }}">
                                                <i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Edit
                                            </a>
                                            <!-- Delete button -->
                                            <form action="{{ route('delete-party', $party) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Details Modal -->
<div class="modal fade" id="detailsModal{{ $party->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $party->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: linear-gradient(to right, #00e5ff, #2196f3); color: #000;">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel{{ $party->id }}">Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Client Type:</strong> {{ $party->party_type }}</li>
                    <li class="list-group-item"><strong>Full Name:</strong> {{ $party->full_name }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $party->phone_no }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $party->address }}</li>
                    <li class="list-group-item"><strong>Account Holder Name:</strong> {{ $party->account_holder_name }}</li>
                    <li class="list-group-item"><strong>Account Number:</strong> {{ $party->account_no }}</li>
                    <li class="list-group-item"><strong>Bank Name:</strong> {{ $party->bank_name }}</li>
                    <li class="list-group-item"><strong>Unique Code:</strong> {{ $party->ifsc_code }}</li>
                    <li class="list-group-item"><strong>Branch Address:</strong> {{ $party->branch_address }}</li>
                    <li class="list-group-item"><strong>Created On:</strong> {{ $party->created_at->format('d/m/Y') }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No clients found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div><!-- end card-box -->
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tickets-table').DataTable({
            "pageLength": 10,
            "ordering": true,
            "searching": true
        });
    });
</script>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(255,255,255,0.2) !important; 
    color: #fff; 
    transition: background-color 0.2s ease-in-out;
}
</style>

@endsection
