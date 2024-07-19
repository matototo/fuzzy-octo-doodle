<?php

function charge_popup(){

    require_once('modal-infolettre-get.php');
    $modal_parametres = modal_infolettre_get();
    $values = [];

    foreach($modal_parametres[0] as $key) {
        $values[] = $key;
    }
    ob_start();
    include( dirname(plugin_dir_path( __FILE__ ) ) . '/templates/infolettre-pop-up.php' );
    $template = ob_get_clean();
    echo $template;
}
add_action('wp_body_open', 'charge_popup');

function modal_nouvelle_inscription(){

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
         
         if ( !empty( $_POST['modalnom']) ) {
 
             global $wpdb;
 
             $nom = sanitize_text_field($_POST['modalnom']);
             $courriel = sanitize_text_field($_POST['modalcourriel']);
             $wpdb->insert( MODAL_INFOLETTRE_INSCRIPTIONS,
                 array(
                     'nom' => $nom,
                     'courriel' => $courriel,
                 ), array(
                     '%s'        // $format (optionnel) => string
                 )
             );
 
             /**
              * Rafraîchi la page pour faire la communication client serveur
              * Détruit la variable spécifiée
              * exit pour stopper l'exécution de la suite du code
              */
             header( "Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
             unset( $_POST );
             exit;
             
         }
     }
}
add_action('init', 'modal_nouvelle_inscription');