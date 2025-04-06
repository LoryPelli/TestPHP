<?php
enum UserError: string
{
    case ALREADY_EXISTS = 'This email already exists in the database';
    case NOT_FOUND = 'User not found';
    case INVALID_EMAIL = 'The email is not in a valid format';
    case INCORRECT_PASSWORD = 'The user exists but the password is not correct';
    case WRONG_CODE = 'Your verification code is not valid';
    case EXPIRED = 'Verification code expired';
}
$messages = [
    'already_exists' => UserError::ALREADY_EXISTS->value,
    'not_found' => UserError::NOT_FOUND->value,
    'invalid_email' => UserError::INVALID_EMAIL->value,
    'incorrect_password' => UserError::INCORRECT_PASSWORD->value,
    'wrong_code' => UserError::WRONG_CODE->value,
    'expired' => UserError::EXPIRED->value,
];
