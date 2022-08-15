@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Update Vendor Details</h3>
                        {{-- 
                        <h6 class="font-weight-normal mb-0">Update Admin Password</h6>
                        --}}
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- https://www.youtube.com/watch?v=9l8YuyPjAUg&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=22 --}}
        @if ($slug == 'personal') {{-- $slug was passed from AdminController to view (using compact() method) --}}
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Personal Information</h4>


                            {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
                            {{-- https://www.youtube.com/watch?v=oAZKXYrkcr4&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=17 --}}
                            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                            @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif



                            {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    {{-- Check 17:38 in https://www.youtube.com/watch?v=ydubcZC3Hbw&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=18 --}}
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{-- <strong>Error:</strong> {{ Session::get('error_message') }} --}}

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif



                            {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                            {{-- https://www.youtube.com/watch?v=oAZKXYrkcr4&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=17 --}}
                            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                            @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                

                            {{-- https://www.youtube.com/watch?v=ydubcZC3Hbw&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=18 --}}
                            <form class="forms-sample" action="{{ url('/admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data"> @csrf <!-- Using the enctype="multipart/form-data" to allow uploading files (images). Check 2:39 in https://www.youtube.com/watch?v=dvVbp4poGfQ&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=19 -->
                                <div class="form-group">
                                    <label>Vendor Username/Email</label>
                                    <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly> <!-- Check updateAdminPassword() method in AdminController.php -->
                                </div>
                                <div class="form-group">
                                    <label for="vendor_name">Name</label>
                                    <input type="text" class="form-control" id="vendor_name" placeholder="Enter Name" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}" required> {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_address">Address</label>
                                    <input type="text" class="form-control" id="vendor_address" placeholder="Enter Address" name="vendor_address" value="{{ $vendorDetails['address'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_city">City</label>
                                    <input type="text" class="form-control" id="vendor_city" placeholder="Enter City" name="vendor_city" value="{{ $vendorDetails['city'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_state">State</label>
                                    <input type="text" class="form-control" id="vendor_state" placeholder="Enter State" name="vendor_state" value="{{ $vendorDetails['state'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_country">Country</label>
                                    <input type="text" class="form-control" id="vendor_country" placeholder="Enter Country" name="vendor_country" value="{{ $vendorDetails['country'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_pincode">Pincode</label>
                                    <input type="text" class="form-control" id="vendor_pincode" placeholder="Enter Pincode" name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Mobile</label>
                                    <input type="text" class="form-control" id="vendor_mobile" placeholder="Enter 10 Digit Mobile Number" name="vendor_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="10" minlength="10" required>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_image">Vendor Photo</label>
                                    <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                    {{-- Show the admin image if exists: Check 14:34 in https://www.youtube.com/watch?v=dvVbp4poGfQ&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=19 --}}
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href="{{ url('/admin/images/photos/' . Auth::guard('admin')->user()->image) }}">View Image</a> <!-- We used    target="_blank"    to open the image in another separate page -->
                                        <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}"> <!-- to send the current admin image url all the time with all the requests -->
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($slug == 'business') {{-- https://www.youtube.com/watch?v=YSHTdW4GaeI&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=23 --}}
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Vendor Business Information</h4>


                        {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
                        {{-- https://www.youtube.com/watch?v=oAZKXYrkcr4&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=17 --}}
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    {{-- Check 17:38 in https://www.youtube.com/watch?v=ydubcZC3Hbw&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=18 --}}
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{-- <strong>Error:</strong> {{ Session::get('error_message') }} --}}

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                        {{-- https://www.youtube.com/watch?v=oAZKXYrkcr4&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=17 --}}
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
            

                        {{-- https://www.youtube.com/watch?v=ydubcZC3Hbw&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=18 --}}
                        <form class="forms-sample" action="{{ url('/admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data"> @csrf <!-- Using the enctype="multipart/form-data" to allow uploading files (images). Check 2:39 in https://www.youtube.com/watch?v=dvVbp4poGfQ&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=19 -->
                            <div class="form-group">
                                <label>Vendor Username/Email</label>
                                <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly> <!-- Check updateAdminPassword() method in AdminController.php -->
                            </div>
                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input type="text" class="form-control" id="shop_name" placeholder="Enter Shop Name" name="shop_name" value="{{ $vendorDetails['shop_name'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Address</label>
                                <input type="text" class="form-control" id="shop_address" placeholder="Enter Shop Address" name="shop_address" value="{{ $vendorDetails['shop_address'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Shop City</label>
                                <input type="text" class="form-control" id="shop_city" placeholder="Enter Shop City" name="shop_city" value="{{ $vendorDetails['shop_city'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="shop_state">Shop State</label>
                                <input type="text" class="form-control" id="shop_state" placeholder="Enter Shop State" name="shop_state" value="{{ $vendorDetails['shop_state'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Shop Country</label>
                                <input type="text" class="form-control" id="shop_country" placeholder="Enter Shop Country" name="shop_country" value="{{ $vendorDetails['shop_country'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Shop Pincode</label>
                                <input type="text" class="form-control" id="shop_pincode" placeholder="Enter Shop Pincode" name="shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Shop Mobile</label>
                                <input type="text" class="form-control" id="shop_mobile" placeholder="Enter 10 Digit Shop Mobile Number" name="shop_mobile" value="{{ $vendorDetails['shop_mobile'] }}" maxlength="10" minlength="10" required>
                            </div>
                            <div class="form-group">
                                <label for="business_license_number">Business License Number</label>
                                <input type="text" class="form-control" id="business_license_number" placeholder="Enter Business License Number" name="business_license_number" value="{{ $vendorDetails['business_license_number'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="gst_number">GST Number</label>
                                <input type="text" class="form-control" id="gst_number" placeholder="Enter GST Number" name="gst_number" value="{{ $vendorDetails['gst_number'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="pan_number">PAN Number</label>
                                <input type="text" class="form-control" id="pan_number" placeholder="Enter PAN Number" name="pan_number" value="{{ $vendorDetails['pan_number'] }}" required> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="address_proof">Shop Address Proof</label>
                                <select class="form-control" name="address_proof" id="address_proof">
                                    <option value="Passport" @if($vendorDetails['address_proof'] == 'Passport') selected @endif>Passport</option>
                                    <option value="Voting Card" @if($vendorDetails['address_proof'] == 'Voting Card') selected @endif>Voting Card</option>
                                    <option value="PAN" @if($vendorDetails['address_proof'] == 'PAN') selected @endif>PAN</option>
                                    <option value="Driving License" @if($vendorDetails['address_proof'] == 'Driving License') selected @endif>Driving License</option>
                                    <option value="Aadhar card" @if($vendorDetails['address_proof'] == 'Aadhar card') selected @endif>Aadhar Card</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address_proof_image">Address Proof Image</label>
                                <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                                {{-- Show the admin image if exists: Check 14:34 in https://www.youtube.com/watch?v=dvVbp4poGfQ&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=19 --}}
                                @if (!empty($vendorDetails['address_proof_image']))
                                    <a target="_blank" href="{{ url('/admin/images/proofs/' . $vendorDetails['address_proof_image']) }}">View Image</a> <!-- We used    target="_blank"    to open the image in another separate page -->
                                    <input type="hidden" name="current_address_proof" value="{{ $vendorDetails['address_proof_image'] }}"> <!-- to send the current admin image url all the time with all the requests -->
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($slug == 'bank')

        @endif



    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection