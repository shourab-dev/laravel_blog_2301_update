@extends('layouts.backendLayout')


@section('backend')

<div class="container">

    <div class="card">
        <div class="card-header">Add Post</div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-3">
                    <input name="title" type="text" class="form-control" placeholder="Post Title">
                </div>
                <div class="my-3">
                    <input name="featuredImg" type="file" class="form-control">
                </div>

                <div class="row my-3">

                    <div class="col-lg-6">
                        <select name="category" class="form-control categorySelect">
                            <option disabled selected>Select Category</option>
                            @foreach ($categories as $category)

                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <select name="subcategory" class="form-control subcategorySelect">
                            <option disabled selected>Select Category First</option>
                        </select>
                    </div>

                </div>


                <div class="my-3">
                    <textarea id="editor" name="conent" placeholder="Content Goes Here..."></textarea>
                </div>

                <button class="btn btn-primary">Submit</button>



            </form>
        </div>
    </div>


</div>


@push('customJs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
    console.error( error );
    } );
</script>

<script>
    function getSubcategory() {
       
        $.ajax({

            url: `{{ route('subcategory.get') }}`,
            method: 'GET',
            data: {
                categoryId: $(this).val()
            },
            success: function (res){
                
                //* RES DATA ARRAY
                let options = []
                
                if (res.length == 0) {
                    let optionTag = `<option disabled selected>No subcategory found</option>`
                $('.subcategorySelect').html(optionTag)
                return false;
                }

                res.forEach(subcategory => {
                  
                    let optionTag = `<option value="${subcategory.id}">${subcategory.title}</option>`
                    options.push(optionTag)

                })

                $('.subcategorySelect').html(options)

            }


        })

    }

   $('.categorySelect').change(getSubcategory)


</script>

@endpush




@endsection