<style>
    .list-item:hover{
        cursor:pointer;
        cursor:hand;
        
    }
</style>
<div class="container-fluid">
    <div id='popular'>
        <h2><?php echo $this->lang->line('recent_hot'); ?></h2>
    </div>
	    <div class='product-list'>
	    <?php 
	    if(isset($error)){
	    	//var_dump($error);
	    }
            else if(!$items){
              echo 'no items';  
            }
	    else{
	    foreach($items as $product): 
                $imgOfText = NULL;
                if($product['content']){
                $doc = new DOMDocument();
                $doc->loadHTML($product['content']);
                $img = $doc->getElementsByTagName('img')->item(0);
                if($img){$imgOfText = $img->getAttribute('src');}}?>
	       <div class="list-item panel panel-warning" onclick='javascript:window.location.href = "<?php echo  $this->config->item('base_url');?>post/detail/<?php echo$product['id']; ?>";'>
	            <div class="panel-heading"><?php echo $product['title']?>
						    	  			<span class="glyphicon glyphicon-road"></span>
						    	  		<?php echo $product['travle_time']?></div>
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
<!--				    	<img style='max-width:100%' src="<?php echo isset($product['img']) ?
				    	 $this->config->item( 'cdn_url_upload_img') .'product/' .  $product['img'] 
				    	: '';?>">-->
                                        <?php if($imgOfText){ echo "<img class='thumbnail-img' src='{$imgOfText}' />";}?>
                                        </div>
				    	<div class="col-lg-10 col-md- col-sm-8 col-xs-8 list-main"> 
					    	  <div class = 'row address'>	
					    		<?php echo isset($product['content']) ? strip_tags($product['content']) : ''; ?>
					    	  </div>
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer"><?php echo $product['destination'] .' ' .  $product['author'];?> <?php echo $product['created_at'];?></div>
	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
<script>
$('.list-item').hover(function(){
    $(this).removeClass('panel-warning').addClass('panel-primary');
}, function(){
      $(this).removeClass('panel-primary').addClass('panel-warning');
});
    </script>