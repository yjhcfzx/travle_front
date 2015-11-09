<style>
    .list-item:hover{
        cursor:pointer;
        cursor:hand;
        
    }
</style>
<div class="container-fluid">
    <div id='popular'>
        <h2><?php echo $this->lang->line('resource'), $this->lang->line('list') ; ?></h2>
    </div>
	    <div class='product-list'>
	    <?php 
	    if(isset($error)){
	    	//var_dump($error);
	    }
            else if(!$items){
                
            }
	    else{
	    foreach($items as $product): 
                $imgOfText = NULL;
                if($product['content']){
                $doc = new DOMDocument();
                $doc->loadHTML($product['content']);
                $img = $doc->getElementsByTagName('img')->item(0);
                if($img){$imgOfText = $img->getAttribute('src');}}?>
	       <div class="list-item panel panel-warning" onclick='javascript:window.location.href = "<?php echo  $this->config->item('base_url');?>resource/detail/<?php echo$product['id']; ?>";'>
	            <div class="panel-heading"><?php echo $product['title']?></div>
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class=" col-md-4 col-sm-4 col-xs-4">

                                        <?php if($imgOfText){ echo "<img class='thumbnail-img' src='{$imgOfText}' />";}?>
                                        </div>
				    	<div class=" col-md-8 col-sm-8 col-xs-8 list-main">
					    	 
					    	  <div class = 'row address'>
						    	  	<div class=" col-md-2 col-sm-3 col-xs-4">
						    	  		<span class="label label-primary">
						    	  			<span class="glyphicon glyphicon-road"></span><?php echo $this->lang->line('abstract'); ?>
						    	  		</span>
						    	  	</div>
					    			<div class=" col-md-10 col-sm-9 col-xs-8 ">
					    				<?php echo isset($product['content']) ? strip_tags($product['content']) : ''; ?>
					    			</div>
					    	  </div>
					    	  <div class = 'row tag'>
						    	  	<div class=" col-md-2 col-sm-3 col-xs-4">
						    	  		<span class="label label-primary">
						    	  			<span class="glyphicon glyphicon-tag"></span>标签
						    	  		</span>
						    	  	</div>
					    			<div class=" col-md-10 col-sm-9 col-xs-8 ">
					    				<?php echo isset($product['tag']) ? $product['tag'] : '';?>
					    			</div>
					    	  </div>
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer"> <?php echo $product['created_at'];?></div>
	       </div>
	       <?php endforeach;}?>
                
               <div id="template_content" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('create'), $this->lang->line('resource'); ?></h4>
            </div>
            <div class="modal-body">
              
               <div id='template-content' style='height:85%;'>
                    <form method="post">
                            <div class="form-group">
                                <label class="control-label " for="agent"><?php echo $this->lang->line('title'); ?>  </label>
                                <input class="form-control required"  name= "title" id="title" />

                            </div>
                            <div class="form-group">
                                <label class="control-label" for="destination"><?php echo $this->lang->line('destination'); ?>  </label>
                                <select  multiple="multiple" data-placeholder="<?php echo $this->lang->line('choose_or_create'); ?>..."  class="form-control chzn-select                                    required"  name= "destination[]" id="destination" >
                                  <option value=""></option>
                                  <?php if(!isset($destination['error'])){ foreach($destination as $item){
                                      echo "<option value='{$item['id']}'>{$item['name']}</option>";
                                  }}?>


                                </select>

                            </div>
                           
                         <textarea cols="80" id="content" name="content" rows="10">place holder 1</textarea>
                       
                        </form>
                </div>
                  </div>
            <div class="modal-footer">
            
            	<button id='save-button' type="button" class="btn btn-primary"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('save'); ?></button>
                <button id='copy-button_text' type="button" class="btn btn-primary hidden"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('copyword'); ?></button>
               	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
            </div>
        </div>
    </div>
</div> 
                <button id='create-button' type="button" class="btn btn-primary"><i class="icon-white"></i> <?php echo $this->lang->line('create'); ?></button>
	    </div>
    </div>

<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/chosen.css">
<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/datepicker.css">
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/datepicker.js"></script>
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/chosen.js"></script>
 <script src="<?php echo $this->config->item( 'base_theme_url');?>js/ckeditor/ckeditor.js"></script>
 <script>
    $(document).ready(function(){
        $('#template_content').on('shown.bs.modal', function () {
  $('.chzn-select', this).chosen('destroy').chosen({
            create_option: true,
             persistent_create_option: true,
    
         skip_no_results: true
       });
});
        $('#create-button').click(function(){
            $("#template_content").modal('show');
            
      
        });
        $('#save-button').click(function(event ){
            event.preventDefault();
            var request = {
                'content': editor.getData(),
                 'destination': $('#destination').val() ? $('#destination').val().join(',') : '',
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
<script>
$('.list-item').hover(function(){
    $(this).removeClass('panel-warning').addClass('panel-primary');
}, function(){
      $(this).removeClass('panel-primary').addClass('panel-warning');
});
    </script>