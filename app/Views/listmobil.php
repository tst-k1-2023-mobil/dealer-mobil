<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="px-20">
    <b class="font-bold leading-10 text-gray-900 text-4xl tracking-tight mb-4">List Mobil</b>
    <?php if (session()->has('error')) : ?>
        <div class="w-full bg-red-500 rounded-md py-4 px-4 text-xl text-white font-semibold mt-4">
            <?= session('error') ?>
        </div>
    <?php endif; ?>
    <div class="flex flex-row">
        <?php foreach ($mobil as $m) : ?>
            <div class="relative flex flex-col text-gray-700 bg-white shadow-xl w-96 rounded-xl bg-clip-border">
                <ul role="list" class="divide-y divide-gray-100 mx-4">
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-lg font-bold leading-6 text-gray-900"> <?= $m['nama'] ?></p>
                                <p class="text-sm leading-6 text-gray-900">Tipe</p>
                                <p class="mt-1 truncate text-xs leading-5 text-gray-900">Spesifikasi</p>
                                <p class="mt-1 text-xs leading-5 text-gray-900"> Jumlah stock</p>
                                <p class="mt-1 text-xs leading-5 text-gray-900">Waktu produksi </p>
                                <p class="mt-1 text-xs leading-5 text-gray-900">Harga </p>

                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <br>
                            <p class="text-sm leading-6 text-gray-900"><?= $m['jenis'] ?></p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-900"><?= $m['spesifikasi'] ?></p>
                            <p class="mt-1 text-xs leading-5 text-gray-900"><?= $m['stok'] ?></p>
                            <p class="mt-1 text-xs leading-5 text-gray-900"><?= $m['waktuProduksi'] ?> hari </p>
                            <?php if ($role == '0') : ?>
                            <div class="flex gap-2">
                                <p class="mt-1 text-xs leading-5 text-gray-400 line-through decoration-gray-900">Rp<?= number_format($m['harga'], 0, ',', '.') ?></p>
                                <p class="mt-1 text-xs leading-5 text-gray-900">Rp<?= number_format($m['harga'] * (1 - $diskon), 0, ',', '.') ?></p>
                            </div>
                            <?php else : ?>
                                <p class="mt-1 text-xs leading-5 text-gray-900">Rp<?= number_format($m['harga'], 0, ',', '.') ?></p>
                            <?php endif; ?>
                            <?php if ($role == '0') : ?>
                                <form method="POST" action="/listmobil">
                                    <input type="hidden" value=<?= $m['id'] ?> name="id">
                                    <button class="mt-2 px-2 bg-[#262626] rounded p-1 w-full text-white font-semibold" type="submit">PESAN</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>