<?php
enum TodoError: string
{
    case ALREADY_EXISTS = 'A todo with that name already exists in your account';
    case NAME_TOO_LONG = 'The todo name is too long';
    case DESCRIPTION_TOO_LONG = 'The todo description is too long';
}

return array_combine(
    array_map(fn(TodoError $c) => strtolower($c->name), TodoError::cases()),
    array_map(fn(TodoError $c) => $c->value, TodoError::cases()),
);
