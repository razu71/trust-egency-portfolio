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

  #preview_contentid {
    width: 8.833333333cm; height: 21cm; float: left; border: 1px dashed #ddd; margin-right: 5px;
  }
  #preview_canvas {  width: 8.833333333cm; height: 21cm; }
</style>

@endsection

@section('content')

<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">
    {{($type == 1) ? 'Front' : 'Back'}} Page {{$page_no}} Design
  </h1>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-4">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#image" role="tab" aria-controls="image"
                aria-selected="true">Image</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#background" role="tab" aria-controls="background"
                aria-selected="false">Background</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#text" role="tab" aria-controls="text"
                aria-selected="false">Text</a>
            </li>
          </ul>
          <div class="tab-content" style="padding: 5px; border: 1px solid #ddd;border-top-width: 0;">
            <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="home-tab">
              <div class="row">
                @for ($i = 0; $i < 4; $i++) <div class="col-sm-3">
                  <div class="img_click">
                    <img src="{{asset('img.jpg')}}" style="width: 100%" class="img-thumbnail rounded" alt="">
                  </div>
              </div>
              @endfor
            </div>
          </div>
          <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              @for ($i = 1; $i <= 4; $i++) <div class="col-sm-3">
                <div class="bg_click">
                  <img src="{{asset('bg'.$i.'.jpg')}}" style="width: 100%;height: 100px" class="img-thumbnail rounded"
                    alt="">
                </div>
            </div>
            @endfor
          </div>
        </div>
        <div class="tab-pane fade" id="text" role="tabpanel" aria-labelledby="contact-tab">
          <textarea id="leaflet_text"></textarea>
          <br>
          <button type="type" class="btn btn-primary float-right" id="text_click">Add Text</button>
          <div class="clearix"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div id="preview_contentid">
        @if(!empty($page_content))
          {!! $page_content->page_content !!}
        @else
          <div id="preview_canvas" class="ui-widget-header">
          </div>
        @endif
      </div>
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="set_page">Set</button>
    </div>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Width</label>
              <input type="number" id="img_width">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Height</label>
              <input type="number" id="img_height">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Border</label>
              <input type="number" id="img_border">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Border Color</label>
              <input type="text" id="img_border_color">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Radius</label>
              <input type="number" id="img_radius">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="set_style">Set</button>
      </div>
    </div>
  </div>
</div>

<form action="{{route('getLeafletPageSave')}}" id="page_form" method="post">
  @csrf
  <input type="hidden" name="page_no" id="page_no" value="{{$page_no}}">
  <textarea name="page_content" style="display: none;" id="page_content"></textarea>
  <input type="hidden" name="edit_id" value="{{encrypt($leaflet->id)}}">
  @if(!empty($page_content))
  <input type="hidden" name="edit_id" value="{{encrypt($page_content->id)}}">
  @endif
</form>
@endsection

@section('script')

<script src='{{asset('admin/tinymce')}}/tinymce.min.js' referrerpolicy="origin"></script>
<script>
    
var inlineTinymce = {
  selector: 'textarea#leaflet_text',
  height: 250,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'formatselect | ' +
  ' bold italic backcolor | alignleft aligncenter ' +
  ' alignright alignjustify | bullist numlist outdent indent |' +
  ' removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ]
};

tinymce.init(inlineTinymce);
</script>
<script>
  $(document.body).on('click','#set_page',function(){
  $(this).prop('disabled',true);
  var page_id = $(this).val();
  var page_html = $('#preview_contentid').html();

  page_html.replace('leaflet_content','');

  $('#page_content').val(page_html);

  setTimeout(function () {
    $('#page_form').submit();  
  },100);
  
  //$('#preview_contentid_'+page_id).html(page_html);
});

$(document.body).on('click','.leaflet_page',function(){
  var page_id = $(this).data('id');

  $('#set_page').val(page_id);
});


$(document.body).on('click','.bg_click',function(){
  var img_src = $(this).find('img').attr('src');

  var change_css = {
    'background-image': 'url(' + img_src + ')',
    'background-repeat': 'no-repeat',
    'background-size': 'cover',
    'background-position': 'center',
  };

  $('#preview_contentid').find('#preview_canvas').css(change_css);
});

// text click
$(document.body).on('click','#text_click',function(){
  var create_html = tinymce.get('leaflet_text').getContent();
  console.log(create_html);

  create_html = '<div class="leaflet_content draggable ui-widget-content ui-draggable ui-draggable-handle">'+create_html+'</div>';

  $('#preview_contentid').find('#preview_canvas').append(create_html);
  
  tinymce.init(inlineTinymce);
  runDraggble();
});  

// image click
$(document.body).on('click','.img_click',function(){
  var img_src = $(this).find('img').attr('src');

  var uuid = uuidv4();

  var editor = '<div class="edit_div">';
      editor += '<i data-toggle="modal" data-target="#edit_modal" data-class="'+uuid+'" class="edit_img fas fa-edit"></i>';
      editor += '<i class="remove_img fas fa-times"></i>';
      editor += '</div>';

  var create_html = '';
  create_html = '<div class="img_content leaflet_content draggable ui-widget-content ui-draggable ui-draggable-handle" style="position: absolute;">';
  create_html += editor;
  create_html += '<img src="'+img_src+'" class="'+uuid+'" style="width: 100px;" />';
  create_html += '</div>';

  $('#preview_contentid').find('#preview_canvas').append(create_html);

  runDraggble();
});

// edit image
$(document.body).on('click','.edit_img',function() {
  var img_class = $(this).data('class');

  $('#img_width').addClass(img_class+'_width');
  $('#img_height').addClass(img_class+'_height');
  $('#set_style').data('class',img_class);

});
$(document.body).on('click','#set_style',function() {
  var img_class = $(this).data('class');

  var img_width = $('.'+img_class+'_width').val();
  var img_height = $('.'+img_class+'_height').val();
  var img_border = $('.'+img_class+'_border').val();
  var img_radius = $('.'+img_class+'_radius').val();
  var img_border_color = $('.'+img_class+'_border_color').val();

  if(typeof img_width == 'undefined') img_width = '';
  if(typeof img_height == 'undefined') img_height = '';
  if(typeof img_border == 'undefined') img_border = '';
  if(typeof img_radius == 'undefined') img_radius = '';
  if(typeof img_border_color == 'undefined') img_border_color = '';

  var style = {
    "width": img_width+'px'
  , "height": img_height+'px' 
  , "border-width": img_border+'px' 
  , "border-redius": img_radius+'px' 
  , "border-color": 'green' 
  };

  console.log(style);

  $('.'+img_class).css(style);

  $('#edit_modal').modal('hide');
});

$(document.body).on('click','.remove_img',function() {
  $(this).closest('.leaflet_content').remove();
});

// $( ".ui-widget-header" ).contextmenu(function() {
//     $(this).append('<div class="tinymce-body"></div>');
// });

</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  runDraggble();
  function runDraggble() {
    $( ".leaflet_content" ).draggable({ grid: [ 1, 1 ] }); 
  }

  function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
  }

</script>

@endsection