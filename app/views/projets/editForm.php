<?php

/** @var array $creatifs $*/
/** @var array $tags $*/
/** @var array $projet $*/
/** @var array $tagsDuProjet $*/
?>



<!--
            Ce même gabarit visuel sert à la fois pour :
            
            /projets/id/slug/edit/form.html  (modification — champs pré-remplis par le contrôleur)
          -->
<h1 class="mb-4">Modifier un projet</h1>

<form action="projets/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>/edit/update.html" method="post" enctype="multipart/form-data" class="ct-form-card">
    <label for="title">Titre du projet</label>
    <input
        type="text"
        name="titre"
        id="title"
        value="<?php echo $projet['titre']; ?>"
        class="form-control"
        placeholder="" />

    <label for="text">Description</label>
    <textarea
        id="text"
        name="texte"
        class="form-control"
        rows="5"><?php echo $projet['texte']; ?></textarea>

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
            <option value="<?php echo $creatif['id']; ?>" <?php if ($creatif['id'] == $projet['creatif']) echo 'selected'; ?>><?php echo $creatif['pseudo']; ?></option>
        <?php endforeach; ?>
    </select>

    <label>Tags <span style="font-weight:400;font-size:.8rem;color:#4a3a5a">(facultatif)</span></label>
    <div class="ct-tag-choice">
        <?php foreach ($tags as $tag): ?>
            <label><input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>" <?php if (in_array($tag['id'], $tagsDuProjet)) echo 'checked'; ?>><?php echo $tag['nom']; ?></label>
        <?php endforeach; ?>
    </div>

    <div>
        <input class="ct-btn ct-btn--primary" type="submit" value="Enregistrer" />
        <input class="ct-btn ct-btn--ghost" type="reset" value="Réinitialiser" />
    </div>
</form>