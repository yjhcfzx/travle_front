<div id="container">
    <h1><?php  echo $items['title']; ?></h1>
     <h2><?php  if(isset($items['destination'])){
         foreach($items['destination'] as $dest){
             echo $dest['name'] , ' ';
         }
     } ?></h2>
    
    <h2><?php  if(isset($items['special_events'])){
         foreach($items['special_events'] as $event){
             echo $event['name'] , ' ';
         }
     } ?></h2>
     <h3><?php  echo $items['author'] , ' ' , $items['created_at']  ; ?></h3>
     <pre>
         <?php  echo $items['content']; ?>
     </pre>
     
     <h3><?php echo $this->lang->line('comment'); ?></h3>
     <?php if($comments): foreach($comments as $comment):?>
    <div class="list-item panel panel-warning">
	            <div class="panel-heading"><?php echo $comment['author'];?> <?php echo $comment['created_at'];?></div>
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class=" col-md-12 col-sm-12 col-xs-12 list-main">
					    	<?php echo isset($comment['content']) ? strip_tags($comment['content']) : ''; ?> 	 
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer"><?php //echo $this->lang->line('reply'); ?></div>
	       </div>
     <?php  endforeach; endif;?>
     <div id="comment-section">
          <form method="post">
            <div class="form-group">
                <label  for="comment"><?php echo $this->lang->line('post_comment'); ?>  </label>
                 <textarea cols="80" id="comment" name="comment" rows="10" class='form-control'>place holder 1</textarea>

            </div>
            <input type="submit" name="submit" value="<?php echo $this->lang->line('submit'); ?>" id="save" class="save" />
          </form>
     </div>

</div>

<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/chosen.css">
<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/datepicker.css">
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/datepicker.js"></script>
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/chosen.js"></script>
 <script src="<?php echo $this->config->item( 'base_theme_url');?>js/ckeditor/ckeditor.js"></script>


<script>
    $(document).ready(function(){
      
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