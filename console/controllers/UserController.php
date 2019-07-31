<?php

namespace console\controllers;

use common\models\User;
use \yii\console\Controller;
use yii\helpers\Console;

class UserController extends Controller
{
    public function actionCreate($email, $password) {
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->auth_token = \Yii::$app->security->generateRandomString();

       if( $user->validate()) {
           if ($user->save()) {
               $this->stdout("Пользователь создан token:   " . $user->auth_token . "\n", Console::FG_GREEN);
           }
       } else {
           $this->stdout("Ошибка валидации\n", Console::FG_RED);
       }
    }
}