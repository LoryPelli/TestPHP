<script>
    const show = `<?= preg_replace(
        '/\s+/',
        ' ',
        file_get_contents('svg/show.php')
    ) ?>`;
    const hide = `<?= preg_replace(
        '/\s+/',
        ' ',
        file_get_contents('svg/hide.php')
    ) ?>`;
    const capslock = `<?= preg_replace(
        '/\s+/',
        ' ',
        file_get_contents('svg/capslock.php')
    ) ?>`;
    const disabledcapslock = `<?= preg_replace(
        '/\s+/',
        ' ',
        file_get_contents('svg/disabledcapslock.php')
    ) ?>`;
</script>