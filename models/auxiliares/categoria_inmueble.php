<?php

namespace app\models\auxiliares;

use yii\db\ActiveRecord;

class categoria_inmueble extends ActiveRecord
{
    public static function tableName(): string
    {
        return parent::tableName(); // TODO: Change the autogenerated stub
    }

    public static function getCategoria($id){
        return parent::find()->select('categoria')->where(['id' => $id])->scalar();
    }
}