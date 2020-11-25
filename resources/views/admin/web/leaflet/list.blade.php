@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('style')


@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
      <div class="row">
        <div class="col-sm-6">
            {{$title}}
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{route('getLeafletAdd')}}" class="btn btn-primary btn-sm">Add New</a>
        </div>
      </div>      
    </h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
       <div class="card-body">
         <div class="table-responsive">
            <table id="items-table" class="table table-bordered">
                <thead>
                   <tr>
                      <th>Name</th>
                      <th style="width: 120px;">Action</th>
                   </tr>
                </thead>
             </table>
         </div>
       </div>
    </div>
</div>
@endsection

@section('script')

<script>
   $(function () {
        $('#items-table').DataTable({
            processing:true,
            serverSide:true,
            pageLength:10,
            bLengthChange:true,
            responsive: true,
            order:[1,'desc'],
            autoWidth:false,
            ajax: '{{route('getLeaflet')}}',
            columns: [
                {data: 'name'},
                {data: 'actions', orderable: false, searchable: false}
            ]
        });
    });
</script>


@endsection