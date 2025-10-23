<?php
enum UserError: string
{
    case ALREADY_EXISTS = 'This email already exists in the database';
    case NOT_FOUND = 'User not found';
    case INVALID_EMAIL = 'The email is not valid';
    case INCORRECT_PASSWORD = 'The user exists but the password is not correct';
    case EMAILS_NOT_MATCH = 'Emails do not match';
    case PASSWORDS_NOT_MATCH = 'Passwords do not match';
    case WRONG_CODE = 'Your verification code is not valid';
    case EXPIRED = 'Verification code expired';
    case INVALID_URL = 'The URL is not valid';
    case INVALID_IMAGE = 'The image you provided is not valid';
    case USERNAME_TOO_LONG = 'The username is too long';
    case CF_ERROR = 'Cloudflare verification error';
}

return array_combine(
    array_map(fn(UserError $c) => strtolower($c->name), UserError::cases()),
    array_map(fn(UserError $c) => $c->value, UserError::cases()),
);
