<?php

namespace App\Repository;

class UsersRepository extends BaseRepository
{
    protected const TABLE = 'users';

    protected const FIELDS = [
        'id',
        'login',
        'password_hash'
    ];
}