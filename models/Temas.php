<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temas".
 *
 * @property int $id
 * @property string|null $titulo
 * @property float|null $anyo
 * @property string|null $duracion
 *
 * @property AlbumesTemas[] $albumesTemas
 * @property Albumes[] $albumes
 * @property ArtistasTemas[] $artistasTemas
 * @property Artistas[] $artistas
 */
class Temas extends \yii\db\ActiveRecord
{
    // public $countArtistas;
    // public $countAlbumes;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anyo'], 'number'],
            [['duracion'], 'string'],
            [['titulo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'anyo' => 'Anyo',
            'duracion' => 'Duracion',
            'countArtistas' => 'Núm. artistas',
            'countAlbumes' => 'Núm. álbumes',
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'countArtistas',
            'countAlbumes',
        ]);
    }

    public function getCountArtistas()
    {
        return $this->getArtistas()->count();
    }

    public function getCountAlbumes()
    {
        return $this->getAlbumes()->count();
    }

    /**
     * Gets query for [[AlbumesTemas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumesTemas()
    {
        return $this->hasMany(AlbumesTemas::class, ['temas_id' => 'id'])->inverseOf('tema');
    }

    /**
     * Gets query for [[Albumes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumes()
    {
        return $this->hasMany(Albumes::class, ['id' => 'albumes_id'])->viaTable('albumes_temas', ['temas_id' => 'id']);
    }

    /**
     * Gets query for [[ArtistasTemas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArtistasTemas()
    {
        return $this->hasMany(ArtistasTemas::class, ['temas_id' => 'id'])->inverseOf('tema');
    }

    /**
     * Gets query for [[Artistas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArtistas()
    {
        return $this->hasMany(Artistas::class, ['id' => 'artistas_id'])->viaTable('artistas_temas', ['temas_id' => 'id']);
    }
}
