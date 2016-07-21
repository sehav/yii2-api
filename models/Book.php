<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property string $id
 * @property string $title
 * @property string $isbn
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'coverUrl'], 'required'],
            [['title', 'coverUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'coverUrl' => 'cover',
        ];
    }

    public function getAuthors(){
        return $this->hasMany(Author::className(),['id'=>'author_id'])
            ->viaTable('authors_books',['book_id'=>'id']);
    }

    public function beforeDelete()
    {
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('authors_books', ['book_id' => $this->id])
            ->execute();
        return true;
    }
}
