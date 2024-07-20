<?php

// Si uninstall.php n'est pas appelé par WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$table_parametres = $wpdb->prefix . 'modal_infolettre_parametres';
$wpdb->query("DROP TABLE IF EXISTS $table_inscriptions");

$table_inscriptions = $wpdb->prefix . 'modal_infolettre_inscriptions';
$wpdb->query("DROP TABLE IF EXISTS $table_inscriptions");
