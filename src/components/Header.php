<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <?php if (isset($title)): ?>
            <title>TestPHP - <?= $title ?></title>
        <?php else: ?>
            <title>TestPHP</title>
        <?php endif; ?>
        <?php if (isset($description)): ?>
            <meta name="description" content="<?= $description ?>" />
        <?php endif; ?>
        <script src="https://cdn.tailwindcss.com/"></script>
    </head>
</html>
