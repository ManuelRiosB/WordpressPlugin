<?php
/*
Plugin Name: Microsoft Wordpress Rol
Plugin URI: 
Description: 
Your Microsoft office like Wordpress Rol!
Take the value of your Microsoft office and create a role with it.
Version: 0.1.0
Author: Manuel Rios Brinatti
Author URI: https://www.linkedin.com/in/manuel-r%C3%ADos-brinatti-112a8416b/
License: MIT
License URI: https://opensource.org/licenses/MIT
Text domain: add-roles
*/

//If wordpress is not started, the code will not be executed
defined('ABSPATH') or die;

function mrb_add_roles(){
    
    $args = [
        'number' => -1,
    ];
    
    // The Query
    $user_query = new WP_User_Query( $args );
    
    // User Loop
    if ( ! empty( $user_query->get_results() ) ) {
        foreach ( $user_query->get_results() as $user ) {
            $userMsOffice = $user->msOffice;
            $userID = $user->ID;
            $userRol = $user->role;
            

                add_role( $userMsOffice, $userMsOffice, array(
                    'read' => true,
                    'edit post' => false,
                    'remove_post' => false,
                    'delete_published_post' => false,
                    'publish_post' => false,
                    'upload_files' => false,
                    'edit_published_post' => false
                ));

                
                    // not change "administrator" rol for admin user
                    if($userID != 1){
                        $result = wp_update_user($userID, $userMsOffice);

                        if ( is_wp_error( $result ) ) {
                            // There was an error, probably that user doesn't exist.
                        } else {
                            // Success!
                        }
                    }
                
                

                
            }
        }   
        
        
}

function mrb_remove_roles(){
    
    $args = [
        'number' => -1,
    ];
    
    // The Query
    $user_queri = new WP_User_Query( $args );
    
    // User Loop
    if ( ! empty( $user_queri->get_results() ) ) {
        foreach ( $user_queri->get_results() as $user ) {
            $userMsOffice = $user->msOffice;

                remove_role($userMsOffice);
            }
        }   
}

add_action('init', 'mrb_add_roles');
register_deactivation_hook( __FILE__, 'mrb_remove_roles' );


