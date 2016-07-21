<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class V1Controller extends Controller
{
    public function actionView($model)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $modelName='app\models\api\Api'.ucfirst(strtolower($model));
        if(class_exists($modelName)){
            $models=$modelName::find()->with($modelName::$relations)->asArray()->all();
            return $models;
        }
        return false;
    }

    public function actionCreate($model)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $modelName='app\models\api\Api'.ucfirst(strtolower($model));
        if(class_exists($modelName)){
            $model=new $modelName();
            if($model->load($_POST)){
                $model->save();
                return $model;
            }
        }
        return false;
    }

    public function actionLink($model1,$model2)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model1Name='app\models\api\Api'.ucfirst(strtolower($model1));
        $model2Name='app\models\api\Api'.ucfirst(strtolower($model2));
        if(class_exists($model1Name) && class_exists($model2Name)){
            $m1=$model1Name::findOne($_POST[strtolower($model1).'_id']);
            $m2=$model2Name::findOne($_POST[strtolower($model2).'_id']);
            $m1->link(strtolower($model2).'s',$m2);
            $link=(new Query())->from('authors_books')
                ->where([
                    strtolower($model1).'_id'=>$m1->id,
                    strtolower($model2).'_id'=>$m2->id
                ])->one();
            return $link;
        }
    }

    public function actionDelete($model,$id)
    {
        $modelName='app\models\api\Api'.ucfirst(strtolower($model));
        if(class_exists($modelName)){
            $model=$modelName::findOne($id);
            if($model){
                $model->delete();
                \Yii::$app->response->statusCode=204;
                return true;
            }
        }
        return false;
    }

    public function actionUpdate($model,$id)
    {
        Yii::$app->controller->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $modelName='app\models\api\Api'.ucfirst(strtolower($model));
        if(class_exists($modelName)){
            $model=$modelName::findOne($id);
            if($model->load($_POST)){
                $model->save();
                return $model;
            }
        }
        return false;
    }
}
