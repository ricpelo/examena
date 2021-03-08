<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%artistas_temas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%artistas}}`
 * - `{{%temas}}`
 */
class m210308_163952_create_junction_table_for_artistas_and_temas_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%artistas_temas}}', [
            'artistas_id' => $this->integer(),
            'temas_id' => $this->integer(),
            'PRIMARY KEY(artistas_id, temas_id)',
        ]);

        // creates index for column `artistas_id`
        $this->createIndex(
            '{{%idx-artistas_temas-artistas_id}}',
            '{{%artistas_temas}}',
            'artistas_id'
        );

        // add foreign key for table `{{%artistas}}`
        $this->addForeignKey(
            '{{%fk-artistas_temas-artistas_id}}',
            '{{%artistas_temas}}',
            'artistas_id',
            '{{%artistas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `temas_id`
        $this->createIndex(
            '{{%idx-artistas_temas-temas_id}}',
            '{{%artistas_temas}}',
            'temas_id'
        );

        // add foreign key for table `{{%temas}}`
        $this->addForeignKey(
            '{{%fk-artistas_temas-temas_id}}',
            '{{%artistas_temas}}',
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
        // drops foreign key for table `{{%artistas}}`
        $this->dropForeignKey(
            '{{%fk-artistas_temas-artistas_id}}',
            '{{%artistas_temas}}'
        );

        // drops index for column `artistas_id`
        $this->dropIndex(
            '{{%idx-artistas_temas-artistas_id}}',
            '{{%artistas_temas}}'
        );

        // drops foreign key for table `{{%temas}}`
        $this->dropForeignKey(
            '{{%fk-artistas_temas-temas_id}}',
            '{{%artistas_temas}}'
        );

        // drops index for column `temas_id`
        $this->dropIndex(
            '{{%idx-artistas_temas-temas_id}}',
            '{{%artistas_temas}}'
        );

        $this->dropTable('{{%artistas_temas}}');
    }
}
