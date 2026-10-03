<?php


namespace App\Models\projetsModel;

use \PDO;

// je récupère les projets d'une page : $limit projets, en sautant les $offset premiers
// (page 1 : offset 0, page 2 : offset 10, page 3 : offset 20...)
function findAll(PDO $connexion, int $limit = 10, int $offset = 0)
{
    $sql = "SELECT p.*, p.image AS projet_image,
                   c.id AS creatif_id, c.pseudo, c.image AS creatif_image
        FROM projets p
        JOIN creatifs c ON p.creatif = c.id
        ORDER BY p.dateCreation DESC, p.id DESC
        LIMIT :limit OFFSET :offset;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->bindValue(':offset', $offset, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}


// je compte le nombre total de projets (pour calculer le nombre de pages)
function countAll(PDO $connexion): int
{
    $sql = "SELECT COUNT(*) FROM projets;";

    $rs = $connexion->prepare($sql);
    $rs->execute();
    return $rs->fetchColumn();
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

function updateOneById(PDO $connexion, int $id, array $data): bool
{
    $sql = "UPDATE projets
            set titre = :titre,
                texte   = :texte,
                creatif = :creatif
            where id = :id;";


    $rs = $connexion->prepare($sql);
    $rs->bindValue(':titre', $data['titre'], \PDO::PARAM_STR);
    $rs->bindValue(':texte', $data['texte'], \PDO::PARAM_STR);
    $rs->bindValue(':creatif', $data['creatif'], \PDO::PARAM_INT);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);

    return  $rs->execute();
}
