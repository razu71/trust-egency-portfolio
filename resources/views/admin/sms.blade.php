@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SMS</h1>
            <a href="#send_sms" id="slider" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus-square fa-sm text-white mr-1"></i>Send SMS</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Receiver</th>
                    <th scope="col">Message</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($messages[0]))
                    @foreach($messages as $sms)
                        <tr>
                            <td>{{$sms->to}}</td>
                            <td>{{$sms->message}}</td>
                            <td class="text-center">
                                <span class="ml-2"><a href="#delete" data-toggle="modal" class="delete" onclick="executeToastr('{{$sms->id}}')">
                                            <i class="fas fa-trash-alt btn btn-danger"></i></a></span>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="send_sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('sendSms')}}" method="post" enctype="multipart/form-data" id="slider_form">
                            @csrf
                            <div class="form-group">
                                <label for="to" class="col-form-label">To</label>
                                <input type="text" class="form-control" id="to" name="to" required>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-form-label">Message</label>
                                <textarea type="text" rows="5" class="form-control" id="message" name="message" required></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Send</button>
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
                    window.location = 'delete-sms/'+id;
                }
            })
        }
    </script>
@endsection