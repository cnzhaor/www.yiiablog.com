<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class HelloController extends Controller
{
    public function actionIndex()
    {
       echo 'Hello world!';
    }
}