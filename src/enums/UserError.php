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
    case USERNAME_TOO_LONG = 'The username is too long';
}
return [
    'already_exists' => UserError::ALREADY_EXISTS->value,
    'not_found' => UserError::NOT_FOUND->value,
    'invalid_email' => UserError::INVALID_EMAIL->value,
    'incorrect_password' => UserError::INCORRECT_PASSWORD->value,
    'emails_not_match' => UserError::EMAILS_NOT_MATCH->value,
    'passwords_not_match' => UserError::PASSWORDS_NOT_MATCH->value,
    'wrong_code' => UserError::WRONG_CODE->value,
    'expired' => UserError::EXPIRED->value,
    'invalid_url' => UserError::INVALID_URL->value,
    'username_too_long' => UserError::USERNAME_TOO_LONG->value,
];
