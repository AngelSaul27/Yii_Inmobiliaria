<?php

namespace app\models;

use yii\base\Model;

class CitaForm extends Model
{
    public $user_id, $id, $fecha_cita;

    public function rules(): array
    {
        return [
            [['id', 'fecha_cita'], 'required'],
            ['fecha_cita', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto'],
            ['fecha_cita', 'validateFechaCita'],
        ];
    }

    public function validateFechaCita($attribute, $params, $validator)
    {
        $fechaCita = strtotime($this->$attribute);
        $fechaActual = strtotime(date('Y-m-d'));

        if ($fechaCita <= $fechaActual) {
            $this->addError($attribute, 'La fecha de la cita debe ser mayor que la fecha actual.');
        }
    }

    public function assignedCita(): bool
    {
        if($this->validate()){
            $cita = Cita::findOne(['id' => $this->id]);
            $cita->fecha_cita = $this->fecha_cita;
            $cita->updated_at = date('Y-m-d H:i:s');

            if($cita->save()){
                return true;
            }
        }
        return false;
    }

    public static function registerCita($inmueble_id): bool
    {
        if(!Cita::isRegistered($inmueble_id)){
            $model = new Cita();
            $model->user_id = \Yii::$app->user->id;
            $model->inmueble_id = $inmueble_id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');

            if($model->save()){
                return true;
            }
        }

        return false;
    }


}