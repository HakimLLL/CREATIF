<?php


namespace App\Models\tagsModel;

use \PDO;

function findAll(PDO $connexion): array
{

    $sql = "SELECT *
            from tags
            order by nom asc;";

    $rs = $connexion->prepare($sql);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
