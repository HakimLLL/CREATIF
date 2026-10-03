<?php

/** @var array $creatifs $*/
/** @var array $tags $*/ ?>


<!--
            Ce même gabarit visuel sert à la fois pour :
            /projects/add/form.html          (ajout — champs vides)
            /projets/id/slug/edit/form.html  (modification — champs pré-remplis par le contrôleur)
          -->
<h1 class="mb-4">Ajouter un projet</h1>

<form action="projets/add/insert.html" method="post" enctype="multipart/form-data" class="ct-form-card">
    <label for="title">Titre du projet</label>
    <input
        type="text"
        name="titre"
        id="title"
        class="form-control"
        placeholder="Ex : Frange Kamikaze" />

    <label for="text">Description</label>
    <textarea
        id="text"
        name="texte"
        class="form-control"
        rows="5"
        placeholder="Racontez l'histoire (courageuse) de ce projet..."></textarea>

    <label for="creatif-file">Photo du résultat</label>
    <div class="ct-dropzone">
        ✂️ Glissez une image ou choisissez-la ci-dessous
        <input
            type="file"
            class="form-control-file"
            id="creatif-file"
            name="image" />
    </div>

    <label for="category">Créa'tif</label>
    <select id="category" name="creatif" class="form-control">
        <?php foreach ($creatifs as $creatif): ?>
            <option value="<?php echo $creatif['id'] ?>"><?php echo $creatif['pseudo'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Tags <span style="font-weight:400;font-size:.8rem;color:#4a3a5a">(facultatif)</span></label>
    <div class="ct-tag-choice">
        <?php foreach ($tags as $tag): ?>
            <label><input type="checkbox" name="tags[]" value="<?php echo $tag['id'] ?>"><?php echo $tag['nom'] ?></label>
        <?php endforeach; ?>
    </div>

    <div>
        <input class="ct-btn ct-btn--primary" type="submit" value="Enregistrer" />
        <input class="ct-btn ct-btn--ghost" type="reset" value="Réinitialiser" />
    </div>
</form>