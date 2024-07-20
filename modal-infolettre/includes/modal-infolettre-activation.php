<?php

/**
 * Fonction modal_infolettre_activation tel que vu en cours
 */
function modal_infolettre_activation()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_parametres = $wpdb->prefix . 'modal_infolettre_parametres';
    $table_inscriptions = $wpdb->prefix . 'modal_infolettre_inscriptions';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_parametres'") != $table_parametres) {
        $sql = "CREATE TABLE $table_parametres (
                id int NOT NULL AUTO_INCREMENT,
                couleur_bg varchar(10) NOT NULL,
                couleur_txt varchar(10) NOT NULL,
                titre varchar(100) NOT NULL,
                nom varchar(30) NOT NULL,
                courriel varchar(30) NOT NULL,
                btn_prochain varchar(30) NOT NULL,
                btn_soumission varchar(30) NOT NULL,
                PRIMARY KEY(id)
            ) $charset_collate";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $wpdb->insert($table_parametres, array('couleur_bg' => '#ffffff', 'couleur_txt' => '#000000', 'titre' => 'Inscrivez-vous à notre infolettre !', 'nom' => 'Nom', 'courriel' => 'Courriel', 'btn_prochain' => 'Suivant', 'btn_soumission' => 'Soumettre'));
    }

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_inscriptions'") != $table_inscriptions) {
        $sql = "CREATE TABLE $table_inscriptions (
                id int NOT NULL AUTO_INCREMENT,
                nom varchar(10) NOT NULL,
                courriel varchar(10) NOT NULL,
                PRIMARY KEY(id)
            ) $charset_collate";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
