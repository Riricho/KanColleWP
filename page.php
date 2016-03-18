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
            <div class="comtnumber"><?php comments_popup_link('暂无吐槽', '已有①发吐槽', '已有%发吐槽','评论关闭'); ?></div>
            <div class="views"><?php if(function_exists('the_views')) { the_views(); } ?></div>
            <div class="meta_author"><?php the_author(); ?></div>
        </div>
        <div class="sing-content left">
        	<div class="content"><?php the_content(); ?></div>
        	<small class="cc cf clear"><div class="cc_content left"><strong>声明:</strong> 本站所有图文遵循 <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh" rel="external nofollow" target="_blank">署名-非商业性使用-相同方式共享3.0共享</a> 协议.</div><div class="copyinfo right">转载请注明转自 <a href="<?php bloginfo('url') ?>" class="ota">宅谈</a></div></small>
            <?php comments_template(); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>