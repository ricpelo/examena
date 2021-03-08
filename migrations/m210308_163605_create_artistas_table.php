<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%artistas}}`.
 */
class m210308_163605_create_artistas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%artistas}}', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%artistas}}');
    }
}
