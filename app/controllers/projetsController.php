<?php


namespace App\Controllers\ProjetsController;

use \PDO;


function indexAction(PDO $connexion)
{
    include_once '../app/models/projetsModel.php';

    // nombre de projets par page
    $parPage = 10;

    // je demande au modèle le nombre total de projets, et j'en déduis le nombre de pages
    // (ceil arrondit au-dessus : 31 projets => 4 pages)
    $nbProjets = \App\Models\projetsModel\countAll($connexion);
    $nbPages = max(1, (int) ceil($nbProjets / $parPage));

    // je récupère la page demandée dans l'URL (page 1 par défaut)
    // et je la garde entre 1 et le nombre de pages
    $page = (int) ($_GET['page'] ?? 1);
    if ($page < 1) $page = 1;
    if ($page > $nbPages) $page = $nbPages;

    // je calcule combien de projets il faut sauter, puis je demande ceux de la page
    $offset = ($page - 1) * $parPage;
    $projets = \App\Models\projetsModel\findAll($connexion, $parPage, $offset);
    $title = "Creatif";

    global $content, $showHeader;
    $showHeader = true;

    ob_start();
    include '../app/views/projets/index.php';
    $content = ob_get_clean();
}

function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\projetsModel\findOneByID($connexion, $id);
    $title = $projet['titre'];

    // je vais chercher les tags par projets
    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\tagsModel\findAllByProjet($connexion, $id);

    // je charge la vue show 
    global $content;
    ob_start();
    include '../app/views/projets/show.php';
    $content = ob_get_clean();
}


function addformAction(PDO $connexion)
{
    // je vais chercher les creatifs
    include '../app/models/creatifsModel.php';
    $creatifs = \App\Models\creatifsModel\findAll($connexion);

    // je vais chercher les tags

    include '../app/models/tagsModel.php';
    $tags = \App\Models\tagsModel\findAll($connexion);

    global $content;
    ob_start();
    include '../app/views/projets/addform.php';
    $content = ob_get_clean();
}

function addInsertAction(PDO $connexion)

{
    // je demande au model d'ajouter le projet
    include_once '../app/models/projetsModel.php';
    $id = \App\Models\projetsModel\insertOne($connexion, $_POST);

    // je demande au model d'ajouter les tags correspondants
    foreach ($_POST['tags'] as $tagID) {
        $return = \App\Models\projetsModel\insertTagById($connexion, [
            'projetID' => $id,
            'tagID' => $tagID
        ]);
    }


    // je redirige vers la page d'acceuil
    header('location:' . PUBLIC_BASE_URL);
    exit;
}

function deleteAction(PDO $connexion, int $id)
{
    // je demande au model de supprimer les liaison n-m correspondante
    include_once '../app/models/projetsModel.php';
    $return1 = \App\Models\projetsModel\deleteProjetsHasTagsByProjetId($connexion, $id);

    // je demande au model de supprimer le projet 

    $return = \App\Models\projetsModel\deleteOneById($connexion, $id);

    // je redirige vers l'acceuil
    header('location:' . PUBLIC_BASE_URL);
    exit;
}

function editFormAction(PDO $connexion, int $id)
{
    //je demande au model le projet à afficher dans le formulaire 
    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\projetsModel\findOneByID($connexion, $id);

    // je vais chercher les creatifs
    include '../app/models/creatifsModel.php';
    $creatifs = \App\Models\creatifsModel\findAll($connexion);

    //je demande au model les tags par projetID
    include '../app/models/tagsModel.php';
    $tags = \App\Models\tagsModel\findAll($connexion,);

    // je récupère les id des tags déjà liés au projet (pour savoir lesquels cocher)
    $tagsDuProjet = array_column(\App\Models\tagsModel\findAllByProjet($connexion, $id), 'id');

    // je charge la vue editform dans $content

    global $content;
    ob_start();
    include '../app/views/projets/editForm.php';
    $content = ob_get_clean();
}

function editUpdateAction(PDO $connexion, int $id)
{
    // je demande au model de supprimer tout les tags correspondants

    include_once '../app/models/projetsModel.php';
    $return1 = \App\Models\projetsModel\deleteProjetsHasTagsByProjetId($connexion, $id);

    // je demande au model de modifier le projet

    $return2 = \App\Models\projetsModel\updateOneById($connexion, $id, $_POST);

    //je demande au model d'ajouter les tags correspondants

    foreach ($_POST['tags'] as $tagID) {
        $return = \App\Models\projetsModel\insertTagById($connexion, [
            'projetID' => $id,
            'tagID' => $tagID
        ]);
    }

    //je redirige vers la page accueil 
    header('location:' . PUBLIC_BASE_URL);
    exit;
}
