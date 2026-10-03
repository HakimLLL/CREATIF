<?php


// ROUTE DETAIL D'UN PROJET
// PATTERN: /projets/id/slug
// URL: ?projets=show&id=x
// CTRL: projetsController
// ACTION: show

if (isset($_GET['projets'])):
    include_once '../app/routers/projets.php';

// ROUTE PAR DÉFAUT: Les 10 derniers projets
// PATTERN: /
// URL: ?
// CTRL: projetsController
// ACTION: index

else:
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\indexAction($connexion);
endif;
