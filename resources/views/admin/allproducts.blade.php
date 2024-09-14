@extends('admin.layouts.template')

@section('page_title')
All Products | Single Ecom
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Product</h4>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">Available All Product</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>10</td>
                            <td>Watch</td>
                            <td></td>
                            <td>55</td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">Edit</a>
                                <a href="" class="btn btn-sm btn-warning">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection