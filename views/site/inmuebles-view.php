<?php use app\widgets\InmueblesWidget;

$this->title = $titulo ?? 'Inmuebles'; ?>

<div id="animation-carousel" class="relative w-full block mb-1" data-carousel="slide">
    <div class="relative overflow-hidden h-[580px]">

        <?php if(isset($carousel) && count($carousel) > 0) : ?>
            <?php foreach ($carousel as $item) : ?>
                <div class="hidden duration-100 ease-in-out" data-carousel-item>
                    <div class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <img class="object-cover w-full h-full" src="<?= Yii::getAlias('@web/'. $item->imagen) ?>" alt="<?= $item->titulo?>">
                    </div>
                    <div class="absolute z-[100] block w-full h-full">
                        <div class="w-full h-full flex flex-col items-center justify-center">
                            <h1 class="text-white text-4xl font-bold w-[420px] text-center"><?= $item->titulo?></h1>
                            <span class="font-light text-white text-lg mt-1"><?= $item->descripcion?></span>
                        </div>
                    </div>
                    <div class="absolute block w-full h-full bg-neutral-900 opacity-50"></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<div class="px-10 py-5">
    <h1 class="font-bold text-2xl"><?= $titulo ?? 'Inmuebles'?></h1>

    <div class="grid grid-cols-4 gap-4 py-3 mb-2">
        <?php
            if(isset($model) && count($model) > 0){
                foreach($model as $last){
                    echo InmueblesWidget::widget(['model' => $last]);
                }
            }else{
                echo '<span class="block w-full font-ligh text-xl">Sin información</span>';
            }
        ?>
    </div>
</div>

