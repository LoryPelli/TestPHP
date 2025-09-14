<?php require_once sprintf('%s/src/utils/inline.php', $root); ?>
<script>
const show = '<?= inline('svg/show.php') ?>';
const hide = '<?= inline('svg/hide.php') ?>';
const capslock = '<?= inline('svg/capslock.php') ?>';
const disabledcapslock = '<?= inline('svg/disabledcapslock.php') ?>';
</script>