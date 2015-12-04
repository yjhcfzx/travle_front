<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_generate_controller'))
{
    function my_generate_controller($contoller , $param = array())
    {
        $CI =& get_instance();
        $class = 'form-control  required';
        $attribute = isset($contoller['attribute']) ? $contoller['attribute'] : array();
        $option = isset($contoller['option']) ? $contoller['option'] : array();
        if(isset($attribute['class'])){
            $class .= ' ' . $attribute['class'];
        }
        $input_wrapper_class = isset($attribute['input_wrapper_class']) ? $attribute['input_wrapper_class'] : '';
        
    	$label = $contoller['label'];
        $name = $contoller['name'];
        $html = '<div class="form-group">';
        $html .=    '<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><label class="control-label" for="' . $name . '">' . $CI->lang->line($label) .  '</label></div>';
        $html .=  ' <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 ' . $input_wrapper_class . '">';
        
        switch($contoller['type']){
            case 'text':
                $element_html = ' <input class="' . $class . '"  name= "title" id="' . $name . '" />';
                break;
            case 'select':
                $multiple = (isset( $attribute['multiple']) && $attribute['multiple'] ) ? TRUE : FALSE;
            $element_html =   '<select ' .  ($multiple ? ' multiple="multiple" ' : '')  . 
                    ' data-placeholder="' . ( isset( $attribute['placeholder']) ? $CI->lang->line($attribute['placeholder']) : $CI->lang->line('choose_or_create') ) . '..."  class="' . $class . ' chzn-select"  name= "' . ($multiple ? $name . '[]' : $name ) . '" id="' . $name . '" >';
           $element_html .= ' <option value=""></option>';
           if(isset($attribute['options']) && $attribute['options']){
               foreach($attribute['options'] as $key=>$value){
                $element_html .= "<option value='{$key}'>{$value}</option>";
            }
           }

         $element_html .= '</select>';
                break;
        }
        $html .= $element_html;
        if(isset($option['after'])){
            $html .= $option['after'];
        }
        $html .=  '</div><div class="clear"></div></div>';
        return $html;
       
    }   
}