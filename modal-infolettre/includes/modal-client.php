<?php

/**
 * Fonction charge_popup comme vu dans le premier plugin.
 * On va chercher les valeurs pour la modale tel que spécifié côté admin avec la fonction modal_infolettre_get() qui est dans son propre fichier PHP.
 * J'ai utilisé un tableau values[] pour m'aider à comprendre où j'étais dans le tableau. J'utilisais aussi la boucle foreach pour faire une assignation de ce genre : $values[$key] = $key pour avoir un tableau clé => valeur. Ça semble marcher, mais j'ai opté pour cette version avec des numéros du tableau.
 * Cette méthode n'est pas dynamique dans le sens où elle ne peut pas s'appliquer à des tableaux que je ne connais pas, mais bon, il fallait que j'avance.
 */
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


/**
 * Fonction modale_nouvelle_inscription() qui va insérer l'inscription dans la base de données comme vu en cours. Le seul changement, c'est le if (!empty (etc...)).
 */
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
                    '%s'        
                )
            );
 
            header( "Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
            unset( $_POST );
            exit;
            
        }
    }
}
add_action('init', 'modal_nouvelle_inscription');