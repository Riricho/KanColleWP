<?php /* 
		Template Name: About(关于) 
	  */ ?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="sing-title"><h1><?php the_title(); ?></h1></div>
	<div class="sing-banner left">
    	<div class="banner"></div>
    </div>
</div><!-- End #header -->
	<div class="sing-post cf">
    	<div class="post_meta left">
            <div class="time"><?php the_time('Y-m-d'); ?></div>
            <div class="leavemsg"><a>戳我发送留言</a></div>
            <div class="views"><?php if(function_exists('the_views')) { the_views(); } ?></div>
            <div class="meta_author"><?php the_author(); ?></div>
        </div>
        <div class="sing-content left">
        	<div class="content"><?php the_content(); ?></div>
            <?php comments_template(); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>