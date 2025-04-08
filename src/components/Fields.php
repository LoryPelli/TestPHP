<?php
require_once 'src/enums/Type.php';
$isLogin = $type == Type::Login;
?>
<span>Email:</span>
<input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md" />
<span>Password:</span>
<input name="password" autocomplete="off" type="password" required class="p-1 border-2 rounded-md" />
<?php if (!$isLogin): ?>
<span>Repeat Password:</span>
<input name="repeat_password" autocomplete="off" type="password" class="p-1 border-2 rounded-md" />
<span>Username:</span>
<input name="username" autocomplete="off" required class="p-1 border-2 rounded-md" />
<?php endif; ?>
