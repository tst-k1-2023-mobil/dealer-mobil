<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="px-20">
    <h1 class="font-bold leading-10 text-gray-900 text-4xl tracking-tight mb-4">Loyalty Level</h1>

    <div class="flex gap-5 w-full">
        <div class="w-1/4 bg-[#CD7F32] rounded-md px-10 py-5 flex flex-col items-center justify-center">
            <img src="/bronze.png" alt="bronze" class="w-40">
            <div class="flex flex-col mt-4 ml-3 text-center">
                <p class="text-2xl font-bold text-white">Bronze</p>
                <p class="text-white">Diskon 0%</p>
                <p class="text-white">Minimum Spending Rp0,-</p>
            </div>
        </div>
        <div class="w-1/4 bg-[#C0C0C0] rounded-md px-10 py-5 flex flex-col items-center justify-center">
            <img src="/silver.png" alt="bronze" class="w-40">
            <div class="flex flex-col mt-4 ml-3 text-center">
                <p class="text-2xl font-bold text-white">Silver</p>
                <p class="text-white">Diskon 5%</p>
                <p class="text-white">Minimum Spending Rp300.000.000,-</p>
            </div>
        </div>
        <div class="w-1/4 bg-[#d4af37] rounded-md px-10 py-5 flex flex-col items-center justify-center">
            <img src="/gold.png" alt="bronze" class="w-40">
            <div class="flex flex-col mt-4 ml-3 text-center">
                <p class="text-2xl font-bold text-white">Gold</p>
                <p class="text-white">Diskon 10%</p>
                <p class="text-white">Minimum Spending Rp1.000.000.000,-</p>
            </div>
        </div>
        <div class="w-1/4 bg-[#b4b4b4] rounded-md px-10 py-5 flex flex-col items-center justify-center">
            <img src="/platinum.png" alt="bronze" class="w-40">
            <div class="flex flex-col mt-4 ml-3 text-center">
                <p class="text-2xl font-bold text-white">Platinum</p>
                <p class="text-white">Diskon 20%</p>
                <p class="text-white">Minimum Spending Rp5.000.000.000,-</p>
            </div>
        </div>
    </div>

    <!-- current spending -->
    <div class="mt-10">
        <h2 class="text-4xl font-bold mb-4">Total Pengeluaran</h2>

        <?php
        $loyaltyLevels = [
            'Bronze' => 0,
            'Silver' => 300000000,
            'Gold' => 1000000000,
            'Platinum' => 5000000000
        ];

        $currentLevel = 'Bronze';
        $nextLevel = '';
        $remainingToNextLevel = 0;

        foreach ($loyaltyLevels as $level => $minSpending) {
            if ($spending >= $minSpending) {
                $currentLevel = $level;
            } else {
                $nextLevel = $level;
                $remainingToNextLevel = $minSpending - $spending;
                break; // Stop iterating once the next level is found
            }
        }
        ?>

        <div class="flex justify-between items-center rounded-md mb-2" style="background-color: <?= ($currentLevel === 'Bronze') ? '#CD7F32' : (($currentLevel === 'Silver') ? '#C0C0C0' : (($currentLevel === 'Gold') ? '#d4af37' : '#b4b4b4')) ?>; padding: 1rem;">
            <p class="text-xl font-bold text-white"><?= $currentLevel ?></p>
            <p class="text-white">Total Pengeluaran Anda : <span class="font-bold">Rp<?= number_format($spending, 0, ',', '.') ?>,-</span></p>
        </div>
        <?php if ($nextLevel !== '') : ?>
            <p class="text-black">Belanja <span class="font-bold">Rp<?= number_format($remainingToNextLevel, 0, ',', '.') ?></span> lagi untuk mencapai level <?= $nextLevel ?></p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>