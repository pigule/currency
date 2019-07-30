<?php

namespace backend\controllers;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\Response;


class BaseRestController extends ActiveController
{

    /**
     * Действия доступные без аутентификации
     * @var array
     */
    public $allowActions = [];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Max-Age' => 3600,
                ],
            ],
            'authenticator' => [
                'class' =>  HttpBearerAuth::className(),
                'except' => $this->allowActions
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats'=> [
                    'text/html' => Response::FORMAT_JSON,
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }

}