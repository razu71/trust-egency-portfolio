
function FILE_UPLOAD() {
    var _URL = window.URL || window.webkitURL;
    $("#image_file").change(function (e) {
        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            // img.onload = function () {
            //     alert(this.width + " " + this.height);
            // };
            var width = this.width;
            var height = this.height;

            var max_width = $(this).data('max_width');
            var max_height = $(this).data('max_height');

            img.src = _URL.createObjectURL(file);

            if(width !== max_width || height !== max_height){
                cropImage('image', max_width, max_height, img.src );
            }
        }
    });

    function cropImage(id, width, height, src) {

        var image = document.getElementById('image_tag');
        var cropBoxData;
        var canvasData;
        var cropper;
    
        $("#image_tag").attr('src',src);
    
        setTimeout(function(){
            cropper = new Cropper(image, {  
                dragMode: 'move',
                aspectRatio: width / height,
                autoCropArea: 0.5,
                restore: false,
                guides: false,
                center: false,
                highlight: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                toggleDragModeOnDblclick: false,
                minContainerWidth:466,
                minContainerHeight:400,
                ready: function () {
                    //Should set crop box data first here
                    croppable = true;
                    // cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                }
            });
        },1000)
    
    
    
        $('#image_modal').modal('show', function () {
    
            
        }).on('hidden.bs.modal', function () {
            cropBoxData = cropper.getCropBoxData();
            canvasData = cropper.getCanvasData();
            cropper.destroy();
        });
    }
    
    $(document.body).on('click','#crop_button',function() {
        var images = document.querySelectorAll('#image_tag');
        var length = images.length;

        var max_img_height = $("#image_file").data('max_height');
        var max_img_width = $("#image_file").data('max_width');;
    
        for (var i = 0; i < length; i++) {
            data_uri = images[i].cropper.getCroppedCanvas({
                width: max_img_width,
                height: max_img_height,
                fillColor: '#fff',
            }).toDataURL('image/jpeg');
            
            $('.image_input').val(data_uri);
            $('.image_result').html('<br /><div class="img-thumbnail" style="width: 120px;" ><img src="'+data_uri+'" style="width: 100px;" /></div>');

            $('#image_modal').modal('hide');

        }
    });
}