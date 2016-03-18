<?php /* 
		Template Name: Archives(存档页) 
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
			<div class="content archivelist">
				<span class="arc-collapse right">展开所有月份</span>
<?php
// 声明变量
$previous_year = $year = 0;
$previous_month = $month = 0;
$ul_open = false;
// 获取文章
$myposts = get_posts('numberposts=-1&amp;orderby=post_date&amp;order=DESC');
?>
<?php foreach($myposts as $post) : ?>
<?php
	global $post;
	// Setup the post variables
	setup_postdata($post);
	$year = mysql2date('Y', $post->post_date);
	$month = mysql2date('n', $post->post_date);
	$day = mysql2date('d', $post->post_date);
?>
	<?php if($year != $previous_year || $month != $previous_month) : ?>
			<?php if($ul_open == true) : ?>
			</ul>
			<?php endif; ?>
			<h3><?php the_time('Y年m月'); ?></h3>
			<ul>
			<?php $ul_open = true; ?>
			<?php endif; ?>
			<?php $previous_year = $year; $previous_month = $month; ?>
			<li class="acclist"><?php echo $day ?>日 : <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
			</ul>
   			</div>
    	</div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>