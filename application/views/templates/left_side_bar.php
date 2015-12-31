<div class='sidebar left_sidebar'>
<div id='popular'>
        <h2><?php echo $this->lang->line('recent_hot'); ?></h2>
 </div>
<?php if(isset($recent_hot_post)):
    foreach($recent_hot_post as $p):
    $imgOfText = NULL;
            if($p['main_image']){
                $imgOfText = $this->config->item( 'base_upload_url')  . $p['main_image'];
            }
              else  if($p['content']){
                $doc = new DOMDocument();
                $doc->loadHTML($p['content']);
                $img = $doc->getElementsByTagName('img')->item(0);
                if($img){$imgOfText = $img->getAttribute('src');}}
    ?>
<div class='sidebar-item'>
    <div class='title'><a href="<?php echo  $this->config->item('base_url');?>post/detail/<?php echo $p['id']; ?>"><?php echo $p['title']; ?></a></div>
    <div class='grey-font'><span style='margin-left:0px;' class="you-glyphicon glyphicon glyphicon-time"></span><?php echo $p['travle_start_time'] , ' - ' , $p['travle_end_time'];?></div>
    <?php if(isset($imgOfText)):
       ?> 
    <img src='<?php echo $imgOfText; ?>'/>
    <?php  endif;?>
</div>
<?php
    endforeach;
endif;?>
</div>