<?php return function () { ?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php foreach ((yield 'styles') ?: [] as $href): ?>
            <link rel="stylesheet" href="<?= $href ?>" />
        <?php endforeach ?>
        <?php foreach ((yield 'scripts') ?: [] as $src): ?>
            <script defer src="<?= $src ?>"></script>
        <?php endforeach ?>
    </head>
    <body>
        <header>
            <?= yield 'header' ?>
        </header>
        <main>
            <?= yield 'main' ?>
        </main>
        <footer class="footer">
            <?= yield 'footer' ?>
        </footer>
    </body>
</html>

<?php } ?>
