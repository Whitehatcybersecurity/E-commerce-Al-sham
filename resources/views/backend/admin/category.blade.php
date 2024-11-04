@extends('backend.layouts.admin_main_master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1" id="heading">Category</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('categorystore') }}" name="category" enctype="multipart/form-data" 
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="hdCategoryId" id="hdCategoryId">
                                        <input type="hidden" name="hdCategoryImage" id="hdCategoryImage">
                                    <div class="row gy-4">
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" name="txtCategoryName"
                                                    placeholder="category name" id="txtCategoryName" required>
                                            </div>
                                            <span class="error"></span>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="labelInput" class="form-label">Category Image</label>
                                                <input type="file" class="form-control" name="fileCategoryImage"
                                                    id="fileCategoryImage">
                                            </div>
                                            <div class="img mt-2">
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" id="previewImage" width="100"
                                                    height="100">
                                            </div>
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
                            <h4 class="card-title mb-0 flex-grow-1">Category List</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="card-datatable table-responsive pt-0">
                                <table id="tblCategory" class="table">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th>S.No</th>
                                            <th>CATEGORY IMAGE</th>
                                            <th>CATEGORY NAME</th>
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
    <script src="{{ asset('assets/js/backend/category.js') }}"></script>
@endsection
