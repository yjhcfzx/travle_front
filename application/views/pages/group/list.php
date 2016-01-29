<div class="container-fluid">
    <div id="searchbox">
        <form id="search-form" method="post">
        <div class="input-group">
            <span onclick="searchPost();" class="input-group-addon" id="basic-addon1"><span style='margin-left:3px;position:relative;top:2px;' class="glyphicon glyphicon-search"></span></span>
            <input <?php if(isset($_POST['keyword']) ){ echo " value='{$_POST['keyword']}' " ;}?> type="text"  name="keyword" class="form-control" placeholder="<?php echo $this->lang->line('keyword');?>" aria-describedby="basic-addon1">
        </div>
        </form>
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
            if($product['main_image']){
                $imgOfText = $this->config->item( 'base_upload_url')  . $product['main_image'];
            }
              else  if($product['content']){
                $doc = new DOMDocument();
                $doc->loadHTML($product['content']);
                $img = $doc->getElementsByTagName('img')->item(0);
                if($img){$imgOfText = $img->getAttribute('src');}}?>
	       <div class="list-item panel panel-warning">
	            <div class="panel-heading"><a href="<?php echo  $this->config->item('base_url'), $router;?>/detail/<?php echo $product['id']; ?>">
                        <?php echo $product['title']?></a>
                        <span class="you-glyphicon glyphicon glyphicon-time"></span>
			<?php echo $product['travle_start_time'] , ' - ' , $product['travle_end_time'];?></div>
	       		<div class="panel-body" onclick='javascript:window.location.href = "<?php echo  $this->config->item('base_url'), $router;?>/detail/<?php echo $product['id']; ?>";'>
				    <div class = 'row'>
				    	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">

                                        <?php if($imgOfText){ echo "<img class='thumbnail-img' src='{$imgOfText}' />";}?>
                                        </div>
				    	<div class="col-lg-9 col-md-8 col-sm-8 col-xs-7 list-main"> 
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
                                            <div class='read_more visible-sm visible-xs'>
                                                <a href="<?php echo  $this->config->item('base_url'), $router ;?>/detail/<?php echo $product['id']; ?>">
                                                    <button  type="button" class="btn btn-primary btn-sm">
                                                        <i style='margin-left:3px;' class="you-glyphicon glyphicon glyphicon-hand-right"></i> 
                                                      <?php echo $this->lang->line('read_more');?></button>
                                               </a></div>
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer">
                                    <?php echo my_generate_post_meta($product);?>
                                </div>
	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
<style>
  .list-item  .panel-body:hover{
        cursor: pointer;
        cursor: hand;
    }
    .list-item  a{
        color:#333;
    }
     .list-item:hover a{
        color:#ee7337;
    }
    
    .list-item.panel-primary .panel-heading a{
       // color:#fff;
       // text-decoration: underline;
    }
</style>
<script>
    function searchPost(){
        $('#search-form').submit();
    }
$('.list-item .panel-body').hover(function(){
    $(this).parent('.list-item').removeClass('panel-warning').addClass('panel-primary');
}, function(){
      $(this).parent('.list-item').removeClass('panel-primary').addClass('panel-warning');
});
    </script>