<?php
function turnstile(string $action): void
{
    $c = new GuzzleHttp\Client();
    try {
        $res = $c->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'form_params' => [
                    'secret' => $_ENV['PRIVATEKEY'],
                    'response' => $_POST['cf-turnstile-response'] ?? '',
                ],
            ],
        );
        $body = json_decode($res->getBody());
        if (!$body->success) {
            $_SESSION['error'] = 'cf_error';
            redirect(sprintf('/%s', $action));
            exit(1);
        }
    } catch (Exception) {
        $_SESSION['error'] = 'cf_error';
        redirect(sprintf('/%s', $action));
        exit(1);
    }
}
