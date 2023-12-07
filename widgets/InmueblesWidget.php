<?php

namespace app\widgets;

use yii\base\Widget;

class InmueblesWidget extends Widget
{
    public $model = [];

    public function run()
    {

        return $this->render('inmueble-box', ['model' => $this->model]);
    }
}
