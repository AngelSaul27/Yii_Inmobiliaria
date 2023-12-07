<?php

namespace app\models;

use yii\db\ActiveRecord;

class Inmueble extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'inmueble';
    }
}