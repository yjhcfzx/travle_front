<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('my_generate_controller')) {

    function my_generate_controller($contoller, $param = array()) {
        $CI = & get_instance();
        $class = 'form-control';
        $type = $contoller['type'];
        $attribute = isset($contoller['attribute']) ? $contoller['attribute'] : array();
        $option = isset($contoller['option']) ? $contoller['option'] : array();
        $value = isset($contoller['value']) ? $contoller['value'] : '';
        if (isset($attribute['class'])) {
            $class .= ' ' . $attribute['class'];
        }

        if (isset($attribute['required'])) {
            $class .= ' ' . $attribute['required'];
        } else {
            $class .= ' required ';
        }

        $input_wrapper_class = isset($attribute['input_wrapper_class']) ? $attribute['input_wrapper_class'] : '';

        $label = $contoller['label'];
        $name = $contoller['name'];
        if ($type == 'textarea') {
            $html = "<label class='control-label'> " . $CI->lang->line($label) . "   </label>
<div class='operations gradient'>
    <button id='{$name}_insert_picture_top' type='button'  unselectable='on' class='btn btn-xs btn-default  image_trigger' aria-label='Left Align'>
        <span class='glyphicon glyphicon-picture'> " . $CI->lang->line('insert_picture') . "
    </button>
</div>
<input type='file' id='{$name}_hidden_file' style='display:none;' />
     
<div id='{$name}' contenteditable='true' class='textarea'>{$value}</div>

<div class='operations gradient'>
    <button id='{$name}_insert_picture_bottom' type='button'   unselectable='on' class='btn btn-xs btn-default  image_trigger' aria-label='Left Align'>
        <span class='glyphicon glyphicon-picture'> " . $CI->lang->line('insert_picture') . "
    </button>
</div>";
            $html .= "<script> $('#{$name}_hidden_file').change(function(){
        readURL(this,'#{$name}', insert_picture);});
    $('#{$name}_insert_picture_top, #{$name}_insert_picture_bottom').click(function(){
         $('#{$name}_hidden_file').trigger('click');
    });</script>";
            return $html;
        } else {
            $html = '<div class="form-group">';
            $html .= '<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><label class="control-label" for="' . $name . '">' . $CI->lang->line($label) . '</label></div>';
            $html .= ' <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 ' . $input_wrapper_class . '">';

            switch ($type) {
                case 'password':
                case 'text':
                    $element_html = ' <input type="' . $type . '" class="' . $class . '"  name= "' . $name . '" id="' . $name . '"  value="' . $value . '" '
                            . '/>';
                    break;
                case 'select':
                    if ($value && !is_array($value)) {
                        $selected = array();
                        $selected[$value] = 1;
                    } else {
                        $selected = $value;
                    }
                    $multiple = (isset($attribute['multiple']) && $attribute['multiple'] ) ? TRUE : FALSE;
                    $element_html = '<select ' . ($multiple ? ' multiple="multiple" ' : '') .
                            ' data-placeholder="' . ( isset($attribute['placeholder']) ?
                                    $CI->lang->line($attribute['placeholder']) : $CI->lang->line('choose_or_create') ) . '..."  class="'
                            . $class . ' chzn-select"  name= "' . ($multiple ? $name . '[]' : $name ) . '" id="' . $name . '" >';
                    $element_html .= ' <option value=""></option>';
                    if (isset($attribute['options']) && $attribute['options']) {
                        foreach ($attribute['options'] as $key => $value) {
                            $element_html .= "<option value='{$key}' " . (isset($selected[$key]) ? ' selected ' : '') . ">{$value}</option>";
                        }
                    }

                    $element_html .= '</select>';
                    break;
            }
            $html .= $element_html;
            if (isset($option['after'])) {
                $html .= $option['after'];
            }
            $html .= '</div><div class="clear"></div></div>';
            return $html;
        }
    }

}


if (!function_exists('my_generate_legend')) {

    function my_generate_legend($name) {
        $CI = & get_instance();
        $html = '';
        $html .= "<div class='legend  orange' id='legend_{$name}'>
        <button  type='button'  class='btn btn-default my-orange' aria-label='Left Align'>
                <span class='glyphicon glyphicon-bookmark'> " . $CI->lang->line($name) .
                " </button>
     </div>";
        return $html;
    }

}


if (!function_exists('my_generate_bread')) {

    function my_generate_bread($inst) {
        $CI = & get_instance();
        $route = $inst->uri->segment(1);
        $method = $inst->uri->segment(2);
        if (!$method) {
            $method = 'index';
        }
        $action = '';
        $url = parse_url($_SERVER['REQUEST_URI']);
        if ($url && isset($url['query'])) {
            parse_str($url['query'], $params);
            if (isset($params['action'])) {
                $action = $params['action'];
            }
        }
        $html = ' <ol class="breadcrumb">
        <li><a href="' . $CI->config->item('base_url') . '">' . $CI->lang->line('home') . '</a></li>';
        if ($method == 'index') {
            $html .= '   <li class="active">' . $CI->lang->line($route . '_list') . '</li>';
        } else {
            $seg = $inst->uri->segment(3);
            $html .= '<li><a href="' . $CI->config->item('base_url') . $route . '">' . $CI->lang->line($route . '_list') . '</a></li>';
            if ($action == 'edit') {
                $html .= '<li><a href="' . $CI->config->item('base_url') . $route . '/' . $method . ($seg ? '/' . $seg : '') . '">' . $CI->lang->line($route . '_' . $method) . '</a></li>';
                $html .= '   <li class="active">' . $CI->lang->line($route . '_' . $action) . '</li>';
            } else {
                $html .= '   <li class="active">' . $CI->lang->line($route . '_' . $method) . '</li>';
            }
        }
        $html .= '</ol>';
        return $html;
    }

}

if (!function_exists('my_generate_post_meta')) {

    function my_generate_post_meta($post) {
         $CI = & get_instance();
        $html = '<span style="margin-left:0px;" class="you-glyphicon glyphicon glyphicon-user"></span>' .
                ' <a href="' . $CI->config->item('base_url') . 'user/detail/' . $post['uid'] . '">' . $post['author'] . '</a><span  class="you-glyphicon glyphicon glyphicon-pencil"></span>' . $post['created_at'] ;
        $dests = '';
        if(isset($post['destination'])){
            if(is_array($post['destination'])){
                 foreach($post['destination'] as $dest){
                   $dests .= $dest['name'] . ' ';
                }
            }
            else{
                $dests = $post['destination'];
            }
            if($dests){
             $html .=   "<span class='you-glyphicon glyphicon glyphicon-plane'></span>" .
                $dests;
            }
        
     } 
               
        return $html;
    }

}