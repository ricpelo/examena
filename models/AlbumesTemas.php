<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "albumes_temas".
 *
 * @property int $albumes_id
 * @property int $temas_id
 *
 * @property Albumes $albumes
 * @property Temas $temas
 */
class AlbumesTemas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'albumes_temas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['albumes_id', 'temas_id'], 'required'],
            [['albumes_id', 'temas_id'], 'default', 'value' => null],
            [['albumes_id', 'temas_id'], 'integer'],
            [['albumes_id', 'temas_id'], 'unique', 'targetAttribute' => ['albumes_id', 'temas_id']],
            [['albumes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Albumes::className(), 'targetAttribute' => ['albumes_id' => 'id']],
            [['temas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Temas::className(), 'targetAttribute' => ['temas_id' => 'id']],
            [['albumes_id'], function ($attribute, $params) {
                $tema = Temas::findOne($this->temas_id);
                if (!$tema->getArtistas()->exists()) {
                    $this->addError($attribute, 'El tema que se quiere meter en el álbum debe tener algún artista.');
                }
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'albumes_id' => 'Albumes ID',
            'temas_id' => 'Temas ID',
        ];
    }

    /**
     * Gets query for [[Albumes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Albumes::class, ['id' => 'albumes_id'])->inverseOf('albumesTemas');
    }

    /**
     * Gets query for [[Temas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTema()
    {
        return $this->hasOne(Temas::class, ['id' => 'temas_id'])->inverseOf('albumesTemas');
    }
}
