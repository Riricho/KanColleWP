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
            <?php if(function_exists('the_views')) { ?><div class="views"><?php the_views(); ?></div><?php } ?>
            <div class="meta_author"><?php the_author(); ?></div>
			<div class="category"><?php the_category('、') ?></div>
        </div>
        <div class="sing-content left">
        	<div class="content"><?php the_content(); ?></div>
        	<small class="cc cf clear"><div class="cc_content left"><strong>声明:</strong> 本站所有图文遵循 <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh" rel="external nofollow" target="_blank">署名-非商业性使用-相同方式共享3.0共享</a> 协议.</div><div class="copyinfo right">转载请注明转自 <a href="<?php bloginfo('url') ?>" class="ota"><?php bloginfo('name'); ?></a></div></small>
            <small class="meta">标签：<?php the_tags((' '), '、'); ?></small>
			<div class="relatebar">
				<h3 class="relatetitle">附近の胖次</h3>
				<ul class="cf">	
	<?php $post_num = 4; $exclude_id = $post->ID;$posttags = get_the_tags(); $i = 0;if ( $posttags ) { $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';$args = array('post_status' => 'publish','tag_slug__in' => explode(',', $tags), 'post__not_in' => explode(',', $exclude_id), 'caller_get_posts' => 1, 'orderby' => 'comment_date', 'posts_per_page' => $post_num);query_posts($args); while( have_posts() ) { the_post(); ?><li class="left"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="relatetime">Posted on <?php the_time('Y.m.j'); ?></span></li>
	<?php $exclude_id .= ',' . $post->ID; $i ++;} wp_reset_query();}if ( $i < $post_num ) { $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';$args = array('category__in' => explode(',', $cats), 'post__not_in' => explode(',', $exclude_id),'caller_get_posts' => 1,'orderby' => 'comment_date','posts_per_page' => $post_num - $i);query_posts($args);while( have_posts() ) { the_post(); ?> <li class="left"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="relatetime">Posted on <?php the_time('Y.m.j'); ?></span></li>
	<?php $i ++;} wp_reset_query();}if ( $i  == 0 )  echo '<li>还没有发现胖次</li>';?>
				</ul>	
			</div>
            <?php comments_template(); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>