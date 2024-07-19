<?php
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
                <label for="couleur_bg">Couleur de fond : </label>
                    <input type="color" name="couleur_bg" value="'.$values[1].'">
                    <br>
                <label for="couleur_txt">Couleur : </label>
                    <input type="color" name="couleur_txt" value="'.$values[2].'">
                    <br>
                <label for="titre">Titre : </label>
                    <input type="text" name="titre" value="'.$values[3].'">
                    <br>
                <label for="nom">Intitulé \'Nom\' : </label>
                    <input type="text" name="nom" value="'.$values[4].'">
                    <br>
                <label for="courriel">Intitulé \'Courriel\' : </label>
                    <input type="text" name="courriel" value="'.$values[5].'">
                    <br>
                <label for="suivant">Bouton Suivant : </label>
                    <input type="text" name="btn_prochain" value="'.$values[6].'">
                    <br>
                <label for="soumettre">Bouton Soumettre : </label>
                    <input type="text" name="btn_soumission" value="'.$values[7].'">
                    <br>
                <button type="submit">Enregistrer</button>
            </form>
        </div>';


        infolettre_ajouter_liste();
}

function infolettre_update_data()
{
    // FIXME: update marche pour tout sauf courriel suivant et soummettre
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

function infolettre_ajouter_liste() {
    require_once('modal-infolettre-get.php');
    $modal_inscriptions = modal_infolettre_get_nom();
    if(!empty($modal_inscriptions)){
    $values = [];
    // Je sais que c'est pas très élégant mais ca marche.. j'ai du mal avec la récuperations des valeurs dans le formulaire
    echo '<div class="liste-admin">
            <h2>Liste d\'usagers inscris à l\'infolettre</h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Courriel</th>
                </tr>';
                for ($i=0; $i < count($modal_inscriptions) ; $i++) { 
                    echo '<tr>';
                    echo '<th>';
                    print_r($modal_inscriptions[$i]['nom']);
                    echo '</th>';
                    echo '<th>';
                    print_r($modal_inscriptions[$i]['courriel']);
                    echo '</th>';
                    echo '</tr>';
                }
    echo '</tr>
        </table>
        </div>';
    }
}
