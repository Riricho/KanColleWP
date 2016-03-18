<?php /* 
		Template Name: Links(友情链接) 
	  */ ?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="sing-title"><h1><?php the_title(); ?></h1></div>
	<div class="sing-banner left">
    	<div class="banner"></div>
    </div>
</div><!-- End #header -->
	<div class="sing-post cf">
    	<div class="post_meta left" id="sliding">
            <div class="time"><?php the_time('Y-m-d'); ?></div>
            <div class="comtnumber"><a><?php comments_number( '暂无吐槽', '已有①发吐槽', '已有%发吐槽' ); ?></a></div>
            <div class="views"><?php if(function_exists('the_views')) { the_views(); } ?></div>
            <div class="meta_author"><?php the_author(); ?></div>
        </div>
        <div class="sing-content left">
        	<div class="link-content">
				<div><?php the_content(); ?></div>
 				<ul>
       	<?php
        $default_ico = get_template_directory_uri().'/images/links_default.png'; //默认 ico 图片位置
        $bookmarks = get_bookmarks('title_li=&orderby=rand'); //全部链接随机输出
        if ( !empty($bookmarks) ) {
            foreach ($bookmarks as $bookmark) {
            echo '<li><a href="' , $bookmark->link_url , '" title="' , $bookmark->link_description , '" target="_blank" class="tipTip"><span>' , $bookmark->link_name , '</span></a></li>';
            }
        }
        ?>
    		</ul>           
            </div>			
            <?php comments_template(); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>