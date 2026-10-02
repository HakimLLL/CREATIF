<?php


namespace App\Models\creatifsModel;

use \PDO;

function findAll(PDO $connexion): array
{

    $sql = "SELECT *
            from creatifs
            order by pseudo asc;";

    $rs = $connexion->prepare($sql);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
