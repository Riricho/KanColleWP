<?php
//视频短代码 by Ongakuer.com
function wp_embedcn_options() {
		$message='更新成功';
	if($_POST['update_embedcn_option']){
		$wp_embedcn_width_saved = get_option("wp_embedcn_width");
		$wp_embedcn_width = $_POST['wp_embedcn_width_option'];
		if ($wp_embedcn_width_saved != $wp_embedcn_width)
			if(!update_option("wp_embedcn_width",$wp_embedcn_width))
				$message='更新失败';
				
		$wp_embedcn_height_saved = get_option("wp_embedcn_height");
		$wp_embedcn_height = $_POST['wp_embedcn_height_option'];
		if($wp_embedcn_height_saved != $wp_embedcn_height)
			if(!update_option("wp_embedcn_height",$wp_embedcn_height))
				$message='更新失败';

		echo '<div class="updated"><strong><p>'. $message . '</p></strong></div>';
	}
?>	
	<style type="text/css">
	.wrap{padding:10px; font-size:12px; line-height:24px;color:#383838;}
	table,td{border:none}
	.embedtable td{vertical-align:top;text-align: left; }
	.top td{vertical-align: middle;text-align: left; }
	pre{white-space: pre;overflow: auto;padding:0px;line-height:19px;font-size:12px;color:#898989;}
	strong{ color:#666}
	</style>


<div class="wrap">
<div id="icon-themes" class="icon32"><br></div>
<h2>视频短代码</h2>

    <div style="padding-left:5px;">
	<form method="post" action="">
	 <br>
	 <p>根据你主题界面尺寸填写视频播放器尺寸。（只填写数字）</p>
	 <table width="300" border="1" class="devetable">
         <tr class="top"><td>宽度 (px)</td><td> <input type="text" name="wp_embedcn_width_option"value="<?php echo get_option("wp_embedcn_width"); ?>"  ></td>
         <tr class="top"><td>高度 (px)</td><td> <input type="text" name="wp_embedcn_height_option"  value="<?php echo get_option("wp_embedcn_height"); ?>" ></td>
 	 </table>
	  <br>
	 请注意播放器比例，如 4：3 比例的宽480px，高400px ， 16：9 比例为宽620px，高390px 。<br>
	 因为还有进度条等高度，所以按上面列出的自己计算一下……
			<p class="submit"><input type="submit"  class="button-primary" name="update_embedcn_option" value="保存设置" /></p>
	</form>	
		 <br>
		
      <table width="600" border="1" class="embedtable">
      	<tr><td width="80">短代码格式：</td><td width="520"><code>[embed]视频播放页面网址或Flash地址[/embed]</code></td></tr>
      </table>
	   <p><span style="color: #993300;">*切换至HTML模式，编辑器有相应的按钮方便插入。</span></p>
       <br>
            <p><span style="color: #808000;">以下网站中的视频，直接复制浏览器中的地址，粘贴到短代码中即可</span></p>
              <table width="810" border="1" class="embedtable">
               <tr><td width="80">优酷网：</td><td width="714"><code>[embed]http://v.youku.com/v_show/id_XMjgyNDk1NTYw.html[/embed]</code></td></tr>      
               <tr><td width="80">土豆网：</td><td width="714"><code>[embed]http://www.tudou.com/programs/view/tFny-0UbTEM[/embed]</code></td></tr>
               <tr><td width="80">酷6网：</td><td width="714"><code>[embed]http://v.ku6.com/show/7eenXUV4xNfiUsSu.html[/embed]</code></td></tr>
               <tr><td width="80">Youtube：</td><td width="714"><code>[embed]http://youtu.be/vtjJe4elifI[/embed]</code></td></tr>
              </table>   
			    <br> 
            <p><span style="color: #808000;">以下网站中的视频，需要复制视频给出的分享中的flash地址，粘贴到短代码中即可 </span></p>
              <table width="810" border="1" class="embedtable">
               <tr><td width="80">56.com：</td><td width="714"><code>[embed]http://player.56.com/v_NTM4ODY0NjY.swf[/embed]</code></td></tr> 
               <tr><td width="80">搜狐视频：</td><td width="714"><code>[embed]http://share.vrs.sohu.com/374302/v.swf[/embed]</code> </td></tr>
               <tr><td width="80">6房间：</td><td width="714"><code>[embed]http://6.cn/p/1/n4WbeuI_Gn7GBxCVccLQ.swf[/embed]</code></td></tr>
               <tr><td width="80">乐视网：</td><td width="714"><code>[embed]http://www.letv.com/player/x725792.swf[/embed]</code></td></tr>  
               <tr><td width="80">新浪视频：</td><td width="714"><code>[embed]http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=XXX/s.swf[/embed]</code></td></tr>
                <tr><td width="80">bilibili：</td><td width="714"><code>[embed]http://static.loli.my/miniloader.swf?vid=32480745[/embed]</code></td></tr>
              </table>
			  
			  <br> 
			  <br> 
			  <span style="color: #aaa;">最后废话一下，6房间播放器大小是480x385。bilibili播放器大小是415x544。这里家的flash就是这个尺寸，扩大或缩小进度条什么的都不会自动伸缩……<br>
			  搜狐和乐视的视频都是自动播放的…… Σ( ° △ °|||)
			  </span>
    </div>
  
</div>
<?php	
	}
	function wp_embedcn_options_admin(){
	add_theme_page('视频短代码', '视频短代码','edit_themes','addembedcode', 'wp_embedcn_options');}

	add_action('admin_menu', 'wp_embedcn_options_admin');
	
	//////////////////////
	
	function wp_embed_handler_myyouku( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_youku', '<embed src="http://player.youku.com/player.php/sid/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'youku', '#http://v.youku.com/v_show/id_(.*?).html#i', 'wp_embed_handler_myyouku' );
	
	function wp_embed_handler_mytudou( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_tudou', '<embed src="http://www.tudou.com/v/' . esc_attr($matches[1]) . '/v.swf"  quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr );}
	wp_embed_register_handler( 'tudou', '#http://www.tudou.com/programs/view/(.*?)($|&)#i', 'wp_embed_handler_mytudou' );
	
	function wp_embed_handler_myku6( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_ku6', '<embed src="http://player.ku6.com/refer/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'ku6', '#http://v.ku6.com/show/(.*?).html#i', 'wp_embed_handler_myku6' );
	
	function wp_embed_handler_myyoutube( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_youtube', '<embed src="http://www.youtube.com/v/' . esc_attr($matches[1]) . '?&amp;hl=zh_CN&amp;rel=0" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'youtube', '#http://youtu.be/(.*?)($|&)#i', 'wp_embed_handler_myyoutube' );

	function wp_embed_handler_my56 ($matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_56', '<embed src="http://player.56.com/v_' . esc_attr($matches[1]) . '.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( '56', '#http://player.56.com/v_(.*?).swf#i', 'wp_embed_handler_my56' );

	function wp_embed_handler_mysohu( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_sohu', '<embed src="http://share.vrs.sohu.com/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'sohu', '#http://share.vrs.sohu.com/(.*?)/v.swf#i', 'wp_embed_handler_mysohu' );

	function wp_embed_handler_my6cn( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_6cn', '<embed src="http://6.cn/p/' . esc_attr($matches[1]) . '.swf" quality="high" width="480" height="385" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( '6cn', '#http://6.cn/p/(.*?).swf#i', 'wp_embed_handler_my6cn' );
	
	function wp_embed_handler_myletv( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_letv', '<embed src="http://www.letv.com/player/' . esc_attr($matches[1]) . '.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'letv', '#http://www.letv.com/player/(.*?).swf#i', 'wp_embed_handler_myletv' );
	
	function wp_embed_handler_mysina( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_sina', '<embed src="http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=' . esc_attr($matches[1]) . '/s.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'sina', '#http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=(.*?)/s.swf#i', 'wp_embed_handler_mysina' );

	function wp_embed_handler_mybilibili( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_bilibili', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<embed height="452" width="544" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" wmode="opaque" src="http://static.loli.my/miniloader.swf" flashvars="'. esc_attr($matches[1]) .'" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>', $matches, $attr, $url, $rawattr ); }
	wp_embed_register_handler( 'bilibili', '#http://static.loli.my/miniloader.swf\?(.*?)($|&)#i', 'wp_embed_handler_mybilibili' );
////////////////
	function embedcodecn() { ?>
	<?php }	
?>