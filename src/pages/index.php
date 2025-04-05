<?php
require_once 'src/cookies/index.php'; ?>
<nav class="flex justify-between p-2">
    <a href="/">
        <button class="p-1 border-2 border-black rounded-md">Home!</button>
    </a>
    <div>
        <?php if (!$cookies->get('email') || !$cookies->get('password')): ?>
        <a href="/login">
            <button class="p-1 border-2 border-black rounded-md">Login!</button>
        </a>
        <a href="/register">
            <button class="p-1 border-2 border-black rounded-md">Register!</button>
        </a>
        <?php else: ?>
        <img src="/user.png" class="cursor-pointer size-10" />
        <?php endif; ?>
    </div>
</nav>    
