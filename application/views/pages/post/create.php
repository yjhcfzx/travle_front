<div id="container">
  <h1><?php echo $this->lang->line('create_post'); ?></h1>
  <form method="post">
      <?php echo my_generate_controller(array('name'=>'title','label'=>'title','type'=>'text'));?>
      <?php 
        $options = array();
        if(!isset($destination['error'])){ foreach($destination as $item){
            $options[$item['id']] = $item['name'];
            }}
      echo my_generate_controller(array('name'=>'destination','label'=>'destination','type'=>'select',
          'attribute'=>array('multiple'=>TRUE,
              'placeholder'=>'choose_or_create',
              'options'=>$options
              )));?>
       <?php echo my_generate_controller(array('name'=>'travle_time','label'=>'travle_time','type'=>'text',
          'attribute'=>array('input_wrapper_class'=>'date '),//input-group
          'option'=>array(
           //   'after'=>' <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>'
          )));?>
<!--       <div class="form-group">
                <label for="dtp_input2" class="control-label"><?php echo $this->lang->line('travle_time'); ?></label>
                <div class="input-group date form_date" id="travle_time" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="travle_time1" size="16" type="text" value="" >
		    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
			<input type="hidden" id="travle_time2" value="" /><br/>	
            </div>-->
      <?php 
        $options = array();
        if(!isset($event['error'])){ foreach($event as $item){
            $options[$item['id']] = $item['name'];
            }}
      echo my_generate_controller(array('name'=>'special_event','label'=>'special_event','type'=>'select',
          'attribute'=>array('multiple'=>TRUE,
              'placeholder'=>'choose_or_create',
              'options'=>$options
              )));?>
   
   <textarea cols="80" id="content" name="content" rows="10">place holder 1</textarea>
   <div class="form-group">
        <!-- Button -->
        <div class="controls">
            <input type="submit" name="submit" value="<?php echo $this->lang->line('submit'); ?>" id="save" class="save" />
        </div>
   </div>
  </form>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/chosen.css">
<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/datepicker.css">
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/datepicker.js"></script>
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/chosen.js"></script>
 <script src="<?php echo $this->config->item( 'base_theme_url');?>js/ckeditor/ckeditor.js"></script>


<script>
    $(document).ready(function(){
        $('#save').click(function(event ){
            event.preventDefault();
            var request = {
                'content': editor.getData(),
                 'special_event': $('#special_event').val() ? $('#special_event').val().join(',') : '',
                 'destination': $('#destination').val() ? $('#destination').val().join(',') : '',
                  'travle_time': $('#travle_time').val(),
                  'title': $('#title').val(),
                
            };
            
            $.ajax({
		async:false,
		url: "<?php echo $this->config->item('base_url');?>ajax",
		type: "POST",
		data: { 'url': '<?php echo $router;?>/detail/format/json' ,
			'method': 'POST',
                        'request':request
                    },
		dataType: "json"
		}).done(function(data){
			if(!data)
				return false;
			
			});
        });
       $('.chzn-select').chosen({
            create_option: true,
             persistent_create_option: true,
    
         skip_no_results: true
       });
      
       
         $('#travle_time').datetimepicker({
        language:  'ch',
        weekStart: 1,
        todayBtn:  1,
        format: 'yyyy-mm-dd',
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
      //<![CDATA[

				// This call can be placed at any point after the
				// <textarea>, or inside a <head><script> in a
				// window.onload event handler.

				// Replace the <textarea id="editor"> with an CKEditor
				// instance, using default configurations.
		var editor =		CKEDITOR.replace( 'content',
                {
                    language : 'zh-cn',
                    filebrowserBrowseUrl :'<?php echo $this->config->item('base_theme_url');?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $this->config->item( "ckeditor_connector_url");?>',
                    filebrowserImageBrowseUrl : '<?php echo $this->config->item('base_theme_url');?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $this->config->item( "ckeditor_connector_url");?>',
                    filebrowserFlashBrowseUrl :'<?php echo $this->config->item('base_theme_url');?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $this->config->item( "ckeditor_connector_url");?>',
					filebrowserUploadUrl  :'<?php echo $this->config->item( "ckeditor_upload_url");?>?Type=File',
					filebrowserImageUploadUrl : '<?php echo $this->config->item( "ckeditor_upload_url");?>?Type=Image',
					filebrowserFlashUploadUrl : '<?php echo $this->config->item( "ckeditor_upload_url");?>?Type=Flash'
				});

			//]]>
    });
    </script>