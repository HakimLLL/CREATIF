<?php


namespace App\Controllers\ProjetsController;

use \PDO;


function indexAction(PDO $connexion)
{
    include_once '../app/models/projetsModel.php';
    $projets = \App\Models\projetsModel\findAll($connexion);
    $title = "Creatif";


    global $content;
    ob_start();
    include '../app/views/projets/index.php';
    $content = ob_get_clean();
}
