<?php

    use yii\jui\DatePicker;
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    /** @var app\controllers\ManagementController $model */

    $this->title = 'Formulario de carousel';
?>

<div class="w-full h-full flex flex-col align-items-center justify-center py-20 bg-center">

    <?php $form = ActiveForm::begin() ?>
    <div class="rounded-md bg-white shadow px-4 w-[400px] px-3 py-3">
        <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
        <p class="font-light text-sm mt-1 mb-2">Completa todos los campos por favor.</p>
        <div>
            <label class="text-gray-500">Titulo</label>
            <?= $form->field($model, 'titulo')->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'No es obligatorio'])->label(false) ?>
            <label class="text-gray-500">Descripcion</label>
            <?= $form->field($model, 'descripcion')->textarea(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full h- shadow-sm', 'placeholder' => 'No es obligatorio'])->label(false) ?>
            <label class="text-gray-500">Fotografia</label>
            <?= $form->field($model, 'imagen')->fileInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm'])->label(false) ?>
            <div class="grid grid-cols-2 gap-2">
                <label class="text-gray-500 block">Fecha de Activación</label>
                <label class="text-gray-500 block">Fecha de Desactivación</label>

                <?= $form->field($model, 'fecha_activacion')
                    ->widget(DatePicker::class, [
                        'options' => ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => '##-##-####'],
                        'dateFormat' => 'yyyy-MM-dd'
                    ])->label(false) ?>

                <?= $form->field($model, 'fecha_desactivacion')
                    ->widget(DatePicker::class, [
                        'options' => ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => '##-##-####'],
                        'dateFormat' => 'yyyy-MM-dd'
                    ])->label(false) ?>
            </div>
        </div>
        <button class="w-full rounded-md px-3 py-2 text-xl font-light bg-amber-400 text-neutral-900 mt-3 mb-2">
            Enviar
        </button>
    </div>
    <?php ActiveForm::end() ?>

</div>

