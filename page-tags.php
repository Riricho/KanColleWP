<?php /* 
		Template Name: TagsCloud(标签云) 
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
            <div class="views"><?php if(function_exists('the_views')) { the_views(); } ?></div>
            <div class="meta_author"><?php the_author(); ?></div>
        </div>
        <div class="sing-content left">
            <div class="tags-content cf">
			<?php wp_tag_cloud("unit=px&smallest=12&largest=12&separator=&orderby=count&order=DESC"); ?>
			</div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>