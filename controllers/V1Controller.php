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
    public function actionView($model)
    {
        return 'view '.$model;
    }

    public function actionCreate($model)
    {
        return 'create';
    }

    public function actionDelete($model,$id)
    {
        return 'delete';
    }

    public function actionUpdate($model,$id)
    {
        return 'Update';
    }
}
