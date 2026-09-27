<?php


namespace App\Models\projetsModel;

use \PDO;

// je recupere les 10 projets les plus recénts

function findAll(PDO $connexion, int $limit = 10)
{
    $sql = "SELECT *,p.image as projet_image
        FROM projets p
        JOIN creatifs c ON p.creatif = c.id 
        ORDER BY dateCreation DESC
        LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
