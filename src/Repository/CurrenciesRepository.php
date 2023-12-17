<?php

namespace App\Repository;

class CurrenciesRepository extends BaseRepository
{
    protected const TABLE = 'currencies';

    protected const FIELDS = [
        'id',
        'digit_code',
        'letter_code',
        'name',
        'course'
    ];
}