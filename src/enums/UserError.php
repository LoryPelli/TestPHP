<?php
enum UserError: string
{
    case ALREADY_EXISTS = 'This email already exists in the database';
    case NOT_FOUND = 'User not found';
}
$messages = [
    'already_exists' => UserError::ALREADY_EXISTS->value,
    'not_found' => UserError::NOT_FOUND->value,
];
?>
