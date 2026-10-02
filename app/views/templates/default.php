<!DOCTYPE html>
<html lang="fr">


<head>
    <?php include '../app/views/templates/partials/_head.php'; ?>
</head>

<body>

    <?php include '../app/views/templates/partials/_nav.php'; ?>

    <?php if ($showHeader) include '../app/views/templates/partials/_header.php'; ?>

    <div class="container ct-content-wrap">
        <div class="row">
            <?php include '../app/views/templates/partials/_main.php'; ?> <!-- <div class="col-lg-8"> … </div> -->
            <?php include '../app/views/templates/partials/_aside.php'; ?> <!-- <div class="col-lg-4"> … </div> -->
        </div>
    </div>

    <?php include '../app/views/templates/partials/_footer.php'; ?>

    <?php include '../app/views/templates/partials/_scripts.php'; ?>

</body>


</html>