<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%albumes_temas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%albumes}}`
 * - `{{%temas}}`
 */
class m210308_163942_create_junction_table_for_albumes_and_temas_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%albumes_temas}}', [
            'albumes_id' => $this->bigInteger(),
            'temas_id' => $this->bigInteger(),
            'PRIMARY KEY(albumes_id, temas_id)',
        ]);

        // creates index for column `albumes_id`
        $this->createIndex(
            '{{%idx-albumes_temas-albumes_id}}',
            '{{%albumes_temas}}',
            'albumes_id'
        );

        // add foreign key for table `{{%albumes}}`
        $this->addForeignKey(
            '{{%fk-albumes_temas-albumes_id}}',
            '{{%albumes_temas}}',
            'albumes_id',
            '{{%albumes}}',
            'id',
            'CASCADE'
        );

        // creates index for column `temas_id`
        $this->createIndex(
            '{{%idx-albumes_temas-temas_id}}',
            '{{%albumes_temas}}',
            'temas_id'
        );

        // add foreign key for table `{{%temas}}`
        $this->addForeignKey(
            '{{%fk-albumes_temas-temas_id}}',
            '{{%albumes_temas}}',
            'temas_id',
            '{{%temas}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%albumes}}`
        $this->dropForeignKey(
            '{{%fk-albumes_temas-albumes_id}}',
            '{{%albumes_temas}}'
        );

        // drops index for column `albumes_id`
        $this->dropIndex(
            '{{%idx-albumes_temas-albumes_id}}',
            '{{%albumes_temas}}'
        );

        // drops foreign key for table `{{%temas}}`
        $this->dropForeignKey(
            '{{%fk-albumes_temas-temas_id}}',
            '{{%albumes_temas}}'
        );

        // drops index for column `temas_id`
        $this->dropIndex(
            '{{%idx-albumes_temas-temas_id}}',
            '{{%albumes_temas}}'
        );

        $this->dropTable('{{%albumes_temas}}');
    }
}
