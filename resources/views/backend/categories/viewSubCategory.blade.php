@extends('layouts.backendLayout')


@section('backend')

<div class="container">

    <div class="row">


        <div class="col-lg-8">

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                </tr>
                @foreach ($subcategories as $subCategory)
                    <tr>
                        <th>#</th>
                        <th>{{ $subCategory->title }}</th>
                        <th>{{ $subCategory->category->title }}</th>
                    </tr>
                @endforeach
            </table>
          


        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">SubCategory</div>
                <div class="card-body">
                    <form
                        action="{{ route('subcategory.store') }}"
                        method="POST">
                        @csrf
                       
                        <input value="" name="title" type="text"
                            class="form-control my-2" placeholder="Category">
                        <select name="category_id" class="form-control my-3">
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @empty
                                <option disabled selected>No Category Found</option>
                            @endforelse
                        </select>
                        <button class="btn btn-primary">Store SubCategory</button>
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