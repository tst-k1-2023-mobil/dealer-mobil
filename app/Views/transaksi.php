<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="px-20">
    <b class="font-bold leading-10 text-gray-900 text-4xl tracking-tight mb-4">Histori Transaksi</b>

    <div class="w-full border-2 divide-y divide-gray-500 shadow-xl rounded-xl bg-clip-border mt-4">
        <?php if (!empty($transaksi)) : ?>
            <?php foreach ($transaksi as $t) : ?>
                <div class="flex justify-between items-center p-4 pr-10">
                    <div>
                        <p class="text-xl font-bold"><?= $t['userNama'] ?> - <?= $t['mobilNama'] ?></p>
                        <p class="text-md">Tanggal Pesan : <?= formatDate($t['tglPesan']) ?></p>
                        <p class="text-md">Tanggal Kirim : <?= formatDate($t['tglKirim']) ?></p>
                        <p class="text-md">Jumlah : <?= $t['jumlah'] ?></p>
                        <p class="text-md">Total Harga : Rp <?= number_format($t['totalHarga'], 0, ',', '.') ?></p>
                    </div>
                    <div>
                        <?php
                        $tglKirim = new DateTime($t['tglKirim']);
                        $currentDate = new DateTime(date('Y-m-d'));
                        $status = ($currentDate >= $tglKirim) ? 'Done' : 'Produksi';
                        ?>
                        <p class="text-md font-bold"><?= $status ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="p-4">Belum ada histori transaksi.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>

<?php
function formatDate($dateString)
{
    $dateTime = new DateTime($dateString);
    return $dateTime->format('d F Y');
}
?>