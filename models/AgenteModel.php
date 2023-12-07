<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property mixed|null $correo_contacto
 * @property mixed|null $numero_contacto
 * @property int|mixed|null $user_id
 */
class AgenteModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'agente_venta';
    }

    public static function getId(){
        return parent::find()->select('id')->where(['user_id' => \Yii::$app->user->id])->one();
    }
}