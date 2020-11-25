@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Contact</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($contacts[0]))
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->subject}}</td>
                            <td>{{$contact->message}}</td>
                            <td class="text-center">
                                <span class="ml-2"><a href="#delete" data-toggle="modal" class="delete" onclick="executeToastr('{{$contact->id}}')">
                                            <i class="fas fa-trash-alt btn btn-danger"></i></a></span>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
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
                    window.location = 'delete-contact/'+id;
                }
            })
        }
    </script>
@endsection