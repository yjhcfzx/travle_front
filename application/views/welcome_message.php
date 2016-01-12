 <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      max-height:820px;
      margin: auto;
  }
  .carousel-control{width:10%;}
.glyphicon-chevron-right{right:15% !important;}
.glyphicon-chevron-left{left:25% !important;}
  </style>
<div id="container">
    
  <?php if(isset($recent_hot_post)):
        $indicator = '<ol class="carousel-indicators">';
    $inner = '<div class="carousel-inner" role="listbox">';?> 
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
    <?php
    $index = 0;
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
                if($imgOfText){
                    $indicator .= ' <li data-target="#myCarousel" data-slide-to="' . $index . '" ' . (($index == 0) ? ' class="active"' : '') . '></li>';
                    $inner .= ' <div class="item ' . (($index == 0) ? ' active' : '') . '">
      <a href="' . $this->config->item('base_url') . 'post/detail/' . $p['id'] . '"><img src="' . $imgOfText . '" alt="img">
      <div class="carousel-caption">
        <h3>' . $p['title'] . '</h3>
      </div></a>
    </div>';
                    $index++;
                }
                
    ?>
<?php
    endforeach;
    $indicator .= '</ol>';
    $inner .= '</div>';
     echo $indicator,$inner ;
    ?>
          <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <?php
endif;?>

</div>
