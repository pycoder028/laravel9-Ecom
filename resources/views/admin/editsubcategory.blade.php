@extends('admin.layouts.template')

@section('page_title')
    Edit Subcategory | Single Ecom
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Subategory</h4>
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Subategory</h5>
                    <small class="text-muted float-end">Input Information</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('updatesubcategory') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $subcategory->id }}" name="subcategory_id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Edit Subategory Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                                    value="{{ $subcategory->subcategory_name }}" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Subategory</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
