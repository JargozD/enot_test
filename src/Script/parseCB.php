<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Repository\CurrenciesRepository;

$repo = new CurrenciesRepository();

$html = file_get_contents("https://www.cbr.ru/currency_base/daily/");

$currencies = [];

preg_match_all(
    '#<tr>.*?<td>(.*?)</td>.*?<td>(.*?)</td>.*?<td>(.*?)</td>.*?<td>(.*?)</td>.*?<td>(.*?)</td>.*?</tr>#ms',
    $html,
    $currencies,
    PREG_SET_ORDER
);

$repo->clearTable();

foreach ($currencies as $curData) {
    $toInsert = [
        'digit_code' => $curData[1],
        'letter_code' => $curData[2],
        'name' => $curData[4],
        'course' => str_replace(',', '.', $curData[5]) / $curData[3]
    ];

    $repo->add($toInsert);
}
