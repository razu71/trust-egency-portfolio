<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Admin')</title>
    <!-- favicons -->
    <link rel="shortcut icon" href="{{asset(FAVICON_IMAGE_PATH.setting('favicon'))}}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/font/fonts.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/css/cropper.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('admin')}}/css/jquery.dataTables.min.css">
    @yield('style')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <?php
                            $contacts = \App\Model\Contact::where('is_read', UNREAD)->take(5)->get();
                        ?>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                @if($contacts->count() > 0)
                                <span class="badge badge-danger badge-counter">{{$contacts->count()}}</span>
                                @endif
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                @if(!empty($contacts[0]))
                                @foreach($contacts as $contact)
                                <a class="dropdown-item d-flex align-items-center contact_read" href="#"
                                    data-id="{{$contact->id}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div><span class="text-primary">{{$contact->email}}</span> wants to contact with
                                            you.</div>
                                        <div class="small text-gray-500">{{date_format($contact->created_at,'d-m-y')}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset(PROFILE_IMAGE_PATH.\Illuminate\Support\Facades\Auth::user()->image)}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item profile_uodate" href="#profile" data-toggle="modal"
                                    data-id="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#logoutModal" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{setting('company_name')}} {{setting('year')}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure want to logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="profile" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="profile_name" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="profile_email" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone" class="col-form-label">Phone</label>
                                <input type="text" class="form-control" id="profile_phone" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="col-form-label">Password <span class="text-danger">(Keep
                                        blank for same password)</span></label>
                                <input type="text" class="form-control" id="profile_password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label required">Profile Picture</label>
                            <input type="file" class="form-control" id="image" name="image">
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

    {{--image crop modal--}}
    <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Cropper</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image_tag" style="width: 100%;" src="" alt="Picture">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="crop_button">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

    <script src="{{asset('admin/js/cropper.min.js')}}"></script>

    <script src="{{asset('admin/js/sweetalert2.js')}}"></script>
    <script src="{{asset('admin')}}/js/jquery.dataTables.min.js"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script> --}}

    @yield('script')

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(!empty(Session::get('success')))
            Toast.fire({
                icon: 'success',
                title: '{{Session::get('success')}}'
            });
        @elseif(!empty(Session::get('error')))
            Toast.fire({
                icon: 'error',
                title: '{{Session::get('error')}}'
            });
        @elseif(!empty(Session::get('warning')))
            Toast.fire({
                icon: 'warning',
                title: '{{Session::get('warning')}}'
            });

        @elseif(!empty(Session::get('info')))
            Toast.fire({
                icon: 'info',
                title: '{{Session::get('info')}}'
            });
        @endif
    </script>
    <script src="{{asset('admin')}}/js/file-upload.js"></script>
    <script>
        FILE_UPLOAD();
    //edit profile
    $(".profile_uodate").on('click', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '{{route('editProfile')}}',
            method: "POST",
            dataType: 'JSON',
            data:{
                id:id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (data) {
                console.log(data.profile);
                $("#profile_name").val(data.profile.name);
                $("#profile_email").val(data.profile.email);
                $("#profile_phone").val(data.profile.phone);
                $("#profile_password").val(data.profile.password);
                $("#image_preview").html(data.image);
            }
        });
    });

    //read notification
    $(".contact_read").on('click', function () {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('readContact')}}",
            method: "POST",
            dataType: "JSON",
            data: {
                id : id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (data) {
                Toast.fire({
                    icon: 'success'
                });
            }
        });
    });

    </script>

</body>

</html>