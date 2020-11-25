@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Client</h1>
            <a href="#add_client" id="slider" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus-square fa-sm text-white mr-1"></i>Client</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Reviews</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($clients[0]))
                    @foreach($clients as $client)
                        <tr>
                            <th><img src="{{asset(CLIENT_IMAGE_PATH.$client->image)}}" width="50" height="50"></th>
                            <td>{{$client->name}}</td>
                            <td>{{$client->designation}}</td>
                            <td>{{$client->reviews}}</td>
                            <td class="text-center">
                                <span><a href="#add_client" data-id="{{$client->id}}" data-toggle="modal" id="edit" class="edit"><i class="fas fa-edit btn btn-primary"></i></a></span>
                                <span class="ml-2"><a href="#delete" data-toggle="modal" class="delete" onclick="executeToastr('{{$client->id}}')">
                                            <i class="fas fa-trash-alt btn btn-danger"></i></a></span>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="modal fade bd-example-modal-lg" id="add_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('saveClient')}}" method="post" enctype="multipart/form-data" id="client_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="designation" class="col-form-label">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="review" class="col-form-label">Review</label>
                                <textarea class="form-control" id="review" name="reviews"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label required">Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
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
            var _URL = window.URL || window.webkitURL;

            {{--$("#image").change(function (e) {--}}
            {{--var file, img;--}}
            {{--if ((file = this.files[0])) {--}}
            {{--img = new Image();--}}
            {{--// img.onload = function () {--}}
            {{--//     alert(this.width + " " + this.height);--}}
            {{--// };--}}
            {{--var width = this.width;--}}
            {{--var height = this.height;--}}
            {{--img.src = _URL.createObjectURL(file);--}}
            {{--if(width != '{{SLIDER_IMAGE_WIDTH}}' && height != '{{SLIDER_IMAGE_HEIGHT}}'){--}}
            {{--cropImage('image', width, height, img.src );--}}
            {{--}--}}
            {{--}--}}
            {{--});--}}

            //add slider
            $("#slider").on('click', function () {
                $(".modal-title").text('Add Slider');
            });

            //image preview
            $("#image").on('change', function () {
                var file;
                var value = $(this).val();
                if ((file = this.files[0])){
                    img = new Image();
                    img.src = _URL.createObjectURL(file);
                    $("#image_preview").removeClass('hidden').html('<img src="'+ img.src +'" height="50px" width="50px">');
                }
            });

            //edit slider
            $(".edit").on('click', function () {
                var id = $(this).data('id');
                $(".modal-title").text('Edit Client');
                $.ajax({
                    url: '{{route('editClient')}}',
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
                        $("#name").val(data.client.name);
                        $("#designation").val(data.client.designation);
                        $("#review").val(data.client.reviews);
                        $("#image_preview").html(data.image);
                        $("#client_form").append('<input type="hidden" value="' + data.client.id + '" name="edit_client">');
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
                    window.location = 'delete-client/'+id;
                }
            })
        }
    </script>
@endsection