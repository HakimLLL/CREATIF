<?php


namespace App\Models\projetsModel;

use \PDO;

// je recupere les 10 projets les plus recénts

function findAll(PDO $connexion, int $limit = 10)
{
    // ATTENTION: projets et creatifs ont tous les deux une colonne "id" et "image".
    // Avec SELECT * le c.id écrasait le p.id => les liens pointaient vers le mauvais projet.
    // On prend donc toutes les colonnes du projet (p.*) + seulement ce qu'il faut du créatif.
    $sql = "SELECT p.*, p.image AS projet_image,
                   c.id AS creatif_id, c.pseudo, c.image AS creatif_image
        FROM projets p
        JOIN creatifs c ON p.creatif = c.id
        ORDER BY p.dateCreation DESC
        LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}


function findOneByID(PDO $connexion, int $id): array
{
    // Même principe que findAll(): pas de SELECT * pour éviter le conflit sur "id"
    $sql = "SELECT p.*, p.image AS projet_image,
                   c.id AS creatif_id, c.pseudo, c.image AS creatif_image
        FROM projets p
        JOIN creatifs c ON p.creatif = c.id
        WHERE p.id = :id";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetch(PDO::FETCH_ASSOC);
}


function insertOne(PDO $connexion, array $data): int
{
    $sql = "INSERT INTO projets
            SET titre  = :titre,
                texte  = :texte,
                creatif = :creatif,
                DateCreation = NOW();";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':titre', $data['titre'], \PDO::PARAM_STR);
    $rs->bindValue(':texte', $data['texte'], \PDO::PARAM_STR);
    $rs->bindValue(':creatif', $data['creatif'], \PDO::PARAM_INT);
    $rs->execute();
    return $connexion->lastInsertId();
}

function insertTagById(PDO $connexion, array $data)
{
    $sql = "INSERT into projets_has_tags
            SET projet = :projet,
                tag = :tag;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':projet', $data['projetID'], \PDO::PARAM_INT);
    $rs->bindValue(':tag', $data['tagID'], \PDO::PARAM_INT);
    return  $rs->execute();
}

function deleteProjetsHasTagsByProjetId(PDO $connexion, int $projetID): bool
{
    $sql = "DELETE from projets_has_tags
            where projet = :projet";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':projet', $projetID, \PDO::PARAM_INT);
    return  $rs->execute();
}

function deleteOneById(PDO $connexion, int $id): bool
{
    $sql = "DELETE from projets
            where id = :id";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    return  $rs->execute();
}
