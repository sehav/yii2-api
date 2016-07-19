<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class V1Controller extends Controller
{
    public function actionView()
    {
        return 'view';
    }

    public function actionCreate()
    {
        return 'create';
    }

    public function actionDelete()
    {
        return 'delete';
    }

    public function actionUpdate()
    {
        return 'Update';
    }
}
