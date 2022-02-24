<?php

/**
* Functions.php
*/


#This function can work also inside themes but to safe guard your theme functionalities there is plugin called snippets so that when your code messed up you can easily know and easy to disable.



add_action ('template_redirect', 'members-only');

functions members-only()
{
  if(is_page('super-secret') && ! is_user_logged_in() ) 
    {
      do_action('user_redirected', date("F j, Y, g:i a")); 
      wp_redirect( home_url() );
      die();
    }
}
 
add_action('user_redirected', 'log_when_accessed');
functions log_when_accessed( $date )
{
  $access_log = get_stylesheet_directory() . '/name_of_logfile.txt;
  $message = 'someone just tried to access our super secret page on '.$date ;

  if ( file_exists ($access_log )){
    $file = fopen( $access_log, 'a' );
    fwrite($file, $message. "\n");
  } else {
        $file = fopen( $access_log, 'w');
         fwrite( $file, $message. "\n");
    }
    fclose($file);

}

=============

global $wpdb;

$user = wp_get_current_user();

$allowed_roles = array('editor', 'administrator', 'author');
<?php if( array_intersect($allowed_roles, $user->roles ) ) {  ?>
   // Stuff here for allowed roles
<?php } ?>
 
