<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $authors=Author::find()->all();
        $books=Book::find()->all();
        return $this->render('index',[
            'authors'=>$authors,
            'books'=>$books
        ]);
    }
}
