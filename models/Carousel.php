<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property mixed|string|null $titulo
 * @property mixed|string|null $descripcion
 * @property mixed|string|null $imagen
 * @property mixed|null $fecha_activacion
 * @property mixed|null $fecha_desactivacion
 */
class Carousel extends ActiveRecord
{
    public static function tableName()
    {
        return 'carousel';
    }
}