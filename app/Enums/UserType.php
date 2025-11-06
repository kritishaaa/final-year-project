<?php

namespace App\Enums;

enum UserType: string
{
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
    case COURIER = 'courier';
}
