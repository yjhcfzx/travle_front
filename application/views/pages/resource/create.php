<div id="container">
  <h1><?php echo $this->lang->line('create_post'); ?></h1>
  <form method="post">
      <div class="form-group">
          <label class="control-label " for="agent"><?php echo $this->lang->line('title'); ?>  </label>
          <input class="form-control required"  name= "title" id="title" />

      </div>
      <div class="form-group">
          <label class="control-label" for="destination"><?php echo $this->lang->line('destination'); ?>  </label>
          <select  multiple="multiple" data-placeholder="<?php echo $this->lang->line('choose_or_create'); ?>..."  class="form-control chzn-select required"  name= "destination[]" id="destination" >
            <option value=""></option>
            <?php if(!isset($destination['error'])){ foreach($destination as $item){
                echo "<option value='{$item['id']}'>{$item['name']}</option>";
            }}?>
           
        
          </select>

      </div>
       <div class="form-group">
                <label for="dtp_input2" class="control-label"><?php echo $this->lang->line('travle_time'); ?></label>
                <div class="input-group date form_date" id="travle_time" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="travle_time1" size="16" type="text" value="" >
		    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
			<input type="hidden" id="travle_time2" value="" /><br/>	
            </div>
      <div class="form-group">
          <label class="control-label" for="agent"><?php echo $this->lang->line('special_event'); ?>  </label>
          <select  multiple="multiple" data-placeholder="<?php echo $this->lang->line('choose_or_create'); ?>..."  class="form-control required chzn-select"  name= "special_event[]" id="special_event" >
            <option value=""></option>
            <?php if(!isset($event['error'])){     foreach($event as $item){
                echo "<option value='{$item['id']}'>{$item['name']}</option>";
            }}?>
           
        
          </select>

      </div>
   <textarea cols="80" id="content" name="content" rows="10">place holder 1</textarea>
  <input type="submit" name="submit" value="Save" id="save" class="save" />
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
                  'travle_time': $('#travle_time1').val(),
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