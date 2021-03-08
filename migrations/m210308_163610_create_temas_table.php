<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%temas}}`.
 */
class m210308_163610_create_temas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%temas}}', [
            'id' => $this->bigPrimaryKey(),
            'titulo' => $this->string(),
            'anyo' => $this->decimal(4),
            'duracion' => 'interval',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%temas}}');
    }
}
