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
                                    <label for="validationCustom01" style="color:#fff;">Type</label>
                                    <select name="party_type" required class="form-control border-bottom">
                                        <option value="">Please select</option>
                                        <option value="GOLD_USER" {{ old('party_type')=='GOLD_USER' ? 'selected' : '' }}>Gold User</option>
                                        <option value="SILVER_USER" {{ old('party_type')=='SILVER_USER' ? 'selected' : '' }}>Silver User</option>
                                        <option value="GENERAL_USER" {{ old('party_type')=='GENERAL_USER' ? 'selected' : '' }}>General User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustom01" style="color:#fff;">Full Name</label>
                                    <input type="text" required value="{{ $party->full_name }}" name="full_name" class="form-control border-bottom" id="validationCustom01" placeholder="Enter client's full name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustom02" style="color:#fff;">Phone/Mobile Number</label>
                                    <input type="text" value="{{ $party->phone_no }}" name="phone_no" class="form-control border-bottom" id="validationCustom02" placeholder="Enter phone/mobile number">
                                    <div class="invalid-feedback">
                                        Please provide a Number.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="validationCustom03" style="color:#fff;">Address</label>
                                    <input type="text" name="address" value="{{ $party->address }}" class="form-control border-bottom" id="validationCustom02" placeholder="Enter Address">
                                </div>
                            </div>
                        </div>

                        <h4 class="header-title text-uppercase" style="color:#fff;">Bank Details</h4>
                        <hr style="border-color:#fff;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustom04" style="color:#fff;">Account Holder Name</label>
                                    <input type="text" name="account_holder_name" value="{{ $party->account_holder_name }}" class="form-control border-bottom" id="validationCustom04" placeholder="Enter Accoumt Holder name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustom05" style="color:#fff;">Account Number</label>
                                    <input type="text" name="account_no" value="{{ $party->account_no }}" class="form-control border-bottom" id="validationCustom05" placeholder="Enter Account Number">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustom02" style="color:#fff;">Bank Name</label>
                                    <input type="text" name="bank_name" value="{{ $party->bank_name }}" class="form-control border-bottom" id="validationCustom02" placeholder="Enter Bank Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustom02" style="color:#fff;">UNIQUE Code</label>
                                    <input type="text" name="ifsc_code" value="{{ $party->ifsc_code }}" class="form-control border-bottom" id="validationCustom02" placeholder="Enter IFSC Code">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="validationCustom02" style="color:#fff;">Branch Address</label>
                                    <input type="text" name="branch_address" value="{{ $party->branch_address }}" class="form-control border-bottom" id="validationCustom02" placeholder="Enter Branch Address">
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
