<?php

    use yii\helpers\ArrayHelper;
    use yii\jui\DatePicker;
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    /** @var app\controllers\InmuebleController $model */

    $this->title = 'Formulario de inmuebles';
?>

<div class="w-full h-full flex flex-col align-items-center justify-center py-20 bg-center">
    <?php $form = ActiveForm::begin() ?>
    <div class="rounded-md bg-white shadow px-4 w-[700px] px-3 py-3">
        <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
        <p class="font-light text-sm mt-1 mb-2">Completa todos los campos por favor.</p>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-gray-500">Titulo</label>
                <?= $form->field($model, 'nombre')->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Titulo del inmueble'])->label(false) ?>

                <label class="text-gray-500">Ubicacion</label>
                <?= $form->field($model, 'ubicacion')->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Ubicación del inmueble'])->label(false) ?>

                <label class="text-gray-500">Precio</label>
                <?= $form->field($model, 'precio')->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => '$0.00'])->label(false) ?>

                <div class="grid grid-cols-2 gap-2">
                    <label class="text-gray-500">Tipo de inmueble</label>
                    <label class="text-gray-500">Categoria del inmueble</label>

                    <?= $form->field($model, 'tipo_inmueble_id')
                        ->dropDownList(ArrayHelper::map($categoria ?? [], 'id', 'categoria'), ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm'])
                        ->label(false)
                    ?>
                    <?= $form->field($model, 'categoria_inmueble_id')
                        ->dropDownList(ArrayHelper::map($tipo ?? [], 'id', 'tipo'), ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm'])
                        ->label(false)
                    ?>
                </div>

                </div>
            <div>
                <div class="grid grid-cols-2 gap-x-2">
                    <label class="text-gray-500">Habitaciones</label>
                    <label class="text-gray-500">Baños</label>

                    <?= $form->field($model, 'habitaciones')->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Numero de habitaciones'])->label(false) ?>
                    <?= $form->field($model, 'banios')->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Numero de baños'])->label(false) ?>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <label class="text-gray-500">Tamaño</label>
                    <label class="text-gray-500">Niveles</label>
                    <?= $form->field($model, 'tamanio')->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Tamaño en m2'])->label(false) ?>
                    <?= $form->field($model, 'niveles')->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Niveles de la casa'])->label(false) ?>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <label class="text-gray-500">Año de construcción</label>
                    <label class="text-gray-500">Fecha de publicación</label>
                    <?= $form->field($model, 'anio_construccion')
                        ->widget(DatePicker::class, [
                            'options' => ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => '##-##-####'],
                            'dateFormat' => 'yyyy'
                        ])->label(false) ?>

                    <?= $form->field($model, 'fecha_publicacion')
                        ->widget(DatePicker::class, [
                            'options' => ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => '##-##-####'],
                            'dateFormat' => 'yyyy-MM-dd'
                        ])->label(false) ?>
                </div>
                <label class="text-gray-500">Fotografia</label>
                <?= $form->field($model, 'imagen')->fileInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm'])->label(false) ?>
            </div>
        </div>
        <button class="w-full rounded-md px-3 py-2 text-xl font-light bg-amber-400 text-neutral-900 mt-3 mb-2">
            Enviar
        </button>
    </div>
    <?php ActiveForm::end() ?>

</div>
