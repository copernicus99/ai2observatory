<?php
/*
  Plugin Name: Instagram Api - WaliSystem
  Plugin URI: http://www.walisystems.com
  Description: Instagram api get all information related to post , tags and users.
  Version: 1.0
  Author: Yasir Naeem
  Author URI: walisystems.com
  License: GPLv2+
  Text Domain: wp-instagram-api
*/

class WP_AI2_Observatory{

  // Constructor
	var $_result = array();
    function __construct() {
	
        add_action( 'admin_menu', array( $this, 'wpa_add_menu' ));
        register_activation_hook( __FILE__, array( $this, 'wpa_install' ) );
        register_deactivation_hook( __FILE__, array( $this, 'wpa_uninstall' ) );
    }

    /*
      * Actions perform at loading of admin menu
      */
    function wpa_add_menu() {

        add_menu_page( 'Theme Settings', 'Theme Settings', 'manage_options', 'ai2-observatory-dashboard', array(
                          __CLASS__,
                         'wpa_page_file_path'
                        ), null,'2.2.9');
    }

    /*
     * Actions perform on loading of menu pages
     */
    function wpa_page_file_path() {
    	$code = '';
    	if (isset($_POST["update_settings"])) {
    		$ai2_address = esc_attr($_POST["ai2_address"]);
    		$ai2_contact = esc_attr($_POST["ai2_contact"]);
    		$ai2_email = esc_attr($_POST["ai2_email"]);
            $ai2_facebook = esc_attr($_POST["ai2_facebook"]);
            $ai2_twitter = esc_attr($_POST["ai2_twitter"]);   
            $ai2_google = esc_attr($_POST["ai2_google"]);
            $ai2_dribbble = esc_attr($_POST["ai2_dribbble"]);
            $ai2_youtube = esc_attr($_POST["ai2_youtube"]);

			update_option("ai2_address", $ai2_address);
			update_option("ai2_contact", $ai2_contact);
			update_option("ai2_email", $ai2_email);
            update_option("ai2_facebook", $ai2_facebook);
            update_option("ai2_twitter", $ai2_twitter);
            update_option("ai2_google", $ai2_google);
            update_option("ai2_dribbble", $ai2_dribbble);
            update_option("ai2_youtube", $ai2_youtube);
            $code = 'success';


    	}
    	$ai2_address = get_option("ai2_address");
    	$ai2_contact = get_option("ai2_contact");
    	$ai2_email = get_option("ai2_email");
        $ai2_facebook = get_option("ai2_facebook");
        $ai2_twitter = get_option("ai2_twitter");
        $ai2_google = get_option("ai2_google");
        $ai2_dribbble = get_option("ai2_dribbble");
        $ai2_youtube = get_option("ai2_youtube");

     ?>
    	<div class="wrap">
        <?php screen_icon('themes'); ?> <h2>AI&sup2; Observatory Setting</h2>
        <?php 
            if($code=='success'){?>
            <div id="message" class="updated notice is-dismissible"><p>Successfully update your setting.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
            <?php 
        }
         ?>   
        <form method="POST" action="">
            <table class="form-table table">
                <tr valign="top">
                    <th scope="row">
                        <label for="ai2_address">
                            Address
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_address" value="<?php echo $ai2_address;?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_contact">
                            Contact:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_contact" value="<?php echo $ai2_contact;?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_email">
                            Email:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_email" value="<?php echo $ai2_email;?>" />
                    </td>
                </tr>
                <tr><th colspan="1">Social Icon :</th><th>Enter Username</th></tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_facebook">
                            Facebook:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_facebook" value="<?php echo $ai2_facebook;?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_twitter">
                            Twitter:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_twitter" value="<?php echo $ai2_twitter;?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_google">
                            Google:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_google" value="<?php echo $ai2_google;?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_dribbble">
                            Dribbble:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_dribbble" value="<?php echo $ai2_dribbble;?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ai2_youtube">
                            Youtube:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="ai2_youtube" value="<?php echo $ai2_youtube;?>" />
                    </td>
                </tr>
                
                <tr>
                    <td scope="row">
                    <input type="hidden" name="update_settings" value="Y" />
                    <input type="submit" class="button button-primary" value="Save" />    
                    </td>
                   
                </tr>

            </table>
        </form>

        
    </div>
<?php
    }

    /*
     * Actions perform on activation of plugin
     */
    function wpa_install() {
        update_option("wp_instagram_api_post_per_page", '20');
    }

    /*
     * Actions perform on de-activation of plugin
     */
    function wpa_uninstall() {
		delete_option("wp_instagram_api_key");
		delete_option("wp_instagram_api_secret");
		delete_option("wp_instagram_api_access_token");
		delete_option("wp_instagram_api_callback_url");
        delete_option("wp_instagram_api_post_per_page");
    }



}

$obj = new WP_AI2_Observatory();

function get_ai2_address(){
    if(get_option("ai2_address")){
        return get_option("ai2_address");
    } else {
        return 'Pen Argyl, Pennsylvania USA';
    }
}

function get_ai2_contact(){
    if(get_option("ai2_contact")){
        return get_option("ai2_contact");
    } else {
        return '(001) 570.906.5329';
    }
}

function get_ai2_email(){
    if(get_option("ai2_email")){
        return get_option("ai2_email");
    } else {
        return 'support@ai2.com';
    }
}

function the_social_icon(){
    $html = '';

    $html.='<div class="social">';
    if(get_option("ai2_facebook")){
        $html.='<a href="https://www.facebook.com/'.get_option("ai2_facebook").'" title="facebook" class="fa fa-facebook" target="_blank"></a>';
    }
    if(get_option("ai2_twitter")){
        $html.='<a href="https://twitter.com/'.get_option("ai2_twitter").'" title="facebook" class="fa fa-twitter" target="_blank"></a>';
    }
    if(get_option("ai2_google")){
        $html.='<a href="https://plus.google.com/'.get_option("ai2_google").'" title="facebook" class="fa fa-google-plus" target="_blank"></a>';
    }
    if(get_option("ai2_dribbble")){
        $html.='<a href="https://dribbble.com/'.get_option("ai2_dribbble").'" title="facebook" class="fa fa-dribbble" target="_blank"></a>';
    }
    if(get_option("ai2_youtube")){
        $html.='<a href="https://www.youtube.com/'.get_option("ai2_youtube").'" title="facebook" class="fa fa-youtube-play" target="_blank"></a>';
    }
  $html.='</div>';
  echo $html;
}

function get_aio_page_title(){
    $html = '';
    $count = 0;
     $title = explode(" ", get_the_title());
     foreach ($title as $value) {
        if($count==1){
        $html.=' <span>'.$value.'</span> ';
    } else {
        $html.=' '.$value.' ';
    }

        $count++;
     }
     return $html;
 }

function get_aio_style_title($text){
    $html = '';
    $count = 0;
     $title = explode(" ", $text);
     foreach ($title as $value) {
        if($count==1){
        $html.=' <span>'.$value.'</span> ';
    } else {
        $html.=' '.$value.' ';
    }

        $count++;
     }
     return $html;
 }
