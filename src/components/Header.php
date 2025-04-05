<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="/favicon.ico" />
    <?php if (isset($title)): ?>
    <title>TestPHP - <?= $title ?></title>
    <meta name="og:title" content="TestPHP - <?= $title ?>" />
    <?php else: ?>
    <title>TestPHP</title>
    <?php endif; ?>
    <?php if (isset($description)): ?>
    <meta name="description" content="<?= $description ?>" />
    <meta name="og:description" content="<?= $description ?>" />
    <?php endif; ?>
    <script src="https://cdn.tailwindcss.com/"></script>
</head>
