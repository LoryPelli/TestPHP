<?php
$skip = isset($_GET['skip-confirmation']);
if (!$skip) {
    require_once 'src/enums/Type.php';
    $type = Type::Delete;
    include_once 'src/components/Confirmation.php';
    exit(0);
}
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/delete">
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Delete!</button>
</form>