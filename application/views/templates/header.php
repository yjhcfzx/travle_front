<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>我要浪</title>
<link rel="icon"   type="image/png"    href="<?php echo $this->config->item( 'base_theme_url');?>images/favicon.ico">
 <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/bootstrap.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/bootstrap_theme.css">
    <link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/app.css"/>
     <script src="<?php echo $this->config->item( 'base_theme_url');?>js/jquery.js"></script> 
       
     <!-- Latest compiled and minified JavaScript -->
      <script src="<?php echo $this->config->item( 'base_theme_url');?>js/bootstrap.js"></script>
      <script src="<?php echo $this->config->item( 'base_theme_url');?>js/validator.js"></script>
      <script src="<?php echo $this->config->item( 'base_theme_url');?>js/utility.js"></script>
      <script src="<?php echo $this->config->item('base_theme_url');?>js/app.js"></script>
</head>
<body>
 
<script>window._bd_share_config=
            {"common":{"bdSnsKey":{"weixin":"","tsina":"","sqq":""},
            "bdText":"","bdMini":"2",
            //"bdMiniList":false,
            "bdPic":"",
            "bdStyle":"0",
            "bdSize":"16",
        "bdMiniList":["weixin","qzone","sqq","copy"]
    },
        "slide":{"type":"slide","bdImg":"0","bdPos":"right","bdTop":"100"},
        "image":{"viewList":["qzone","tsina","tqq","weixin"],
            "viewText":"分享到：","viewSize":"16"},
        "selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","weixin"]}};
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
	<!-- Fixed navbar -->
    <div role="navigation" class="navbar my-navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
         
        </div>
        <div class="my-top-nav">
        <div class='my-pills-overlay'></div>
          <ul class="nav  nav-pills my-pills">
           <?php foreach( $this->config->item( 'nav_arr') as $key => $nav_item):
            $text = isset( $nav_item['text']) ? $nav_item['text'] : $key;
            $href = isset( $nav_item['href']) ? $nav_item['href'] : $key;
            $href = $this->config->item('base_url') . $href;
           ?>
           <?php if($key == 'post'):?>
           		<li role="presentation" class='dropdown nav-item <?php if($router == $key) echo " active";?>' id='nav-item-<?php echo $key;?>'>
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
			      <?php echo $text;?> <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu" role="menu">
                              <li><a href='<?php echo $this->config->item( 'base_url');?>post'><?php echo $this->lang->line('post'); ?></a></li>
			      <li><a href='<?php echo $this->config->item( 'base_url');?>post/create'><?php echo $this->lang->line('create_post'); ?></a></li>
			      
			    </ul>
			  </li>
           <?php else:?>
           		<li class='nav-item <?php if($router == $key) echo " active";?>' id='nav-item-<?php echo $key;?>'>
           			<a href='<?php echo $href;?>'><?php echo $text;?></a>
           		</li>
           <?php endif;?>
           <?php endforeach;?>
<!--           		<li class='nav-item' id='nav-item-back'>
           			<a href="<?php echo $this->config->item( 'base_url') , '../../soa_dash/' ;?>">后台</a>
           		</li>-->
           		<li role="presentation" class="dropdown operation pull-right" >
           		<?php if(isset($user) && $user) :?>
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
				       <span  class='pull-left' style='margin-right:5px;margin-top:8px;font-size:0.7em;font-weight:normal;'><?php echo $user['name'];?></span>
				       <span class='pull-left' style='margin-right:3px;'><i class="icon-white icon-user"></i></span> 
				        <span class='pull-left' style='padding-top:12px;display:none;' >
				      		 <span class="icon-bar"></span>
				      		  <span class="icon-bar"></span>
				      		   <span class="icon-bar"></span>
				      	 </span>
				      	<span class="caret"></span>
				      	
				    </a>
				    <ul class="dropdown-menu dropdown-ul" role="menu">
				     	  <li role="presentation" class="create"><a href="<?php echo $this->config->item('base_url');?>user/logout/"><?php echo $this->lang->line('logout'); ?></a></li>
                                          <li role="presentation" class="create"><a href="<?php echo $this->config->item('base_url');?>user/detail/<?php echo $user['id'];?>"><?php echo $this->lang->line('my_profile'); ?></a></li>
				    </ul>
				    <?php else :?>
				    <div class='account-operations'>
				    	<a href='<?php echo $this->config->item( 'base_url');?>user/login'><?php echo $this->lang->line('login'); ?> </a> | 
				    	<a href='<?php echo $this->config->item( 'base_url');?>user/register'><?php echo $this->lang->line('register'); ?> </a>
				    </div>
				    <?php endif;?>
				  </li>
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class='page-content'>
    	
    
 	