<?php

use \app\Controllers\ProjetsController;

include_once "../app/controllers/projetsController.php";


switch ($_GET['projets']):
    case 'show':
        ProjetsController\showAction($connexion, $_GET['id']);
        break;

    case 'addform':
    default:
        ProjetsController\addformAction($connexion);
        break;

endswitch;
