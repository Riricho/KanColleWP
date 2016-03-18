<?php
//加入自定义菜单
add_theme_support( 'menus' );if( function_exists( 'register_nav_menus' ) ) {register_nav_menus(array('topbar-menu' => 'Topbars Menu','header-menu' => 'Header Menu',));}
//加入缩略图
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 380, 250, true);
//加入后台选项
include_once('functions/settings.php');
//视频短代码
include_once('functions/embedcodecn.php');
//HTML编辑器按钮
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/functions/my-quicktags.js',
        array('quicktags')
    );
};
//邮件回复通知
function comment_mail_notify($comment_id) {
	  $admin_email = get_bloginfo ('admin_email'); 
	  $comment = get_comment($comment_id);
	  $comment_author_email = trim($comment->comment_author_email);
	  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
	  $to = $parent_id ? trim(get_comment($parent_id)->comment_author_email) : '';
	  $spam_confirmed = $comment->comment_approved;
	  if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email)) {
		$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
		$subject = '您在 [' . get_option("blogname") . '] 的留言有了新回复';
		$message = '
		<div>
		  <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
		  <p>您在 《' . get_the_title($comment->comment_post_ID) . '》 的留言:<br />'
		   . trim(get_comment($parent_id)->comment_content) . '</p>
		  <p>' . trim($comment->comment_author) . ' 给你的回复:<br />'
		   . trim($comment->comment_content) . '<br /></p>
		  <p>你可以点击<a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看完整内容</a></p>
		  <p>欢迎再度光临<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
		  <p>(此邮件由系统自动发出, 请勿回复.)</p>
		</div>';
		$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
		wp_mail( $to, $subject, $message, $headers );
	  }
	}
add_action('comment_post', 'comment_mail_notify');
/* Mini Pagenavi v1.0 by Willin Kan. */
function pagenavi( $p = 2 ) {if ( is_singular() ) return; global $wp_query, $paged;$max_page = $wp_query->max_num_pages;if ( $max_page == 1 ) return; if ( empty( $paged ) ) $paged = 1;echo '<span class="pagescout">Page: ' . $paged . ' of ' . $max_page . ' </span> '; if ( $paged > $p + 1 ) p_link( 1, '第 1 页' );if ( $paged > $p + 2 ) echo '<span class="page-numbers"> ... </span>';for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );}if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers"> ... </span>';if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );}
	function p_link( $i, $title = '' ) { if ( $title == '' ) $title = "第 {$i} 页";echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";}
// 中文截断文字
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8'){if($code == 'UTF-8'){$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";preg_match_all($pa, $string, $t_string);if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";return join('', array_slice($t_string[0], $start, $sublen));}else{$start = $start*2;$sublen = $sublen*2;$strlen = strlen($string);$tmpstr = '';for($i=0; $i<$strlen; $i++){ if($i>=$start && $i<($start+$sublen)){if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);else $tmpstr.= substr($string, $i, 1);}if(ord(substr($string, $i, 1))>129) $i++;}if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";return $tmpstr;}}
//去掉无效的rel
foreach(array(
        'rsd_link',//rel="EditURI"
        'index_rel_link',//rel="index"
        'start_post_rel_link',//rel="start"
        'wlwmanifest_link'//rel="wlwmanifest"
    ) as $xx)
    remove_action('wp_head',$xx);//X掉以上
    //rel="category"或rel="category tag", 这个最巨量
    function the_category_filter($thelist){
        return preg_replace('/rel=".*?"/','rel="tag"',$thelist);
    }   
add_filter('the_category','the_category_filter');
//更换默认头像
function newgravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/images/guestico.png';
    $avatar_defaults[$myavatar] = "默认头像";
return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'newgravatar' );
//评论表情
if ( !isset( $wpsmiliestrans ) ) {
		$wpsmiliestrans = array(
		':em01:' => '01.gif',
		':em02:' => '02.gif',
		':em03:' => '03.gif',
		':em04:' => '04.gif',
		':em05:' => '05.gif',
		':em06:' => '06.gif',
		':em07:' => '07.gif',
		':em08:' => '08.gif',
		':em09:' => '09.gif',
		':em10:' => '10.gif',
		);
}
function custom_smilies_src($src, $img)
{
	return get_bloginfo('template_directory').'/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);
//聊天形式短代码 - Left君
function chatLeft( $atts, $content = null ) {
	global $url;
	$url = get_bloginfo( 'template_directory' );
	extract( shortcode_atts( array(
		'id' => '左童鞋',
		'avatar' => 'avatar_b',
		'dir' => 'left',
	), $atts ) );

	return '<div class="chatbox cf"><div class="'.$avatar.' chat_avatar '.$dir.'"><img src="'.$url.'/images/'.$avatar.'.jpg"></div><div class="chat_content '.$dir.'"><div class="chat_bub"><div class="chat_arrow"></div><div class="chat_meta">'.$id.'</div><p>'.$content.'</p></div></div></div>';
}
add_shortcode( 'chatl', 'chatLeft' );
//聊天形式短代码 - Right君
function chatRight( $atts, $content = null ) {
	global $url;
	$url = get_bloginfo( 'template_directory' );
	extract( shortcode_atts( array(
		'id' => '右童鞋',
		'avatar' => 'avatar_a',
		'dir' => 'right',
	), $atts ) );

	return '<div class="chatbox cf"><div class="'.$avatar.' chat_avatar '.$dir.'"><img src="'.$url.'/images/'.$avatar.'.jpg"></div><div class="chat_content '.$dir.'"><div class="chat_bub"><div class="chat_arrow"></div><div class="chat_meta">'.$id.'</div><p>'.$content.'</p></div></div></div>';
}
add_shortcode( 'chatr', 'chatRight' );
//自定义评论结构
function otakism_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount,$comment_depth;
   $otakism_comment_depth = $comment_depth-1;
   if(!$otakism_comment_depth){
		$otakism_comment_depth = '&nbsp;&nbsp';
	}
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?><?php if( $depth > 1){ echo 'style="margin-left:35px;"';} ?> id="comment-<?php comment_ID() ?>" >
		<div id="comment-<?php comment_ID(); ?>" class="comment-body cf">
			<div class="comment-avatar left"><a href="<?php comment_author_url(); ?>"><?php echo get_avatar( $comment, $size = '60'); ?></a></div>
			<div class="comment-content left">
				<div class="comment-name"><?php printf(__('%s'), get_comment_author_link()) ?></div>
                <div class="comment-entry"><?php comment_text() ?></div>
                <div class="comment-meta cf">
                    <div class="comment-date left"><?php comment_date('Y.m.j') ?> at <?php comment_time('H:i'); ?></div>
                    <div class="comment-reply left"><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    <div class="useragent left">
						<?php if (function_exists("CID_init")) {CID_print_comment_browser();} ?>
                    </div>
				</div>
            </div> 
            <div class="comment-floor right">
            	<?php
			if(get_option('default_comments_page')=='newest'){
				if(!$parent_id = $comment->comment_parent ){
					++$commentcount;
					}
				echo '<span>#'.$commentcount.'<strong>'.$otakism_comment_depth .'</strong></span>';
			}else{

				if(!$parent_id = $comment->comment_parent ){
					--$commentcount;
					}
				echo '<span>#'.$commentcount.'<strong>'.$otakism_comment_depth .'</strong></span>';

			}
		?>
            </div> 
    	</div>
    </li>
<?php } ?>

<?php
class Simple_Local_Avatars {
    private $user_id_being_edited;
        
    public function __construct() {
        add_filter( 'get_avatar', array( $this, 'get_avatar' ), 10, 5 );
        
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        
        add_action( 'show_user_profile', array( $this, 'edit_user_profile' ) );
        add_action( 'edit_user_profile', array( $this, 'edit_user_profile' ) );
        
        add_action( 'personal_options_update', array( $this, 'edit_user_profile_update' ) );
        add_action( 'edit_user_profile_update', array( $this, 'edit_user_profile_update' ) );
        
        add_filter( 'avatar_defaults', array( $this, 'avatar_defaults' ) );
    }
        
    public function get_avatar( $avatar = '', $id_or_email, $size = 96, $default = '', $alt = false ) {
        
        if ( is_numeric($id_or_email) )
            $user_id = (int) $id_or_email;
        elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) )
            $user_id = $user->ID;
        elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) )
            $user_id = (int) $id_or_email->user_id;
        
        if ( empty( $user_id ) )
            return $avatar;
        
        $local_avatars = get_user_meta( $user_id, 'simple_local_avatar', true );
        
        if ( empty( $local_avatars ) || empty( $local_avatars['full'] ) )
            return $avatar;
        
        $size = (int) $size;
        
        if ( empty( $alt ) )
            $alt = get_the_author_meta( 'display_name', $user_id );
        
        // generate a new size
        if ( empty( $local_avatars[$size] ) ) {
            $upload_path = wp_upload_dir();
            $avatar_full_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full'] );
            $image_sized = image_resize( $avatar_full_path, $size, $size, true );      
            // deal with original being >= to original image (or lack of sizing ability)
            $local_avatars[$size] = is_wp_error($image_sized) ? $local_avatars[$size] = $local_avatars['full'] : str_replace( $upload_path['basedir'], $upload_path['baseurl'], $image_sized );
            // save updated avatar sizes
            update_user_meta( $user_id, 'simple_local_avatar', $local_avatars );
        } elseif ( substr( $local_avatars[$size], 0, 4 ) != 'http' ) {
            $local_avatars[$size] = home_url( $local_avatars[$size] );
        }
        
        $author_class = is_author( $user_id ) ? ' current-author' : '' ;
        $avatar = "<img alt='" . esc_attr( $alt ) . "' src='" . $local_avatars[$size] . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
        
        return apply_filters( 'simple_local_avatar', $avatar );
    }
        
    public function admin_init() {
        //load_plugin_textdomain( 'simple-local-avatars', false, dirname( plugin_basename( __FILE__ ) ) . '/localization/' );
        
        register_setting( 'discussion', 'simple_local_avatars_caps', array( $this, 'sanitize_options' ) );
        add_settings_field( 'simple-local-avatars-caps', __('Local Avatar Permissions','simple-local-avatars'), array( $this, 'avatar_settings_field' ), 'discussion', 'avatars' );
    }
        
    public function sanitize_options( $input ) {
        $new_input['simple_local_avatars_caps'] = empty( $input['simple_local_avatars_caps'] ) ? 0 : 1;
        return $new_input;
    }
        
    public function avatar_settings_field( $args ) {       
        $options = get_option('simple_local_avatars_caps');
        
        echo '
            <label for="simple_local_avatars_caps">
                <input type="checkbox" name="simple_local_avatars_caps" id="simple_local_avatars_caps" value="1" ' . @checked( $options['simple_local_avatars_caps'], 1, false ) . ' />
                ' . __('仅具有头像上传权限的用户具有设置本地头像权限（作者及更高等级角色）。','simple-local-avatars') . '
            </label>
        ';
    }
        
    public function edit_user_profile( $profileuser ) {
    ?>
    <h3><?php _e( '头像','simple-local-avatars' ); ?></h3>
        
    <table class="form-table">
        <tr>
            <th><label for="simple-local-avatar"><?php _e('上传头像','simple-local-avatars'); ?></label></th>
            <td style="width: 50px;" valign="top">
                <?php echo get_avatar( $profileuser->ID ); ?>
            </td>
            <td>
            <?php
                $options = get_option('simple_local_avatars_caps');
        
                if ( empty($options['simple_local_avatars_caps']) || current_user_can('upload_files') ) {
                    do_action( 'simple_local_avatar_notices' );
                    wp_nonce_field( 'simple_local_avatar_nonce', '_simple_local_avatar_nonce', false );
            ?>
                    <input type="file" name="simple-local-avatar" id="simple-local-avatar" /><br />
            <?php
                    if ( empty( $profileuser->simple_local_avatar ) )
                        echo '<span class="description">' . __('尚未设置本地头像，请点击“浏览”按钮上传本地头像。','simple-local-avatars') . '</span>';
                    else
                        echo '
                            <input type="checkbox" name="simple-local-avatar-erase" value="1" /> ' . __('移除本地头像','simple-local-avatars') . '<br />
                            <span class="description">' . __('如需要修改本地头像，请重新上传新头像。如需要移除本地头像，请选中上方的“移除本地头像”复选框并更新个人资料即可。<br/>移除本地头像后，将恢复使用 Gravatar 头像。','simple-local-avatars') . '</span>
                        ';     
                } else {
                    if ( empty( $profileuser->simple_local_avatar ) )
                        echo '<span class="description">' . __('尚未设置本地头像，请在 Gravatar.com 网站设置头像。','simple-local-avatars') . '</span>';
                    else
                        echo '<span class="description">' . __('你没有头像上传全乡，如需要修改本地头像，请联系站点管理员。','simple-local-avatars') . '</span>';
                }
            ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript">var form = document.getElementById('your-profile');form.encoding = 'multipart/form-data';form.setAttribute('enctype', 'multipart/form-data');</script>
    <?php       
    }
        
    public function edit_user_profile_update( $user_id ) {
        if ( ! isset( $_POST['_simple_local_avatar_nonce'] ) || ! wp_verify_nonce( $_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce' ) )            //security
            return;
        
        if ( ! empty( $_FILES['simple-local-avatar']['name'] ) ) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'bmp' => 'image/bmp',
                'tif|tiff' => 'image/tiff'
            );
        
            // front end (theme my profile etc) support
            if ( ! function_exists( 'wp_handle_upload' ) )
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
        
            $this->avatar_delete( $user_id );    // delete old images if successful
        
            // need to be more secure since low privelege users can upload
            if ( strstr( $_FILES['simple-local-avatar']['name'], '.php' ) )
                wp_die('For security reasons, the extension ".php" cannot be in your file name.');
        
            $this->user_id_being_edited = $user_id; // make user_id known to unique_filename_callback function
            $avatar = wp_handle_upload( $_FILES['simple-local-avatar'], array( 'mimes' => $mimes, 'test_form' => false, 'unique_filename_callback' => array( $this, 'unique_filename_callback' ) ) );
        
            if ( empty($avatar['file']) ) {     // handle failures
                switch ( $avatar['error'] ) {
                    case 'File type does not meet security guidelines. Try another.' :
                        add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error",__("请上传有效的图片文件。","simple-local-avatars"));') );              
                        break;
                    default :
                        add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error","<strong>".__("上传头像过程中出现以下错误：","simple-local-avatars")."</strong> ' . esc_attr( $avatar['error'] ) . '");') );
                }
        
                return;
            }
        
            update_user_meta( $user_id, 'simple_local_avatar', array( 'full' => $avatar['url'] ) );      // save user information (overwriting old)
        } elseif ( ! empty( $_POST['simple-local-avatar-erase'] ) ) {
            $this->avatar_delete( $user_id );
        }
    }
        
    /**
     * remove the custom get_avatar hook for the default avatar list output on options-discussion.php
     */
    public function avatar_defaults( $avatar_defaults ) {
        remove_action( 'get_avatar', array( $this, 'get_avatar' ) );
        return $avatar_defaults;
    }
        
    /**
     * delete avatars based on user_id
     */
    public function avatar_delete( $user_id ) {
        $old_avatars = get_user_meta( $user_id, 'simple_local_avatar', true );
        $upload_path = wp_upload_dir();
        
        if ( is_array($old_avatars) ) {
            foreach ($old_avatars as $old_avatar ) {
                $old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
                @unlink( $old_avatar_path );   
            }
        }
        
        delete_user_meta( $user_id, 'simple_local_avatar' );
    }
        
    public function unique_filename_callback( $dir, $name, $ext ) {
        $user = get_user_by( 'id', (int) $this->user_id_being_edited );
        $name = $base_name = sanitize_file_name( substr(md5($user->user_login),0,12) . '_avatar' );
        $number = 1;
        
        while ( file_exists( $dir . "/$name$ext" ) ) {
            $name = $base_name . '_' . $number;
            $number++;
        }
        
        return $name . $ext;
    }
}
        
$simple_local_avatars = new Simple_Local_Avatars;
        
function get_simple_local_avatar( $id_or_email, $size = '96', $default = '', $alt = false ) {
    global $simple_local_avatars;
    $avatar = $simple_local_avatars->get_avatar( '', $id_or_email, $size, $default, $alt );
        
    if ( empty ( $avatar ) )
        $avatar = get_avatar( $id_or_email, $size, $default, $alt );
        
    return $avatar;
}?>

<!-- 登录界面 -->
<?php   
    //Login Page
    function custom_login() {
        echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css" />'."\n";
        echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
    }
    add_action('login_head', 'custom_login');

    //Login Page Title
    function custom_headertitle ( $title ) {
        return get_bloginfo('name');
    }
    add_filter('login_headertitle','custom_headertitle');

    //Login Page Link
    function custom_loginlogo_url($url) {
        return esc_url( home_url('/') );
    }
    add_filter( 'login_headerurl', 'custom_loginlogo_url' );

    //Login Page Footer
    function custom_html() {
        echo '<div class="footer">'."\n";
        echo '<p>Copyright &copy; '.date('Y').' All Rights | Power by <a href="http://localhost/riricho/wp-stage">傻了吧唧的Y</a></p>'."\n";
        echo '</div>'."\n";
        echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/resizeBg.js"></script>'."\n";
        echo '<script type="text/javascript">'."\n";
        echo 'jQuery("body").prepend("<div class=\"loading\"><img src=\"'.get_bloginfo('template_directory').'/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");'."\n";
        echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.get_bloginfo('template_directory').'/images/login_bg.jpg\').load(function(){'."\n";
        echo '  resizeImage(\'bg\');'."\n";
        echo '  jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
        echo '  jQuery(\'.loading\').fadeOut();'."\n";
        echo '});';
        echo '</script>'."\n";
    }
    add_action('login_footer', 'custom_html');
?>