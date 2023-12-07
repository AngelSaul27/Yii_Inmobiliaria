<?php

namespace app\models;

use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $email, $username, $password, $imagen;
    public $correo_contacto, $numero_contacto;

    public function rules()
    {
        return [
            [['email', 'username', 'password', 'imagen'], 'required', 'on' => ['usuario', 'agente']],
            [['correo_contacto', 'numero_contacto'], 'required', 'on' => 'agente'],
            [['imagen'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, webp',
                'message' => 'Solo archivos png, jpg y jpeg', 'on' => ['usuario', 'agente']],
            ['email', 'email', 'on' => ['usuario', 'agente']],
            ['correo_contacto', 'email', 'on' => 'agente']
        ];
    }

    public function registerAgente(): bool
    {
        if($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model = new User();
                $model->scenario = 'newUser';

                $model->username = $this->username;
                $model->email = $this->email;
                $model->password = $this->password;
                $model->imagen = self::generatedNameFile();
                $model->save();

                $agent = new AgenteModel();
                $agent->correo_contacto = $this->correo_contacto;
                $agent->numero_contacto = $this->numero_contacto;
                $agent->user_id = $model->id;

                if ($agent->save()) {
                    $this->imagen->saveAs($model->imagen);
                    User::assignRole($model->id, UserModel::ROLE_AGENTE);
                    $transaction->commit();
                    return true;
                }
            }catch (\Exception $e){
                $transaction->rollBack();
                return false;
            }
        }

        return false;
    }

    public function registerUsuario(): bool
    {
        if($this->validate()){
            $model = new User();
            $model->scenario = 'newUser';

            $model->username = $this->username;
            $model->email = $this->email;
            $model->password = $this->password;
            $model->imagen = self::generatedNameFile();


            if ($model->save()) {
                $this->imagen->saveAs($model->imagen);
                User::assignRole($model->id, UserModel::ROLE_USUARIO);
                return true;
            }
        }

        return false;
    }

    private function generatedNameFile(): string
    {
        return 'usuario/' . $this->imagen->baseName .'_'.(date("d_m_Y_h_i_s")). '.' . $this->imagen->extension;
    }

}