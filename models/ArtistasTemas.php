<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artistas_temas".
 *
 * @property int $artistas_id
 * @property int $temas_id
 *
 * @property Artistas $artistas
 * @property Temas $temas
 */
class ArtistasTemas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artistas_temas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['artistas_id', 'temas_id'], 'required'],
            [['artistas_id', 'temas_id'], 'default', 'value' => null],
            [['artistas_id', 'temas_id'], 'integer'],
            [['artistas_id', 'temas_id'], 'unique', 'targetAttribute' => ['artistas_id', 'temas_id']],
            [['artistas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artistas::className(), 'targetAttribute' => ['artistas_id' => 'id']],
            [['temas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Temas::className(), 'targetAttribute' => ['temas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'artistas_id' => 'Artistas ID',
            'temas_id' => 'Temas ID',
        ];
    }

    /**
     * Gets query for [[Artistas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArtista()
    {
        return $this->hasOne(Artistas::class, ['id' => 'artistas_id'])->inverseOf('artistasTemas');
    }

    /**
     * Gets query for [[Temas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTema()
    {
        return $this->hasOne(Temas::class, ['id' => 'temas_id'])->inverseOf('artistasTemas');
    }
}
