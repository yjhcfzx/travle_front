<?php if(isset($is_self) && $is_self): ?><div role="navigation" class="navbar my-navbar">
      <div class="container">
        <div class="navbar-header">
         
        </div>
        <div class="my-top-nav">
        <div class='my-pills-overlay'></div>
          <ul class="nav  nav-pills my-pills">
 <?php  foreach( $subnav['user'] as $key => $nav_item):
                            $text_key = isset( $nav_item['text']) ? $nav_item['text'] : $key;
                            $text = $this->lang->line($text_key);
                            $href = isset( $nav_item['href']) ? $nav_item['href'] : $key   ;
                            $href = $this->config->item('base_url') . $href . '/' . $user['id'];
                        ?>
         
           		<li class='nav-item <?php if($router == $key) echo " active";?>' id='nav-item-<?php echo $key;?>'>
           			<a href='<?php echo $href;?>'><?php echo $text;?></a>
           		</li>
        
                        <?php endforeach;?>
 </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>
<?php endif;?>