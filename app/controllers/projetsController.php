<?php


namespace App\Controllers\ProjetsController;

use \PDO;


function indexAction(PDO $connexion)
{
    include_once '../app/models/projetsModel.php';
    $projets = \App\Models\projetsModel\findAll($connexion);
    $title = "Creatif";


    global $content, $showHeader;
    $showHeader = true;

    ob_start();
    include '../app/views/projets/index.php';
    $content = ob_get_clean();
};

function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\projetsModel\findOneByID($connexion, $id);
    $title = $projet['titre'];

    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\tagsModel\findAllByProjet($connexion, $id);

    global $content;
    ob_start();
    include '../app/views/projets/show.php';
    $content = ob_get_clean();
}


function addformAction(PDO $connexion)
{
    // je vais cherches les creatifs
    include '../app/models/creatifsModel.php';
    $creatifs = \App\Models\creatifsModel\findAll($connexion);

    include '../app/models/tagsModel.php';
    $tags = \App\Models\tagsModel\findAll($connexion);


    include '../app/models/projetsModel.php';
    $projet = \App\Models\projetsModel\addForm($connexion);

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

 //function deleteAction(PDO $connexion,int $id){
    // je demande au model de supprimer les liaison n-m correspondante
    // je demande au moedel de supprimer le projet
 //}