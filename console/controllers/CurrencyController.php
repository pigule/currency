<?php

namespace console\controllers;

use common\models\Currency;
use \yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class CurrencyController extends Controller
{
    /**
     * Обновление данных в таблице Currency
     * @return int
     */
    public function actionUpdate()
    {
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp');

        if(!$xml)
        {
            $this->stdout("Ошибка парсинга XML\n", Console::FG_RED);
            ExitCode::NOINPUT;
        }

        foreach ($xml->Valute as $item)
        {
            $name = (string) $item->CharCode;
            $rate = str_replace(',', '.', $item->Value) / (double) $item->Nominal;
            $model = Currency::findOne(['name' => $name]);

            if (!$model)
            {
                $model = new Currency();
                $model->name = $name;
            }

            $model->rate = $rate;
            $model->save();
        }

        $this->stdout("Обновление прошло успешно\n", Console::FG_GREEN);

        return ExitCode::OK;
    }
}