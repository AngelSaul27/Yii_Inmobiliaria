<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property mixed|null $inmueble_id
 * @property int|mixed|string|null $user_id
 * @property false|mixed|string|null $created_at
 * @property false|mixed|string|null $updated_at
 */
class Cita extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cita';
    }

    public static function isRegistered($inmueble_id): bool
    {
        return (bool)parent::findOne(['user_id' => \Yii::$app->user->id, 'inmueble_id' => $inmueble_id]);
    }

    public function getInmueble()
    {
        return $this->hasOne(Inmueble::class, ['id' => 'inmueble_id']);
    }
}