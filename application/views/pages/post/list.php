<style>
    .list-item:hover{
        cursor:pointer;
        cursor:hand;
        
    }
</style>
<div class="container-fluid">
    <div id="searchbox">
        <form id="search-form" method="post">
        <div class="input-group">
            <span onclick="searchPost();" class="input-group-addon" id="basic-addon1"><span style='margin-left:3px;position:relative;top:2px;' class="glyphicon glyphicon-search"></span></span>
            <input <?php if(isset($_POST['keyword']) ){ echo " value='{$_POST['keyword']}' " ;}?> type="text"  name="keyword" class="form-control" placeholder="<?php echo $this->lang->line('keyword');?>" aria-describedby="basic-addon1">
        </div>
        </form>
    </div>
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
	            <div class="panel-heading"><?php echo $product['title']?> <span style='margin-left:3px;position:relative;top:2px;' class="glyphicon glyphicon-time"></span>
						    	  		<?php echo $product['travle_start_time']?></div>
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
<!--				    	<img style='max-width:100%' src="<?php echo isset($product['img']) ?
				    	 $this->config->item( 'cdn_url_upload_img') .'product/' .  $product['img'] 
				    	: '';?>">-->
                                        <?php if($imgOfText){ echo "<img class='thumbnail-img' src='{$imgOfText}' />";}?>
                                        </div>
				    	<div class="col-lg-10 col-md- col-sm-8 col-xs-8 list-main"> 
					    	  <div class = 'address'>	
                                                        <?php if(isset($product['content'])){
                                                            $content = strip_tags($product['content']) ;
                                                            if(mb_strlen($content) > 150){
                                                                $content = mb_substr($content, 0, 150);
                                                                $content .= '。。。';
                                                            }
                                                            echo $content;
                                                        }  ?>
					    	  </div>
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer"><span style='position:relative;top:2px;' class="glyphicon glyphicon-plane"></span>
                                    <?php echo $product['destination'] ?><span style='margin-left:10px;position:relative;top:2px;' class="glyphicon glyphicon-user"></span> <?php echo  $product['author'];?> <span style='margin-left:10px;position:relative;top:2px;' class="glyphicon glyphicon-pencil"></span> <?php echo $product['created_at'];?></div>
	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
<script>
    function searchPost(){
        $('#search-form').submit();
    }
$('.list-item').hover(function(){
    $(this).removeClass('panel-warning').addClass('panel-primary');
}, function(){
      $(this).removeClass('panel-primary').addClass('panel-warning');
});
    </script>