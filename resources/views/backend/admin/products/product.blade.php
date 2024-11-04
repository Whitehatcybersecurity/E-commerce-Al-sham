@extends('backend.layouts.admin_main_master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1" id="heading">Product</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('productstore') }}" name="product" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="hidden" name="hdProductId" id="hdProductId">
                                    <input type="hidden" name="hdProductImage" id="hdProductImage">
                                    <div class="row gy-4">
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" name="txtProductName"
                                                    placeholder="Product name" id="txtProductName" required>
                                            </div>
                                            <span class="error"></span>
                                        </div>

                                        <div class="col-xxl-3 col-md-6">
                                                <label for="basiInput" class="form-label">Category</label>
                                                <select class="form-control form-select"  name="ddlCategory"
                                                    id="ddlCategory" title="Please select Category" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error"></span>
                                        </div>

                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Product Price</label>
                                                <input type="text" class="form-control" id="txtProductPrice" name="txtProductPrice"
                                                    placeholder="Product price" id="txtProductPrice" required>
                                            </div>
                                            <span class="error"></span>
                                        </div>

                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Brand</label>
                                                <select class="form-control form-select"  name="ddlBrand"
                                                    id="ddlBrand" title="Please select Brand" required>
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brand as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="error"></span>
                                        </div>

                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Product discount</label>
                                                <input type="text" class="form-control" name="txtProductDiscount" id="txtProductDiscount"
                                                    placeholder="Product discount" id="txtProductDiscount" required>
                                            </div>
                                            <span class="error"></span>
                                        </div>

                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="labelInput" class="form-label">Product Image</label>
                                                <input type="file" class="form-control" name="fileProductImage"
                                                    id="fileProductImage">
                                            </div>
                                            <div class="img mt-2">
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" id="previewImage"
                                                    width="100" height="100">
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-xxl-3 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Product Short Description <span class="text-danger">*</span>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="text-muted mb-2">Add short description for product</p>
                                                    <textarea class="form-control" id="txtShortDescription" name="txtShortDescription"
                                                        placeholder="Enter Product Short Description" title="Enter Product Short Description" rows="3">
                                                        {{ old('txtShortDescription') }}
                                                    </textarea>
                                                </div>
                                                <!-- end card body -->
                                        </div>
                                        <!--end col-->

                                        <div class="col-xxl-3 col-md-6">
                                            <button type="submit" id="btnSave"
                                                class="btn btn-success waves-effect waves-light">Add</button>
                                        </div>
                                        <!--end col-->

                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Product List</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="card-datatable table-responsive pt-0">
                                <table id="tblProduct" class="table">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th>S.No</th>
                                            <th>PRODUCT IMAGE</th>
                                            <th>PRODUCT NAME</th>
                                            <th>PRODUCT DESCRIPTION</th>
                                            <th>PRODUCT PRICE</th>
                                            <th>PRODUCT CATEGORY</th>
                                            <th>PRODUCT BRAND</th>
                                            <th>PRODUCT DISCOUNT</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('footer')
    <script src="{{ asset('assets/js/backend/product.js') }}"></script>
@endsection
