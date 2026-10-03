<?php

/** @var array $projets */ ?>


<!-- Colonne principale -->


<!-- Projet 1 -->
<?php foreach ($projets as $projet): ?>
    <article class="ct-card">
        <div class="row">
            <div class="col-md-4">
                <a href="projets/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html">
                    <img class=" img-fluid mb-3 mb-md-0" src="images/<?php echo $projet['projet_image']; ?>"
                        alt="<?php echo $projet['titre']; ?>" />
                </a>
            </div>
            <div class="col-md-8">
                <h3><a href="projets/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html"><?php echo $projet['titre']; ?></a></h3>
                <p class="ct-byline">par <a href="#"><?php echo $projet['pseudo']; ?></a> ·
                    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'd'); ?>
                    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'M'); ?>
                    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'Y'); ?>
                </p>


                <p><?php echo \core\Helpers\truncate($projet['texte']); ?></p>
                <a class="ct-btn ct-btn--primary ct-btn--sm" href="projets/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html">Voir le projet</a>
            </div>
        </div>
    </article>

<?php endforeach; ?>



<!-- Pagination : 10 projets par page -->
<!-- $page = page actuelle, $nbPages = nombre total de pages (calculés dans le contrôleur) -->
<nav aria-label="Navigation entre les pages de projets">
    <ul class="pagination ct-pagination" style="justify-content: center">

        <!-- Précédent : désactivé sur la première page -->
        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="page/<?php echo $page - 1; ?>.html">Précédent</a>
        </li>

        <!-- Un lien par page ; la page actuelle est mise en évidence avec "active" -->
        <?php for ($i = 1; $i <= $nbPages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="page/<?php echo $i; ?>.html"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <!-- Suivant : désactivé sur la dernière page -->
        <li class="page-item <?php if ($page >= $nbPages) echo 'disabled'; ?>">
            <a class="page-link" href="page/<?php echo $page + 1; ?>.html">Suivant</a>
        </li>

    </ul>
</nav>