<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artistas".
 *
 * @property int $id
 * @property string|null $nombre
 *
 * @property ArtistasTemas[] $artistasTemas
 * @property Temas[] $temas
 */
class Artistas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artistas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[ArtistasTemas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArtistasTemas()
    {
        return $this->hasMany(ArtistasTemas::class, ['artistas_id' => 'id'])->inverseOf('artista');
    }

    /**
     * Gets query for [[Temas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemas()
    {
        return $this->hasMany(Temas::class, ['id' => 'temas_id'])->viaTable('artistas_temas', ['artistas_id' => 'id']);
    }

    public function getAlbumesTemas()
    {
        return $this->hasMany(AlbumesTemas::class, ['temas_id' => 'id'])
            ->via('temas');
    }

    public function getAlbumes()
    {
        return $this->hasMany(Albumes::class, ['id' => 'albumes_id'])
            ->via('albumesTemas');
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        
        foreach ($this->temas as $tema) {
            if ($tema->getAlbumes()->exists()) {
                return false;
            }
        }

        return true;
    }
}
