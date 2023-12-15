<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="lg:flex lg:items-center lg:justify-between min-w-0 ml-3">
  <b class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">LIST MOBIL</b>
</div>
<div class = "flex flex row">
<?php foreach($mobil as $m) : ?>
    <div class="relative flex flex-col text-gray-700 bg-white shadow-xl w-96 rounded-xl bg-clip-border mx-2 ">
        <ul role="list" class="divide-y divide-gray-100 mx-4">
            <li class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                    <p class="text-m font-semibold leading-6 text-gray-900"> <?= $m['nama']?></p>
                    <p class="text-sm leading-6 text-gray-900">Tipe</p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-900">Spesifikasi</p>
                    <p class="mt-1 text-xs leading-5 text-gray-900"> Jumlah stock</p>
                    <p class="mt-1 text-xs leading-5 text-gray-900">Waktu produksi </p>
                    <p class="mt-1 text-xs leading-5 text-gray-900">Harga </p>
                    
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <br>
                    <p class="text-sm leading-6 text-gray-900"><?= $m['jenis']?></p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-900"><?= $m['spesifikasi']?></p>
                    <p class="mt-1 text-xs leading-5 text-gray-900"><?= $m['stok']?></p>
                    <p class="mt-1 text-xs leading-5 text-gray-900"><?= $m['waktuProduksi'] ?> hari </p>
                    <p class="mt-1 text-xs leading-5 text-gray-900"><?= $m['harga']?> </p>
                </div>
            </li>
        </ul>
    </div>
        <?php endforeach;?>
</div>

<?= $this->endSection(); ?>
</ul>