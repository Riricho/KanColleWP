<?php get_header(); ?>
<?php $options = get_option('otaku_options'); ?>
	<?php if ( is_home() ) { ?> 
		<div class="slideshow left">	
			<?php echo($options['slideshow']); ?> 	
    	</div>
	<?php } else { ?>
    	<?php if ( is_tag() ) { ?>
			<div class="sing-title"><h1><?php echo wp_title('Tag:'); ?></h1></div>
		<?php } elseif ( is_search() ) { ?>
			<div class="sing-title"><h1><?php echo '&quot;'.wp_specialchars($s).'&quot;的搜索结果'; ?></h1></div>
		<?php } elseif ( is_404() ) { ?>
			<div class="sing-title"><h1>错误的打开方式</h1></div>
		<?php } else { ?>
			<div class="sing-title"><h1><?php echo '分类:';wp_title(''); ?></h1></div>
        <?php } ?>
        <div class="sing-banner left">
        	<div class="banner"></div>
        </div>
	<?php } ?>
</div><!-- End #header -->
</div><!-- End .header-wrapper -->
<div id="posts" class="clear">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post cf">
    	<div class="post_meta left">
            <div class="time"><?php the_time('Y-m-d'); ?></div>
            <div class="comtnumber"><?php comments_popup_link('暂无吐槽', '已有①发吐槽', '已有%发吐槽'); ?></div>
            <?php if(function_exists('the_views')) { ?><div class="views"><?php the_views(); ?></div><?php } ?>
			<div class="category"><?php the_category('、') ?></div>
        </div>
        <div class="post_content_wrapper left cf">
        <div class="post_thumb left">
        	<a href="<?php the_permalink() ?>" rel="bookmark">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
            <?php } else { ?>
            	<img src="<?php bloginfo( 'template_url' ); ?>/images/default.jpg" />
			<?php } ?>
            </a>
        </div>
        <div class="post_content left">
        	<div class="title">
            	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
					<?php the_title(); ?>
                </a>
            </div>
        	<div class="excerpt">
        	<?php if(has_excerpt()) : ?>
				<?php the_excerpt(); ?>
            <?php else : ?>
            	<p><?php echo cut_str(strip_tags(apply_filters('the_content',$post->post_content)),180); ?></p>
            <?php endif; ?>
            </div>  
        </div>
        <div class="more"><a href="<?php the_permalink() ?>">Read More</a></div> 
        </div>
    </div>
    <?php endwhile; else: ?>
    <?php endif; ?>
    <div class="pagenavi"><div class="cf"><?php pagenavi(); ?></div></div>
    <div class="links cf">
    	<div class="links-meta left">
        	<div class="links-title">友情链接 / Links</div>
            <div class="links-apply"><a href="<?php bloginfo('url'); ?>/links">申请链接</a></div>
        </div>
        <div class="front-links left">
        	<ul class="cf"><?php echo wp_list_bookmarks('title_li=&title_before=&title_after=&categorize=0&orderby=id&order=DESC&category=&echo=0&show_images=0'); ?></ul>
        </div>
    </div>
</div>	
<?php get_footer(); ?>