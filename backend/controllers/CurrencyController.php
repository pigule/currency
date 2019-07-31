<?php
namespace backend\controllers;

use common\models\Currency;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;

class CurrencyController extends BaseRestController
{

    public $allowActions = [];
    public $modelClass = Currency::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * Получить список курсов валют
     * @return ActiveDataProvider
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Currency::find(),
            'pagination' => [
                'defaultPageSize' => 10
            ]
        ]);

        return $dataProvider;
    }

    /**
     * Получить курс валюты по id
     * @param $id
     * @return null|static
     * @throws HttpException
     */
    public function actionView($id) {
        $currency = Currency::findOne(['id' => $id]);

        if (empty($currency)) {
            throw new HttpException(404, "Currency not found");
        }

        return $currency;
    }
}