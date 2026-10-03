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


// je prend tout les tags par projets
function findAllByProjet(PDO $connexion, int $projetId): array
{
    $sql = "SELECT *
            FROM tags t
            JOIN projets_has_tags pt ON pt.tag = t.id
            WHERE pt.projet = :projet
            ORDER BY t.nom ASC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':projet', $projetId, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
