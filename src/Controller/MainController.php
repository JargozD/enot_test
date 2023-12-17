<?php

namespace App\Controller;

use App\Helper\Template;
use App\Repository\CurrenciesRepository;

class MainController extends BaseController
{
    public function calculator()
    {
        $params = $this->request->getParams();

        $from1 = $params['from1'] ?? null;
        $to1 = $params['to1'] ?? null;
        $forma1 = isset($params['forma1']);
        $result1 = '';
        $errors1 = [];

        $currencies = (new CurrenciesRepository)->getAllTable();
        $courses = array_column($currencies, 'course', 'letter_code');

        if ($forma1) {
            if ($from1 && !is_numeric($from1)) {
                $errors1[] = 'Введите число';
            } elseif (!isset($courses[$to1])) {
                $errors1[] = 'Выберите валюту';
            } elseif ($from1) {
                $result1 = $from1 / $courses[$to1];
            }
        }

        $from2 = $params['from2'] ?? null;
        $to2 = $params['to2'] ?? null;
        $forma2 = isset($params['forma2']);
        $result2 = '';
        $errors2 = [];

        if ($forma2) {
            if ($from2 && !is_numeric($from2)) {
                $errors2[] = 'Введите число';
            } elseif (!isset($courses[$to2])) {
                $errors2[] = 'Выберите валюту';
            } elseif ($from2) {
                $result2 = $from2 * $courses[$to2];
            }
        }

        Template::render(
            "calculator.php",
            [
                'currencies' => $currencies,

                'from1' => $from1,
                'to1' => $to1,
                'result1' => $result1,
                'errors1' => $errors1,

                'from2' => $from2,
                'to2' => $to2,
                'result2' => $result2,
                'errors2' => $errors2
            ]
        );
    }
}
