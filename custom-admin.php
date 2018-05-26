<?php

/* Eliminamos wordpress dashboard footer */
function change_footer_admin () { echo ucfirst(get_bloginfo('name'));}
add_filter('admin_footer_text', 'change_footer_admin', 9999);

function change_footer_version() { echo '&copy; '. date("Y") .' ' . ucfirst(get_bloginfo('name'));}
add_filter( 'update_footer', 'change_footer_version', 9999);

/* Eliminamos metaboxes del dashboard */
function example_remove_dashboard_widgets() {
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );       
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );     
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );               
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); 
  remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );   
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );  
  remove_meta_box( 'bbp-dashboard-right-now', 'dashboard', 'normal' ); 
  remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' ); 
  remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal' );
  remove_meta_box( 'welcome-panel', 'dashboard', 'normal' );
  remove_action('welcome_panel', 'wp_welcome_panel');
  remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' );
} 
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

/* Forzamos el escritorio a una sola columna */
function so_screen_layout_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );
function so_screen_layout_dashboard() {
    return 1;
}
add_filter( 'get_user_option_screen_layout_dashboard', 'so_screen_layout_dashboard' );

/* Creamos un widget en el dashboard */
function bienvenido_widget() {
	$web = ucfirst(get_bloginfo('name'));
    echo '
		<script>function confirm_delete() { return confirm("¿Cerrar la sesión?");}</script>
    	<h2>Bienvenido a '.$web.'</h2>
	    <p>Esta es tu área personal en la web de <strong>'.$web.'</strong>.<br>En este área puedes encontrar una gran cantidad de herramientas, recursos y archivos.<br>En las diferentes pestañas que puedes ver a la izquierda de la pantalla encontrarás las opciones y vínculos disponibles, así como el acceso a sus herramientas para que puedas realizar tus tareas habituales.
	    </p> 
	    <h2>Enlaces de interés</h2>
	    <ul>
	      <li><a href="'.get_bloginfo("url").'" target="_blank">Mi web</a></li>
	      <li><a href="'.get_edit_user_link().'">Editar mi perfil</a></li>
	      <li><a href="'.wp_logout_url().'" onclick="return confirm_delete()">Cerrar la sesión</a></li>
	    </ul>
	'; 
} 
function bienvenido_dashboard() {
  wp_add_dashboard_widget('bienvenido_widget', 'Bienvenido', 'bienvenido_widget');
}
add_action('wp_dashboard_setup', 'bienvenido_dashboard');

/* Personalizar admin */
add_action( 'admin_head', 'change_styles_admin' );
function change_styles_admin(){
	echo '
		<style>
			* {box-shadow: none !important; text-shadow: none !important; outline: none !important;}
			#wpadminbar, .update-nag, .customize.load-customize.hide-if-no-customize, #adminmenu .wp-menu-image img, .wp-menu-image, #collapse-menu, #wp-admin-bar-comments, #wp-admin-bar-new-content, #wp-admin-bar-wpseo-menu, #wp-admin-bar-autoptimize, #wp-admin-bar-updates, .updated, .update-plugins, div#contextual-help-link-wrap, #wp-admin-bar-site-name .ab-sub-wrapper, #wpseo-dashboard-overview, .update-nag, #wp-admin-bar-wp-logo, .wp-menu-separator { display: none !important; }
			#adminmenu, #wpbody-content { margin-top: -32px; }
		    #adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after, ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu > li.current > a.current:after { border: 0; }
		    #adminmenu div.wp-menu-name { padding: 8px 10px !important; }
  		<style>
  	';
}