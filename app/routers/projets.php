<?php

use \app\Controllers\ProjetsController;

include_once "../app/controllers/projetsController.php";


switch ($_GET['projets']):
    case 'show':
        ProjetsController\showAction($connexion, $_GET['id']);
        break;

    case 'addForm':
        ProjetsController\addformAction($connexion);
        break;
    case 'addInsert':

        ProjetsController\addInsertAction($connexion); /*, [
            'titre' => $_POST['titre'],
            'texte' => $_POST['texte'],
            'creatif' => $_POST['creatif']
        ]*/
        break;
    case 'delete':

        ProjetsController\deleteAction($connexion, $_GET['id']);
        break;
    case 'editForm':
        ProjetsController\editFormAction($connexion, $_GET['id']);
        break;

    default:
        ProjetsController\indexAction($connexion);
        break;

endswitch;
