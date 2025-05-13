<?php
enum TodoError: string
{
    case ALREADY_EXISTS = 'A todo with that name already exists in your account';
    case NAME_TOO_LONG = 'The todo name is too long';
    case DESCRIPTION_TOO_LONG = 'The todo description is too long';
}
return [
    'already_exists' => TodoError::ALREADY_EXISTS->value,
    'name_too_long' => TodoError::NAME_TOO_LONG->value,
    'description_too_long' => TodoError::DESCRIPTION_TOO_LONG->value,
];
