<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $options = get_option('otaku_options'); ?>
<title><?php if ( is_tag() ) { echo wp_title('Tag:');if($paged > 1) printf(' - 第%s页',$paged);echo ' | '; bloginfo( 'name' );} elseif ( is_archive() ) {echo wp_title('');  if($paged > 1) printf(' - 第%s页',$paged);    echo ' | ';    bloginfo( 'name' );} elseif ( is_search() ) {echo '&quot;'.wp_specialchars($s).'&quot;的搜索结果 | '; bloginfo( 'name' );} elseif ( is_home() ) {bloginfo( 'name' );$paged = get_query_var('paged'); if($paged > 1) printf(' - 第%s页',$paged);}  elseif ( is_404() ) {echo '页面不存在！ | '; bloginfo( 'name' );} else {echo wp_title( ' | ', false, right )  ; bloginfo( 'name' );} ?></title>
<?php if (is_single()) {$description = cut_str(strip_tags(apply_filters('the_content',$post->post_content)),200);$keywords = "";$tags = wp_get_post_tags($post->ID);foreach ($tags as $tag ) {$keywords = $keywords . $tag->name . ",";}} else if (is_category()) {$description = category_description();}?>
<meta name="description" content="<?php if (is_home()) { echo ($options['description_content']);} else echo $description;?>"/>
<meta name="keywords" content="<?php if (is_home()) { echo ($options['keyword_content']);} else echo $keywords;?>"/>
<link rel="icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" />
<script type="text/javascript">!window.jQuery && document.write('<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.min.js"><\/script>');</script>
<?php if ( is_singular() ){ ?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comments-ajax.js"></script>
<?php } ?>
<?php if($options['headcode']) : ?> 
	<?php echo($options['headcode']); ?>
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body>
<div id="wrapper" class="cf">

	<div class="mainbg"></div>
	
    <div id="leftbar" class="left">
    	<div class="arrow">点击</div>
    	<div class="leftbutton"></div>
        <div class="panel">
        	<div id="logo_dark"><img src="<?php bloginfo( 'template_url' ); ?>/images/logo_dark.png"></div>
        	<div id="admin"><a href="<?php bloginfo( 'url' ); ?>/wp-admin">立入禁止</a></div>
            <div class="tooltitle">搜索 / Search</div>
            <div id="search">
            	<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
                    <input type="text" id="s" name="s" value="请键入目标" /> 
                    <input type="submit" id="searchsubmit" class="button" value="发射"/>
                </form>
            </div>
            <!--
            <div class="tooltitle"><p>社会化网络 /</p> <p>Social Network</p></div>
            <div id="social">
            	<div class="cf">
            	<?php if($options['feedrss'] && $options['feedrss_content']) : ?>
        			<a class="icon feed" href="<?php echo($options['feedrss_content']); ?>" title="订阅宅谈" target="_blank">feed</a>
                <?php else : ?>
                	<a class="icon feed" href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank" title="订阅宅谈">feed</a>
                <?php endif; ?>
                <?php if($options['twitter'] && $options['twitter_url']) : ?>
					<a class="icon twi" href="<?php echo($options['twitter_url']); ?>" title="推特" target="_blank">twi</a>
                <?php else : ?><?php endif; ?>
                <?php if($options['gplus'] && $options['gplus_url']) : ?> 
                	<a class="icon pls" href="<?php echo($options['gplus_url']); ?>" title="Google+" target="_blank">g</a>
                <?php else : ?><?php endif; ?>
                <?php if($options['bgm'] && $options['bgm_url']) : ?>
					<a class="icon bgm" href="<?php echo($options['bgm_url']); ?>" title="班谷米" target="_blank">Bangumi</a>
                <?php else : ?><?php endif; ?>  
                </div>
                <div class="cf">
                <?php if($options['douban'] && $options['douban_url']) : ?>
					<a class="icon douban" href="<?php echo($options['douban_url']); ?>" title="豆瓣" target="_blank">豆</a>
                <?php else : ?><?php endif; ?>
                </div>
    		</div>
            -->
        </div>
    </div>
   
    	<div id="topbar">
        	<div id="topbox">
            	<?php if ( has_nav_menu('topbar-menu') ) : ?> 
        			<?php  wp_nav_menu( array( 'theme_location' => 'topbar-menu' ,'container'=>'') ); ?>
                <?php else : ?>
                	<ul id="menu-top" class="menu">
                    	<li class="menu-item menu-item-type-post_type menu-item-object-page">
                        	<a href="<?php bloginfo( 'url' ); ?>">HOME</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        	<a href="<?php bloginfo( 'url' ); ?>/about">ABOUT</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        	<a href="<?php bloginfo( 'url' ); ?>/archives">ARCHIEVES</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        	<a href="<?php bloginfo( 'url' ); ?>/tags">TAGS</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        	<a href="<?php bloginfo( 'url' ); ?>/links">LINKS</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        	<a href="<?php bloginfo( 'url' ); ?>/?page_id=14">GUESTBOOK</a>
                        </li>
                    </ul>
                <?php endif; ?>
        		<div class="nav-end">前往底部</div>
        	</div>
        </div>
    <div class="header-wrapper">
        <div id="header" class="clear cf">
       		<div id="logo" class="left">
            	<a href="<?php bloginfo( 'url' ); ?>">
                	<img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png">
                </a>
            </div>
