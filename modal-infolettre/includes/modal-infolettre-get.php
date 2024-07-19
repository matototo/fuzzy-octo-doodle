<?php

/**
 * Retourne toutes les valeurs dans la table PLUGIN_INSCRIPTION_INFO_PARAMETRES
 */
/*
TODO:
function plugin_inscription_info_get_data()
{
    global $wpdb;

    $resultat = $wpdb->get_var("SELECT * FROM " . PLUGIN_INSCRIPTION_INFO_PARAMETRES . "WHERE id=1");

    return $resultat;
}
*/

function modal_infolettre_get()
{
    global $wpdb;

    $resultat = $wpdb->get_results("SELECT * FROM " . MODAL_INFOLETTRE_PARAMETRES . " WHERE id=1", ARRAY_A);

    return $resultat;
}

function modal_infolettre_get_nom() {

    global $wpdb;

    $resultat = $wpdb->get_results("SELECT * FROM " .  MODAL_INFOLETTRE_INSCRIPTIONS . ";", ARRAY_A);

    return $resultat;
}