<?php

namespace App\Enums;

enum UserTypes: string
{
    case CENTRAL = '1';
    case INSTRUCTOR = '2';
    case STUDENT = '3';
    case GUEST = '4';
    case ADMIN = '5';
}
