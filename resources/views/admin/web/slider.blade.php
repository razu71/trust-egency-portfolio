@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Slider</h1>
            <a href="#add_slider" id="slider" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus-square fa-sm text-white mr-1"></i>Slider</a>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <table id="items-table" class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Main Title</th>
                        <th scope="col">Sub Title One</th>
                        <th scope="col">Sub Title Two</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="modal fade" id="add_slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('saveSlider')}}" method="post" enctype="multipart/form-data" id="slider_form">
                            @csrf
                            <div class="form-group">
                                <label for="main_title" class="col-form-label">Main Title</label>
                                <input type="text" class="form-control" id="main_title" name="main_title" required>
                            </div>
                            <div class="form-group">
                                <label for="sub_title_one" class="col-form-label">Sub Title One</label>
                                <input type="text" class="form-control" id="sub_title_one" name="sub_title_one">
                            </div>
                            <div class="form-group">
                                <label for="sub_title_two" class="col-form-label">Sub Title Two</label>
                                <input type="text" class="form-control" id="sub_title_two" name="sub_title_two">
                            </div>
                            <div class="form-group">
                                
                                {!! fileBtn('slider_image', 'Slider Image', SLIDER_IMAGE_WIDTH, SLIDER_IMAGE_HEIGHT) !!}
                            </div>
                            <span id="image_preview" class="hidden"></span>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {


    

     //add slider
     $("#slider").on('click', function () {
         $(".modal-title").text('Add Slider');
     });

    //image preview
    // $("#image").on('change', function () {
    //     var file;
    //     var value = $(this).val();
    //     if ((file = this.files[0])){
    //         img = new Image();
    //         img.src = _URL.createObjectURL(file);
    //         $("#image_preview").removeClass('hidden').html('<img src="'+ img.src +'" height="50px" width="50px">');
    //     }
    // });

    //edit slider
        $(document.body).on('click',".edit", function () {
            var id = $(this).data('id');
            $(".modal-title").text('Edit Slider');
            $.ajax({
                url: '{{route('editSlider')}}',
                method: "POST",
                dataType: 'JSON',
                data:{
                    id:id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (data) {
                    console.log(data);
                    $("#main_title").val(data.slider.main_title);
                    $("#sub_title_one").val(data.slider.sub_title_one);
                    $("#sub_title_two").val(data.slider.sub_title_two);
                    $("#image_preview").removeClass('hidden').html(data.image);
                    $("#slider_form").append('<input type="hidden" value="' + data.slider.id + '" name="edit_slider">');
                    $('#image').removeAttr('required');
                }
            });
        });

        //delete slider
        $(".delete").on('click', function () {
           var id = $(this).data()
        });
    });
</script>
    <script>
        function executeToastr(id) {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
            }).then((result) => {
                if (result.value) {
                    window.location = 'delete-slider/'+id;
                }
            })
        }

    $(function () {
        $('#items-table').DataTable({
            processing:true,
            serverSide:true,
            pageLength:10,
            bLengthChange:true,
            responsive: true,
            order:[1,'desc'],
            autoWidth:false,
            ajax: '{{route('getSlider')}}',
            columns: [
                {data: 'image'},
                {data: 'main_title'},
                {data: 'sub_title_one'},
                {data: 'sub_title_two'},
                {data: 'actions', orderable: false, searchable: false, "className": "dt-center"}
            ]
        });
    });
    </script>
@endsection