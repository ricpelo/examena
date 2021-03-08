<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "albumes".
 *
 * @property int $id
 * @property string|null $titulo
 * @property float|null $anyo
 *
 * @property AlbumesTemas[] $albumesTemas
 * @property Temas[] $temas
 */
class Albumes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'albumes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anyo'], 'number'],
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
        ];
    }

    /**
     * Gets query for [[AlbumesTemas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumesTemas()
    {
        return $this->hasMany(AlbumesTemas::class, ['albumes_id' => 'id'])->inverseOf('album');
    }

    /**
     * Gets query for [[Temas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemas()
    {
        return $this->hasMany(Temas::class, ['id' => 'temas_id'])->viaTable('albumes_temas', ['albumes_id' => 'id']);
    }
}
