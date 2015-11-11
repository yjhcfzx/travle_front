<div id="container">
    <h1><?php  echo $items['name']; ?></h1>
    <?php include __DIR__ . '/../../templates/user_nav.php'?>
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
                  'travle_time': $('#travle_time1').val(),
                  'title': $('#title').val(),
                
            };
            
            $.ajax({
		async:false,
		url: "../ajax",
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