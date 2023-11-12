@extends('layouts.backendLayout')


@section('backend')

<div class="container">

    <div class="row">


        <div class="col-lg-8">

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                @forelse ($categories as $key=>$category)

                <tr>
                    <td>{{ $categories->firstItem() + $key}}</td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a href="{{ route('category.edit', $category->slug) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm deleteBtn">Delete</a>
                        <form action="{{ route('category.delete', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No Data Found!</td>
                </tr>
                @endforelse
            </table>
            <div>
                {{ $categories->links() }}
            </div>


        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">{{ $editCategory ? "Edit" : "Add" }} Category</div>
                <div class="card-body">
                    <form
                        action="{{ $editCategory ? route('category.update', $editCategory->slug) : route('category.store') }}"
                        method="POST">
                        @csrf
                        @if ($editCategory)
                        @method('PUT')
                            
                        @endif
                        <input value="{{ $editCategory ? $editCategory->title : "" }}" name="title" type="text"
                            class="form-control my-2" placeholder="Category">
                        <button class="btn btn-primary">{{ $editCategory ? "Update" : "Add" }} Category</button>
                    </form>
                </div>
            </div>
        </div>


    </div>


</div>


@push('customJs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $('.deleteBtn').click(function () {


    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        
        $(this).next('form').submit()

    }
    })


   } )
</script>
@endpush




@endsection