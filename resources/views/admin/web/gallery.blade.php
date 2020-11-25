@extends('admin.layouts.master')
@section('title','Admin - Dashboard')
@section('style')
@endsection
@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="image-tab" data-toggle="tab" href="#image_tab" role="tab" aria-controls="home" aria-selected="true">Image</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video_tab" role="tab" aria-controls="profile" aria-selected="false">Video</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="image_tab" role="tabpanel" aria-labelledby="image-tab">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"></h1>
                    <a href="#add_image" id="image_add" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus-square fa-sm text-white mr-1"></i>Image</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($galleries[0]))
                            @foreach($galleries as $gallery)
                                @if($gallery->type == IMAGE)
                                    <tr>
                                        <th><img src="{{asset(GALLERY_IMAGE_PATH.$gallery->image)}}" width="50" height="50"></th>
                                        <td>{{$gallery->title}}</td>
                                        <td>{{$gallery->description}}</td>
                                        <td class="text-center">
                                            <span><a href="#add_image" data-id="{{$gallery->id}}" data-toggle="modal" id="edit_image" class="edit_image"><i class="fas fa-edit btn btn-primary"></i></a></span>
                                            <span class="ml-2"><a href="#delete_image" data-toggle="modal" class="delete_image" onclick="executeToastr('{{IMAGE}}','{{$gallery->id}}')">
                                            <i class="fas fa-trash-alt btn btn-danger"></i></a></span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="add_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('saveGallery')}}" method="post" enctype="multipart/form-data" id="gallery_image_form">
                                    @csrf
                                    <input type="hidden" value="{{IMAGE}}" name="type">
                                    <div class="form-group">
                                        <label for="title" class="col-form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-form-label">Image</label>
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
            <div class="tab-pane fade" id="video_tab" role="tabpanel" aria-labelledby="video-tab">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"></h1>
                    <a href="#add_video" data-toggle="modal" id="video_add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus-square fa-sm text-white mr-1"></i>Video</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Video</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($galleries[0]))
                            @foreach($galleries as $gallery)
                                @if($gallery->type == VIDEO)
                                    <tr>
                                        <th>
                                            <iframe height="100px" width="100px"
                                                    src="{{$gallery->link}}">
                                            </iframe>
                                        <td>{{$gallery->title}}</td>
                                        <td>{{$gallery->description}}</td>
                                        <td class="text-center">
                                            <span><a href="#add_video" data-id="{{$gallery->id}}" data-toggle="modal" id="edit_video" class="edit_video"><i class="fas fa-edit btn btn-primary"></i></a></span>
                                            <span class="ml-2"><a href="#delete_video" data-toggle="modal" class="delete_video" onclick="executeToastr('{{VIDEO}}','{{$gallery->id}}')">
                                            <i class="fas fa-trash-alt btn btn-danger"></i></a></span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="add_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('saveGallery')}}" method="post" enctype="multipart/form-data" id="gallery_video_form">
                                    @csrf
                                    <input type="hidden" value="{{VIDEO}}" name="type">
                                    <div class="form-group">
                                        <label for="title" class="col-form-label">Title</label>
                                        <input type="text" class="form-control" id="video_title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description</label>
                                        <input type="text" class="form-control" id="video_description" name="description">
                                    </div>
                                    <div class="form-group">
                                        <label for="link" class="col-form-label">Video</label>
                                        <input type="url" class="form-control" id="link" name="link" required>
                                    </div>

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
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var _URL = window.URL || window.webkitURL;

            //add image
            $("#image_add").on('click', function () {
                $(".modal-title").text('Add Image');
            });

            //add image
            $("#video_add").on('click', function () {
                $(".modal-title").text('Add Video');
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

            //edit image
            $(".edit_image").on('click', function () {
                var id = $(this).data('id');
                $(".modal-title").text('Edit Image');
                $.ajax({
                    url: '{{route('editGalleryImage')}}',
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
                        $("#title").val(data.gallery.title);
                        $("#description").val(data.gallery.description);
                        $("#image_preview").removeClass('hidden').html(data.image);
                        $("#gallery_image_form").append('<input type="hidden" value="' + data.gallery.id + '" name="edit_gallery_image">');
                        $('#image').removeAttr('required');
                    }
                });
            });

            //edit video
            $(".edit_video").on('click', function () {
                var id = $(this).data('id');
                $(".modal-title").text('Edit Video');
                $.ajax({
                    url: '{{route('editGalleryVideo')}}',
                    method: "POST",
                    dataType: 'JSON',
                    data:{
                        id:id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function (data) {
                        $("#video_title").val(data.video.title);
                        $("#video_description").val(data.video.description);
                        $("#link").val(data.video.link);
                        $("#gallery_video_form").append('<input type="hidden" value="' + data.video.id + '" name="edit_gallery_video">');
                    }
                });
            });
        });
    </script>
    <script>
        function executeToastr(type, id) {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
            }).then((result) => {
                if (result.value) {
                    if (type == '{{IMAGE}}'){
                        window.location = 'delete-gallery_image/'+id;
                    }
                    if (type == '{{VIDEO}}'){
                        window.location = 'delete-gallery_video/'+id;
                    }
                }
            })
        }
    </script>
@endsection