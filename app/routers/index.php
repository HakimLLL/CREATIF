<?php

// ROUTE PAR DÉFAUT: Les 10 derniers ptojets
// PATTERN: /
// URL: ?
// CTRL: projetsController
// ACTION: index

include_once '../app/controllers/projetsController.php';
\App\Controllers\ProjetsController\indexAction($connexion);
