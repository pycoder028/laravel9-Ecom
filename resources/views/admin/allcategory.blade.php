@extends('admin.layouts.template')

@section('page_title')
    All Category | Single Ecom
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Categories</h4>
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">Available Categories</h5>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Subcategory</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->subcategory_count }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ route('editcategory', $category->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('deletecategory', $category->id) }}" class="btn btn-sm btn-warning" onclick="confirmation(event)">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
