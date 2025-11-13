<?php
function is_api_key_valid(): bool
{
    global $resend;
    try {
        $resend->emails->send([
            'from' => $_ENV['EMAIL'],
            'to' => $_ENV['EMAIL'],
            'subject' => 'Test',
            'text' => 'Test',
        ]);
        return true;
    } catch (Exception) {
        return false;
    }
}
