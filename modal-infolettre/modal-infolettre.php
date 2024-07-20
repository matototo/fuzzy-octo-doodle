<?php
/*
Plugin Name: Premier Travail Pratique
Description: Plugin developpé pour le premier travail pratique : Inscription Infolettre
Version: 1.3
Author: Matéo-thomas Fortin-lubin
*/


/**
 * Exit si accès direct au fichier
 */
if (!defined('ABSPATH')) {
    exit;
}


/**
 * Fonction infolettre_definir_const() comme vu en cours
 */
function infolettre_definir_const()
{
    if (!defined('MODAL_INFOLETTRE_PARAMETRES')) {
        global $wpdb;
        define('MODAL_INFOLETTRE_PARAMETRES', $wpdb->prefix . 'modal_infolettre_parametres');
    }

    if (!defined('MODAL_INFOLETTRE_INSCRIPTIONS')) {
        global $wpdb;
        define(
            'MODAL_INFOLETTRE_INSCRIPTIONS', $wpdb->prefix . 'modal_infolettre_inscriptions');
    }
}
add_action('plugins_loaded', 'infolettre_definir_const', 0);

// On appelle l'activation du plugin
require_once(plugin_dir_path(__FILE__) . '/includes/modal-infolettre-activation.php');
register_activation_hook(__FILE__, 'modal_infolettre_activation');


/**
 * Fonction modal_infolettre_deactivation() comme vu en cours
 */
function modal_infolettre_deactivation()
{
    global $wpdb;
    $table_parametres = $wpdb->prefix . 'modal_infolettre_parametres';
    $wpdb->query("DROP TABLE IF EXISTS $table_parametres");

    $table_inscriptions = $wpdb->prefix . 'modal_infolettre_inscriptions';
    $wpdb->query("DROP TABLE IF EXISTS $table_inscriptions");
}
register_deactivation_hook(__FILE__, 'modal_infolettre_deactivation');


// On appelle le panneau admin et le pop up
require_once(plugin_dir_path(__FILE__) . '/includes/modal-panneau-admin.php');
require_once(plugin_dir_path(__FILE__).'includes/modal-client.php');


/**
 * Fonction infolettre_ajouter_styleset_scripts() comme vu en cours
 */
function infolettre_ajouter_styles_et_scripts() {
    wp_register_style( 'infolettre-style', plugins_url( 'assets/styles/styles.css', __FILE__ ) );
    wp_enqueue_style( 'infolettre-style' );
    wp_register_script( 'infolettre-script', plugins_url( 'assets/scripts/main.js', __FILE__ ) );
    wp_enqueue_script( 'infolettre-script' );
}
// Il faut appeler cette fonction sinon ça ne marche pas !
add_action( 'wp_enqueue_scripts', 'infolettre_ajouter_styles_et_scripts' ); 
add_action( 'admin_enqueue_scripts', 'infolettre_ajouter_styles_et_scripts' );

