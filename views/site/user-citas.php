<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Mis citas'; ?>
<div class="px-10 py-5 min-vh-100">

    <?php
    echo GridView::widget([
        'dataProvider' => $cita,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Fotografia',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Yii::getAlias('@web/'.$model->inmueble->imagen), ['class' => 'w-[150px]']);
                },
            ],
            [
                'attribute' => 'Nombre del inmueble',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::label($model->inmueble->nombre ?? 'No pudimos recuperar la información');
                },
            ],
            [
                'attribute' => 'Precio del inmueble',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::label('$ '.number_format($model->inmueble->precio, '2', '.', ',') ?? 'No pudimos recuperar la información');
                },
            ],
            [
                'attribute' => 'Fecha de la cita',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::label($model->fecha_cita ?? 'A la espera de la asignación');
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'=>['style'=>'width:70px; text-align:center;'],
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') { // Aquí defines la estructura de la URL para la acción de edición
                        return Url::to(['inmueble/' . $model->inmueble_id]);
                    }else if($action === 'delete'){
                        return Url::to(['user/cita/' . $model->id . '/unsubscribe']);
                    }
                },
            ]
        ],
    ]);
    ?>

</div>