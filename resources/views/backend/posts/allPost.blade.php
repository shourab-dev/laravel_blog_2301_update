@extends('layouts.backendLayout')


@section('backend')

<div class="container">

   <table class="table">
    <tr>
        <td>#</td>
        <td>Post Title</td>
        <td>Popular</td>
    </tr>
    @foreach ($posts as $post)
        <tr>
            <td>#</td>
            <td>{{ $post->title }}</td>
            <td>
                <span class="text-warning">
                    <i class="fa-{{ $post->is_popular == 1 ? "solid" : "regular" }} fa-star"></i>
                </span>
            </td>
        </tr>
    @endforeach
    
   </table>

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