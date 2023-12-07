<?php

    use app\models\auxiliares\categoria_inmueble;
    /** @var app\widgets\InmueblesWidget $model */


?>
<div class="shadow-sm bg-white">
    <a href="<?= Yii::getAlias('@web/inmueble/'.$model->id)?>" class="relative overflow-hidden">
        <img src="<?= Yii::getAlias('@web/carousel/1.jpg') ?>" alt="" class="object-fit rounded-t-md">
        <div class="absolute bottom-0 px-2 py-1 bg-red-600 text-white">
            <span class="font-semibold tracking-wide text-uppercase text-sm"><?= categoria_inmueble::getCategoria($model->categoria_inmueble_id)?></span>
        </div>
    </a>
    <div class="py-2 px-3">
        <h1 class="text-xl font-bold my-2"><a class="hover:text-red-600 transition-all duration-300" href="<?= Yii::getAlias('@web/inmueble/'.$model->id)?>"><?= $model->nombre?></a></h1>
        <p class="font-light text-sm text-gray-500"><?= $model->ubicacion ?></p>
        <p class="font-[400] text-xl text-neutral-900 mt-2 mb-3">$<?= number_format($model->precio, '2', '.', ',') ?></p>
        <hr class="block my-2 text-gray-400">
        <div class="flex flex-col gap-2 my-3">
            <div class="grid grid-cols-4 gap-2">
                <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                    <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="28.153 28.153 143.693 143.693" viewBox="28.153 28.153 143.693 143.693" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                        <g>
                            <path d="M28.153 28.153v143.693h143.693V28.153H28.153zm135.694 8v44.339H36.153V36.153h127.694zM36.153 163.847V88.492h127.693v75.354H36.153z" fill="#DADADA" data-color="1"></path>
                            <path d="M96.246 41.723H43.661v31.262h52.585V41.723zm-8 23.261H51.661V49.723h36.585v15.261z" fill="#DADADA" data-color="1"></path>
                            <path d="M156.339 41.723h-52.585v31.262h52.585V41.723zm-8 23.261h-36.585V49.723h36.585v15.261z" fill="#DADADA" data-color="1"></path>
                        </g>
                    </svg>
                    <span>Habitaciones</span>
                </div>
                <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                    <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="28.932 28.931 143.122 142.137" viewBox="28.932 28.931 143.122 142.137" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                        <g>
                            <path d="M47.107 111.33l11.498 51.738H36.932V36.932h18.14l4.775 12.734 7.49-2.809-6.723-17.926H28.932v142.137H158.78l13.274-59.738H47.107zm105.255 51.738H66.801L57.08 119.33h105.002l-9.72 43.738z" fill="#DADADA" data-color="1"></path>
                        </g>
                    </svg>
                    <span>Baños</span>
                </div>
                <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                    <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="34.57 31.149 130.859 137.702" viewBox="34.57 31.149 130.859 137.702" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                        <g>
                            <path fill="#DADADA" d="M165.429 160.851v8H34.57v-8h130.859z" data-color="1"></path>
                            <path fill="#DADADA" d="M165.429 96v8H34.57v-8h130.859z" data-color="1"></path>
                            <path fill="#DADADA" d="M165.429 31.149v8H34.57v-8h130.859z" data-color="1"></path>
                            <path fill="#DADADA" d="M99.663 52.766v8H46.557v-8h53.106z" data-color="1"></path>
                            <path fill="#DADADA" d="M119.685 74.383v8H66.579v-8h53.106z" data-color="1"></path>
                            <path fill="#DADADA" d="M157.872 117.617v8h-53.106v-8h53.106z" data-color="1"></path>
                            <path fill="#DADADA" d="M133.106 139.234v8H80v-8h53.106z" data-color="1"></path>
                        </g>
                    </svg>
                    <span>Niveles</span>
                </div>
                <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                    <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="30.57 30.57 138.86 138.86" viewBox="30.57 30.57 138.86 138.86" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                        <g>
                            <path d="M30.57 30.57v138.86h138.86V30.57H30.57zm130.86 130.86H38.57V38.57h122.86v122.86z" fill="#DADADA" data-color="1"></path>
                            <path d="M87.175 112.825h-41.65v41.649h41.649v-41.649zm-8 33.65h-25.65v-25.649h25.649v25.649z" fill="#DADADA" data-color="1"></path>
                        </g>
                    </svg>
                    <span>MT2</span>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 text-center">
                <span class="font-bold text-lg"><?= $model->habitaciones?></span>
                <span class="font-bold text-lg"><?= $model->banios?></span>
                <span class="font-bold text-lg"><?= $model->niveles?></span>
                <span class="font-bold text-lg"><?= $model->tamanio?></span>
            </div>
        </div>
    </div>
</div>