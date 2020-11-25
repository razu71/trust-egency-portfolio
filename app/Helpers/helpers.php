<?php

function fileBtn($name, $title, $width, $height)
{
    # code...
    $html = '<div class="file_div">';
    $html .= '<label for="slider_image" class="col-form-label required">'.$title.'</label>';
    $html .= '<input type="file" class="form-control" accept="image/*" data-max_width="'.$width.'" data-max_height="'.$height.'" id="image_file" required>
    <input type="hidden" name="'.$name.'" class="image_input">
    <div class="image_result"></div>';
    $html .= '</div>';

    return $html;
}

function base64FileUpload($new_file, $path, $old_file_name = null)
{
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
        unlink($path . '/' . $old_file_name);
    }

    $pos  = strpos($new_file, ';');
    $type = explode(':', substr($new_file, 0, $pos))[1];
    $type = str_replace('image/','',$type);

    $file_name = uniqid(time()).'.'.$type;


    $imageData = base64_decode(explode(',',$new_file)[1]);
    file_put_contents($path.$file_name, $imageData);

    return $file_name;
}

function fileUpload($new_file, $path, $old_file_name = null)
{
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
        unlink($path . '/' . $old_file_name);
    }
    $input['imagename'] = time() . '.' . $new_file->getClientOriginalExtension();
//    $destinationPath = public_path($path);
    $new_file->move($path, $input['imagename']);

    return $input['imagename'];
}

function removeImage($path, $file_name)
{
    if (isset($file_name) && $file_name != "" && file_exists($path . $file_name)) {
        unlink($path . $file_name);
        return true;
    }
    return false;
}

function setting($slug=null){
    if ($slug == null) {
        $settings = \App\Model\Setting::get();
        if ($settings) {
            $output = [];
            foreach ($settings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } else {
        $settings = \App\Model\Setting::where(['slug' => $slug])->first();
        if ($settings) {
            $output = $settings->value;
            return $output;
        }
        return false;
    }
}