<!--
            Ce même gabarit visuel sert à la fois pour :
            /projects/add/form.html          (ajout — champs vides)
            /projets/id/slug/edit/form.html  (modification — champs pré-remplis par le contrôleur)
          -->
<h1 class="mb-4">Ajouter un projet</h1>

<form action="" method="post" enctype="multipart/form-data" class="ct-form-card">
    <label for="title">Titre du projet</label>
    <input
        type="text"
        name="title"
        id="title"
        class="form-control"
        placeholder="Ex : Frange Kamikaze" />

    <label for="text">Description</label>
    <textarea
        id="text"
        name="text"
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
    <select id="category" name="category_id" class="form-control">
        <option disabled selected>Sélectionnez le créa'tif</option>
        <option value="1">Mister Univ'Hair</option>
        <option value="2">Leerdam'Hair</option>
        <option value="3">Séda'Tifs</option>
        <option value="4">Jupil'Hair</option>
    </select>

    <label>Tags <span style="font-weight:400;font-size:.8rem;color:#4a3a5a">(facultatif)</span></label>
    <div class="ct-tag-choice">
        <label><input type="checkbox" name="tags[]" value="1" /> Vintage</label>
        <label><input type="checkbox" name="tags[]" value="2" /> Alimentation</label>
        <label><input type="checkbox" name="tags[]" value="3" /> Géométrie</label>
        <label><input type="checkbox" name="tags[]" value="4" /> Couleur</label>
        <label><input type="checkbox" name="tags[]" value="5" /> Figuratif</label>
        <label><input type="checkbox" name="tags[]" value="6" /> Baptême</label>
        <label><input type="checkbox" name="tags[]" value="7" /> Abstract</label>
        <label><input type="checkbox" name="tags[]" value="8" /> Inclassable</label>
    </div>

    <div>
        <input class="ct-btn ct-btn--primary" type="submit" value="Enregistrer" />
        <input class="ct-btn ct-btn--ghost" type="reset" value="Réinitialiser" />
    </div>
</form>