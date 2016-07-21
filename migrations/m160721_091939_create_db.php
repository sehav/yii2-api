<?php

use yii\db\Migration;

/**
 * Handles the creation for table `books`.
 */
class m160721_091939_create_db extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute(file_get_contents(__DIR__ . '/api.sql'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('books');
    }
}
