<?php

use \app\Controllers\ProjetsController;

include_once "../app/controllers/projetsController.php";


switch ($_GET['projets']):

        // ROUTE DÉTAIL D'UN PROJET
        // PATTERN: /projets/id/slug.html
        // URL: ?projets=show&id=x
        // CTRL: projetsController
        // ACTION: show
    case 'show':
        ProjetsController\showAction($connexion, $_GET['id']);
        break;

    // ROUTE FORMULAIRE D'AJOUT D'UN PROJET
    // PATTERN: /projets/add/form.html
    // URL: ?projets=addForm
    // CTRL: projetsController
    // ACTION: addForm
    case 'addForm':
        ProjetsController\addformAction($connexion);
        break;

    // ROUTE AJOUT D'UN PROJET 
    // PATTERN: /projets/add/insert.html
    // URL: ?projets=addInsert
    // CTRL: projetsController
    // ACTION: addInsert
    case 'addInsert':
        ProjetsController\addInsertAction($connexion);
        break;

    // ROUTE FORMULAIRE DE MODIFICATION D'UN PROJET
    // PATTERN: /projets/id/slug/edit/form.html
    // URL: ?projets=editForm&id=x
    // CTRL: projetsController
    // ACTION: editForm
    case 'editForm':
        ProjetsController\editFormAction($connexion, $_GET['id']);
        break;

    // ROUTE MODIFICATION D'UN PROJET 
    // PATTERN: /projets/id/slug/edit/update.html
    // URL: ?projets=editUpdate&id=x
    // CTRL: projetsController
    // ACTION: editUpdate
    case 'editUpdate':
        ProjetsController\editUpdateAction($connexion, $_GET['id']);
        break;

    // ROUTE SUPPRESSION D'UN PROJET + redirection vers l'accueil
    // PATTERN: /projets/delete/id/slug.html
    // URL: ?projets=delete&id=x
    // CTRL: projetsController
    // ACTION: delete
    case 'delete':
        ProjetsController\deleteAction($connexion, $_GET['id']);
        break;

    // ROUTE PAR DÉFAUT:les 10 derniers projets
    // PATTERN: -
    // URL: ?projets=xxx 
    // CTRL: projetsController
    // ACTION: index
    default:
        ProjetsController\indexAction($connexion);
        break;

endswitch;
