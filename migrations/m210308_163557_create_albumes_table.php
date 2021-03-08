<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%albumes}}`.
 */
class m210308_163557_create_albumes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%albumes}}', [
            'id' => $this->bigPrimaryKey(),
            'titulo' => $this->string(),
            'anyo' => $this->decimal(4),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%albumes}}');
    }
}
