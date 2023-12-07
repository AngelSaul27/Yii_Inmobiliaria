<?php

namespace app\models;

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use Yii;

class UserModel extends User
{
    public const ROLE_USUARIO = 'Usuario';
    public const ROLE_AGENTE = 'Agente';

    public static function getRoleName(){
        return key(Role::getUserRoles(Yii::$app->user->id));
    }

    public static function getEmail(): \yii\db\ActiveQuery
    {
        return parent::find()->select('email')->where(['id' => Yii::$app->user->id]);
    }
}