<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="lg:flex lg:items-center lg:justify-between min-w-0 ml-3">
  <b class="text-8xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">DETAIL PESANAN</b>
</div>
<form method="POST" action="/pesan">
    <div class="space-y-12 mt-4">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-xl font-semibold leading-7 text-gray-900">Detail Mobil </h2>
            <div class="flex  justify-between gap-x-6 py-5">
                <div class="flex row min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-l font-semibold leading-6 text-gray-900"> <?= $mobil['nama']?></p>
                        <p class="text-l leading-6 text-gray-900">Tipe</p>
                        <p class="mt-1 truncate text-l leading-5 text-gray-900">Spesifikasi</p>
                        <p class="mt-1 text-l leading-5 text-gray-900"> Jumlah stock</p>
                        <p class="mt-1 text-l leading-5 text-gray-900">Waktu produksi </p>
                        <p class="mt-1 text-l leading-5 text-gray-900">Harga </p>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <br>
                        <p class="text-l leading-6 text-gray-900"><?= $mobil['jenis']?></p>
                        <p class="mt-1 truncate text-l leading-5 text-gray-900"><?= $mobil['spesifikasi']?></p>
                        <p class="mt-1 text-l leading-5 text-gray-900"><?= $mobil['stok']?></p>
                        <p class="mt-1 text-l leading-5 text-gray-900"><?= $mobil['waktuProduksi'] ?> hari </p>
                        <p class="mt-1 text-l leading-5 text-gray-900"><?= $mobil['harga']?> </p>
                    </div>
                </div>
            </div>
    </div>
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
          <label for="username" class="block text-xl font-medium leading-6 text-gray-900">Jumlah Unit</label>
          <div class="mt-2">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
              <input type="text" name="jumlahPesanan" id="jumlahPesanan"  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="10">
            </div>
          </div>
        </div>  
  <div class="mt-6 flex items-center  gap-x-6">
    <button type="submit" class="text-sm font-semibold leading-6 mt-2 bg-[#262626] rounded p-1 w-full text-white">Pesan</button>
  </div>
  <input type="hidden" value=<?= $mobil['id']?> name="id">
  <input type="hidden" value=<?= $mobil['harga']?> name="harga">
  <input type="hidden" value=<?= $mobil['waktuProduksi']?> name="waktuProduksi">
  <input type="hidden" value=<?= $mobil['stok']?> name="stok">

</form>

<?= $this->endSection(); ?>