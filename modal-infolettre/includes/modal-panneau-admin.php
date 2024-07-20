<?php

// Simon, je sais que tu ne vas pas aimer cette partie de mon code. Premièrement, je n'ai pas utilisé de templates par manque de temps. J'ai trouvé les fonctions nécessaires pour l'affichage des templates et je les ai utilisées pour la pop-up côté client, mais c'était trop long de le faire pour les autres zones (formulaire admin et liste admin). J'ai passé trop de temps à récupérer mes données depuis les tableaux. Donc, il y a juste des echo et des print_r, et j'ai utilisé des techniques d'ouverture de balises pour insérer mes valeurs dynamiquement.


/**
 * Fonction infolettre_ajouter_menu() qui ajoute le petit menu dans la barre de gauche de WordPress côté admin, comme vu en cours.
 */
function infolettre_ajouter_menu() {
    add_menu_page(
        'Premier travail Pratique',
        'Premier travail Pratique',
        'manage_options',
        'infolettre-menu-page',
        'infolettre_ajouter_formulaire'
    );
}
add_action('admin_menu', 'infolettre_ajouter_menu');


/**
 * Fonction infolettre_ajouter_formulaire() qui ajoute notre grand formulaire côté admin. On appelle infolettre_update_data(), modal_infolettre_get() et infolettre_ajouter_liste() dans cette fonction.
 * La première permet de récupérer les données insérées dans la base de données lors de l'activation et remplit le formulaire avec du contenu de base lors du chargement. Si on enregistre, le formulaire se remplit des valeurs dans la base de données.
 * La deuxième fait la même chose ? Je commence à me fatiguer.
 * La troisième ajoute la liste des inscriptions sur la page.
 */
function infolettre_ajouter_formulaire()
{
    if (isset($_POST)) {
        infolettre_update_data();
    }

    require_once('modal-infolettre-get.php');
    $modal_parametres = modal_infolettre_get();
    $values = [];

    foreach($modal_parametres[0] as $key) {
        $values[] = $key;
    }
    $titre = get_admin_page_title();  

    echo '<div class="formulaire-admin">
            <h2>'.$titre.'</h2>
            <form method="post">
                <div class="border">
                    <label for="couleur_bg">Couleur de fond : </label>
                    <input type="color" name="couleur_bg" value="'.$values[1].'">
                </div>
                <div class="border">
                <label for="couleur_txt">Couleur : </label>
                    <input type="color" name="couleur_txt" value="'.$values[2].'">
                </div>
                <div class="border">
                    <label for="titre">Titre : </label>
                    <input type="text" name="titre" value="'.$values[3].'">
                </div>
                <div class="border">
                    <label for="nom">Intitulé \'Nom\' : </label>
                    <input type="text" name="nom" value="'.$values[4].'">
                </div>
                <div class="border">
                    <label for="courriel">Intitulé \'Courriel\' : </label>
                    <input type="text" name="courriel" value="'.$values[5].'">
                </div>
                <div class="border">
                    <label for="suivant">Bouton Suivant : </label>
                    <input type="text" name="btn_prochain" value="'.$values[6].'">
                </div>
                <div class="border">
                    <label for="soumettre">Bouton Soumettre : </label>
                    <input type="text" name="btn_soumission" value="'.$values[7].'">
                </div>
                <button class="btn" type="submit">Enregistrer</button>
            </form>
        </div>';


        // Honnêtement, je ne savais pas trop où appeler la fonction donc je l'ai mise ici.
        infolettre_ajouter_liste();
}


/**
 * Fonction infolettre_update_data() qui met à jour les informations en allant les chercher dans la base de données.
 */
function infolettre_update_data()
{
    if (!empty($_POST)) {

        global $wpdb;
        
        $couleur_bg = sanitize_hex_color($_POST['couleur_bg']);
        $couleur_txt = sanitize_hex_color($_POST['couleur_txt']);
        $titre = sanitize_text_field($_POST['titre']);
        $nom = sanitize_text_field($_POST['nom']);
        $courriel = sanitize_text_field($_POST['courriel']);
        $btn_prochain = sanitize_text_field($_POST['btn_prochain']);
        $btn_soumission = sanitize_text_field($_POST['btn_soumission']);
        
        $data = [
            'couleur_bg' => $couleur_bg,
            'couleur_txt' => $couleur_txt,
            'titre' => $titre,
            'nom' => $nom,
            'courriel' => $courriel,
            'btn_prochain' => $btn_prochain,
            'btn_soumission' => $btn_soumission,
        ];
        $where = ['id' => 1];
        $wpdb->update(MODAL_INFOLETTRE_PARAMETRES, $data, $where);
    }
    
}


/**
 * Fonction infolettre_ajouter_liste() qui utilise modal_infolettre_get_inscriptions() pour aller chercher les infos des inscriptions dans la base de données et construit une table avec ces infos dynamiquement.
 * Ça m'a pris du temps à trouver une boucle qui marchait. Quand j'utilisais un foreach, j'avais du mal à spécifier les clés de manière dynamique vu qu'il y en a deux (nom et courriel). Donc, une petite boucle for avec du rafistolage HTML.
 */
function infolettre_ajouter_liste() {

    require_once('modal-infolettre-get.php');
    $modal_inscriptions = modal_infolettre_get_inscriptions();

    if(!empty($modal_inscriptions)){

        echo '<div class="liste-admin">
                <h3>Liste d\'usagers inscris à l\'infolettre</h3>
                <table class="table">
                    <tr>
                        <th>Nom</th>
                        <th>Courriel</th>
                    </tr>';
                    for ($i=0; $i < count($modal_inscriptions) ; $i++) { 
                        echo '<tr>';
                        echo '<td>';
                        print_r($modal_inscriptions[$i]['nom']);
                        echo '</td>';
                        echo '<td>';
                        print_r($modal_inscriptions[$i]['courriel']);
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tr>
                </table>
            </div>';
    }
}