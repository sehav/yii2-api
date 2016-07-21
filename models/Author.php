<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $name
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getBooks(){
        return $this->hasMany(Book::className(),['id'=>'book_id'])
            ->viaTable('authors_books',['author_id'=>'id']);
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
