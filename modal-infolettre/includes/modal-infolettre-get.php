<?php

/**
 * Fonction modal_infolettre_get() qui va chercher les résultats dans la base de données. C'était long parce qu'au début, cela nous retournait un objet avec des restrictions. Je ne sais pas du tout comment le paramètre ARRAY_A fonctionne, mais ça marche ! On utilise cette fonction pour les paramètres côté admin. Il y a donc toujours juste un id dans cette table.
 */
function modal_infolettre_get()
{
    global $wpdb;

    $resultat = $wpdb->get_results("SELECT * FROM " . MODAL_INFOLETTRE_PARAMETRES . " WHERE id=1", ARRAY_A);

    return $resultat;
}


/**
 * Fonction modal_infolettre_get_inscriptions() qui va chercher les informations des inscriptions à l'infolettre dans notre base de données. Encore une fois, j'utilise ARRAY_A parce qu'on doit utiliser get_results.
 */
function modal_infolettre_get_inscriptions() {

    global $wpdb;

    $resultat = $wpdb->get_results("SELECT * FROM " .  MODAL_INFOLETTRE_INSCRIPTIONS . ";", ARRAY_A);

    return $resultat;
}