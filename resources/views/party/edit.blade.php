@extends('layout.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid" style="color:#fff;">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title font-weight-bold text-uppercase" style="color:black;"> Edit Party </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Start Form  -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(to right, #00e5ff, #2196f3); color:#fff;">
                <div class="card-body">
                    
                    <!--Include alert file-->
                    @include('include.alert')

                    <h4 class="header-title text-uppercase" style="color:#fff;"> Basic Info</h4>
                    <hr style="border-color:#fff;">
                    <form class="needs-validation" method="post" action="{{ route('update-party', $party->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="party_type" style="color:#fff;">Type</label>
                                    <select name="party_type" id="party_type" required class="form-control border-bottom">
                                        <option value="">Please select</option>
                                        <option value="GOLD_USER" {{ (old('party_type', $party->party_type) == 'GOLD_USER') ? 'selected' : '' }}>Gold User</option>
                                        <option value="SILVER_USER" {{ (old('party_type', $party->party_type) == 'SILVER_USER') ? 'selected' : '' }}>Silver User</option>
                                        <option value="GENERAL_USER" {{ (old('party_type', $party->party_type) == 'GENERAL_USER') ? 'selected' : '' }}>General User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="full_name" style="color:#fff;">Full Name</label>
                                    <input type="text" required value="{{ old('full_name', $party->full_name) }}" name="full_name" id="full_name" class="form-control border-bottom" placeholder="Enter client's full name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="phone_no" style="color:#fff;">Phone/Mobile Number</label>
                                    <input type="text" value="{{ old('phone_no', $party->phone_no) }}" name="phone_no" id="phone_no" class="form-control border-bottom" placeholder="Enter phone/mobile number" required>
                                    <div class="invalid-feedback">
                                        Please provide a Number.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="address" style="color:#fff;">Address</label>
                                    <input type="text" name="address" value="{{ old('address', $party->address) }}" id="address" class="form-control border-bottom" placeholder="Enter Address" required>
                                </div>
                            </div>
                        </div>

                        <h4 class="header-title text-uppercase" style="color:#fff;">Bank Details</h4>
                        <hr style="border-color:#fff;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="account_holder_name" style="color:#fff;">Account Holder Name</label>
                                    <input type="text" name="account_holder_name" value="{{ old('account_holder_name', $party->account_holder_name) }}" id="account_holder_name" class="form-control border-bottom" placeholder="Enter Account Holder Name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="account_no" style="color:#fff;">Account Number</label>
                                    <input type="text" name="account_no" value="{{ old('account_no', $party->account_no) }}" id="account_no" class="form-control border-bottom" placeholder="Enter Account Number" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="bank_name" style="color:#fff;">Bank Name</label>
                                    <input type="text" name="bank_name" value="{{ old('bank_name', $party->bank_name) }}" id="bank_name" class="form-control border-bottom" placeholder="Enter Bank Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="unique_code" style="color:#fff;">Unique Code</label>
                                    <input type="text" name="unique_code" value="{{ old('unique_code', $party->unique_code) }}" id="unique_code" class="form-control border-bottom" placeholder="Enter Unique Code" required>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="branch_address" style="color:#fff;">Branch Address</label>
                                    <input type="text" name="branch_address" value="{{ old('branch_address', $party->branch_address) }}" id="branch_address" class="form-control border-bottom" placeholder="Enter Branch Address" required>
                                </div>
                            </div>
                        </div>

                        <br>

                        <button class="btn btn-dark" type="submit">Update</button>
                        <a href="{{ route('manage-parties') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
