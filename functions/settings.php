<?php
	class otakuOptions {
	function getOptions() {
		$options = get_option('otaku_options');
		if (!is_array($options)) {
			$options['site_name'] = '';
			$options['slideshow'] = '';
			$options['description_content'] = '';
			$options['keyword_content'] = '';
			$options['feedrss'] = false;
			$options['feedrss_content'] = '';
			$options['headcode'] = '';
			$options['footercode'] = '';
			$options['twitter'] = false;
			$options['twitter_url'] = '';
			$options['gplus'] = false;
			$options['gplus_url'] = '';
			$options['douban'] = false;
			$options['douban_url'] = '';
			$options['bgm'] = false;
			$options['bgm_url'] = '';
			update_option('otaku_options', $options);
		}
		return $options;
	}
	/* -- 初始化 -- */
	function init() {
		if(isset($_POST['otaku_save'])) {
			$options = otakuOptions::getOptions();
			$options['site_name'] = stripslashes($_POST['site_name']);
			$options['slideshow'] = stripslashes($_POST['slideshow']);
			$options['description_content'] = stripslashes($_POST['description_content']);
			$options['keyword_content'] = stripslashes($_POST['keyword_content']);
			$options['headcode'] = stripslashes($_POST['headcode']);
			$options['footercode'] = stripslashes($_POST['footercode']);
			if ($_POST['feedrss']) { $options['feedrss'] = (bool)true; } else { $options['feedrss'] = (bool)false; }		
			$options['feedrss_content'] = stripslashes($_POST['feedrss_content']);
			if ($_POST['twitter']) { $options['twitter'] = (bool)true; } else { $options['twitter'] = (bool)false; }		
			$options['twitter_url'] = stripslashes($_POST['twitter_url']);
			if ($_POST['gplus']) { $options['gplus'] = (bool)true; } else { $options['gplus'] = (bool)false; }		
			$options['gplus_url'] = stripslashes($_POST['gplus_url']);
			if ($_POST['douban']) { $options['douban'] = (bool)true; } else { $options['douban'] = (bool)false; }		
			$options['douban_url'] = stripslashes($_POST['douban_url']);
			if ($_POST['bgm']) { $options['bgm'] = (bool)true; } else { $options['bgm'] = (bool)false; }		
			$options['bgm_url'] = stripslashes($_POST['bgm_url']);
			update_option('otaku_options', $options);
			echo "<div id='message' class='updated fade'><p><strong>数据已更新</strong></p></div>";
		} else {otakuOptions::getOptions();	}
		add_theme_page("主题设置", "主题设置", 'edit_themes', basename(__FILE__), array('otakuOptions', 'display'));
	}
	/* -- 标签页 -- */
	function display() {
		$options = otakuOptions::getOptions();
?>
<style type="text/css">
#otaku_form{font-family:"Century Gothic", "Segoe UI", Arial, "Microsoft YaHei",Sans-Serif;}
.wrap{padding:10px; font-size:12px; line-height:24px;color:#383838;}
.otakutable td{vertical-align:top;text-align: left;border:none ;font-size:12px; }
.top td{vertical-align: middle;text-align: left; border:none;font-size:12px;}
table{border:none;font-size:12px;}
pre{white-space: pre;overflow: auto;padding:0px;line-height:19px;font-size:12px;color:#898989;}
strong{ color:#666}
textarea{ width:100%; margin:0 20px 0 0; overflow:auto}
.none{display:none;}
fieldset{ border:1px solid #ddd;margin:5px 0 10px;padding:10px 10px 20px 10px;-moz-border-radius:5px;-khtml-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}
fieldset:hover{border-color:#bbb;}
fieldset legend{padding:0 5px;color:#777;font-size:14px;font-weight:700;cursor:pointer}
fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
fieldset textarea{ padding:5px 5px;border:1px solid #ABADB3;line-height:150%;margin:1px;-moz-border-radius:0px;-khtml-border-radius:0px;-webkit-border-radius:0px;border-radius:0px;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($){  
$(".toggle").click(function(){$(this).next().slideToggle('normal')});
});
</script>
<form action="#" method="post" enctype="multipart/form-data" name="otaku_form" id="otaku_form" />
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>主题设置</h2><br>	
<fieldset>
<legend class="toggle">基本信息</legend>
	<div>
		<table width="800" border="1" class="otakutable">
        	<tr>
          	<td width="360">网站名称 （显示在底部的版权信息处）</td>
		    <td><label><textarea name="site_name" rows="1" style="width:410px;"><?php echo($options['site_name']); ?></textarea></label></td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		  <tr>
		    <td width="360">网站首页描述 （两百字以内为佳）</td>
		    <td><label><textarea name="description_content" rows="3" style="width:410px;"><?php echo($options['description_content']); ?></textarea></label></td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		  <tr>
		    <td>网站首页关键词 （多个关键词间用“ , ”隔开）</td>
		    <td><label><textarea name="keyword_content" rows="3" style="width:410px;"><?php echo($options['keyword_content']); ?></textarea></label></td>
	      </tr>
   			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
          <tr class="top">
          	<td>自定义feed地址</td>
            <td><label><input name="feedrss" type="checkbox" value="checkbox" <?php if($options['feedrss']) echo "checked='checked'"; ?> /> 开启</label></td>
          </tr>
        
           <tr class="top">
          	<td>请填写自定义feed地址（别忘了http://）</td>
            <td> <textarea name="feedrss_content" rows="1" style="width:410px;"  ><?php echo($options['feedrss_content']); ?></textarea></td>
          </tr>
         
		</table>
      <br>
       	</div>
</fieldset>
<fieldset>
	<legend class="toggle">统计代码</legend>
		<div class="none">
    	  <table width="800" border="1" class="otakutable">
      	<tr><td width="350">向<code>&lt;head&gt;</code>里添加代码</td><td width="434"><textarea name="headcode"  rows="6"  id="headcode" style="width:400px;"  ><?php echo($options['headcode']); ?></textarea></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr><td>向<code>#footer</code>里添加代码</td><td><textarea name="footercode"  rows="6"  id="footercode" style="width:400px;"  ><?php echo($options['footercode']); ?></textarea></td></tr>
       </table>
      </div>
</fieldset> 
<fieldset>      
<legend class="toggle">Slideshow</legend>
	<div class="none">		
		<table width="900" border="1" class="otakutable">  
        <tr><td width="360">添加链接图片（详见操作说明） <br>
        图片尺寸: 宽780px ，高300px<br>
        img标签的title属性和alt属性分别对应slideinfo中的h1和h3<br>
	
        </td><td>
		<?php wp_editor( $options['slideshow'], slideshow); ?> 
		</td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    </table>
   	</div>
</fieldset>
<fieldset>
	<legend class="toggle">SNS站点超链图标</legend>
	<div class="none">
    <table width="800" border="1" class="otakutable">
		<tr class="top"><td  width="360">开启Twitter图标</td><td><label><input name="twitter" type="checkbox" value="checkbox" <?php if($options['twitter']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的Twitter地址（加上http://）</td><td> <textarea name="twitter_url"  rows="1"  style="width:410px;"  ><?php echo($options['twitter_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr class="top"><td>开启Google+图标</td><td><label><input name="gplus" type="checkbox" value="checkbox" <?php if($options['gplus']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的Google+地址（加上http://）</td><td> <textarea name="gplus_url"  rows="1"  style="width:410px;"  ><?php echo($options['gplus_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr class="top"><td>开启豆瓣图标</td><td><label><input name="douban" type="checkbox" value="checkbox" <?php if($options['douban']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的豆瓣地址（加上http://）</td><td> <textarea name="douban_url"  rows="1"  style="width:410px;"  ><?php echo($options['douban_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr class="top"><td>开启班谷米图标</td><td><label><input name="bgm" type="checkbox" value="checkbox" <?php if($options['bgm']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的班谷米地址（加上http://）</td><td> <textarea name="bgm_url"  rows="1"  style="width:410px;"  ><?php echo($options['bgm_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    </table>
    </div>
</fieldset>
<!-- 提交按钮 -->

		<p class="submit">
			<input type="submit" name="otaku_save" value="更新设置" />
		</p>
</div> 
</form>
 
<?php
	}
}	
/* 登记初始化方法 */
add_action('admin_menu', array('otakuOptions', 'init'));
?>