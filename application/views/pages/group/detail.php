<div id="container">
    <div class="banner-container">
    <?php if($main_image):?>
    <img class='banner-img' src="<?php echo $this->config->item( 'base_upload_url')  , $main_image;?>" />
    <div class="title-overlay hidden-sm hidden-xs"></div>
    <?php endif;?>
    <h1 class='title hidden-sm hidden-xs <?php  if($main_image){echo ' overlay ';}?>'><?php  echo $items['title'];?></h1>
    <h1 class='title hidden-md hidden-lg'><?php  echo $items['title'];?></h1>
    </div><!--close banner container-->
    <div class="you_section">
       <?php echo my_generate_post_meta($items);?>
     
    <div class="you-row"> 
        <?php if($is_author){ echo "<span style='margin-right:5px;position:relative;top:2px;' class='glyphicon glyphicon-edit'></span><a href='?action=edit'>" . 
            $this->lang->line('edit'). "</a>";}?>
    </div>
     </div>

    <?php  if(isset($items['special_events'])){?>
 <div class='fieldset'>
    <?php echo my_generate_legend('special_event');?>
     <div class="you-row">
     <?php 
         foreach($items['special_events'] as $event){
             echo  $event['name'] , ' ';
         }
     ?>
     </div>
    </div>
    <?php  } ?>
    <div class='fieldset'>
     <?php echo my_generate_legend('itinerary');?>
        <?php  if(isset($items['itinerary'])){
         foreach($items['itinerary'] as $it){
             echo '<div class="you-row"><span style="position:relative;top:2px;" class="glyphicon glyphicon-calendar"></span> ' , $it['travle_date'] , ' ' , $it['dname'] , '</div>';
         }
     } ?>

    </div>
    <div class='fieldset'>
    <?php echo my_generate_legend('itinerary_description');?>
    </div>
    <div class="you_section">
    <label class="control-label"> <?php echo $this->lang->line('itinerary_description'); ?>   </label>
     <div class="you-p row">
         <?php  echo $items['description']; ?>
     </div>
    </div>
   
     <div class="you_section">
    <label class="control-label"> <?php echo $this->lang->line('post_content'); ?>   </label>
     <div class="you-p row">
         <?php  echo $items['content']; ?>
     </div>
    </div>
    
     
     
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
		

			//]]>
    });
    </script>