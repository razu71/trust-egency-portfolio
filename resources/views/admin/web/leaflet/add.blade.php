@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('style')
<style>
  .leaflet_content {
    width: auto;
    display: inline-block;
  }

  .edit_div {
    width: 20px;
    padding: 1px;
    position: absolute;
    top: 2px;
    right: -20px;
    z-index: 1;
    background-color: #5a5c69;
    border-radius: 0 2px 2px 0;
    color: #fff;
    font-size: 12px;
    text-align: center;
    display: none;
  }

  .edit_div i {
    display: inline-block;
  }

  .edit_div i:hover {
    color: green;
  }

  .img_content:hover .edit_div {
    display: inline-block;
  }

  .tinymce-body {
    padding: 5px;
  }

  .tox-tinymce-inline {
    z-index: 1600 !important;
  }
</style>

@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">

  </h1>
  @if(!empty($edit_id))
  <form action="{{route('getLeafletPageSave')}}" id="page_form" method="post">
    @csrf
  @endif
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      @if(empty($edit_id))
      <form action="{{route('getLeafletSave')}}" method="post">
        @csrf
          <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <button class="btn btn-primary float-right" type="submit">Save</button>
        </form>
      @else 
      <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" value="{{$leaflet->name}}" class="form-control">
        </div>
      <div class="row">
        <div class="col-sm-12">
            @for ($i = 1; $i <= 3; $i++) 
              <a style="color: #fff;" href="{{route('getLeafletPageAdd',['id'=>encrypt($leaflet->id),'page_no'=>$i, 'type'=> 1])}}" data-id="{{$i}}" class="leaflet_page btn btn-primary">Front Page {{$i}} Design</a>
            @endfor
            @for ($i = 4; $i <= 6; $i++) 
              <a style="color: #fff;" href="{{route('getLeafletPageAdd',['id'=>encrypt($leaflet->id),'page_no'=>$i, 'type'=> 2])}}" data-id="{{$i}}" class="leaflet_page btn btn-primary">Back Page {{$i}} Design</a>
            @endfor
          <iframe onload="resizeIframe(this)" src="{{route('getLeafletAddIframe',['id'=>$edit_id])}}" width="100%" frameborder="0"></iframe>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

@endsection

@section('script')

<script>
  function resizeIframe(iframe) {
    iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
  }
</script>
@endsection