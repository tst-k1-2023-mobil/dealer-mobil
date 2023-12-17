<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="w-full h-screen flex">
    <div class="bg-orange-300 w-1/2 h-screen flex justify-center">
        <img src="/car.png" alt="gambar" class="w-3/4 mx-auto my-auto">
    </div>
    <div class="w-1/2 h-full flex justify-center items-center">
        <form action="/login/auth" method="post" class="flex flex-col w-3/4 p-10 items-start">
            <h1 class="text-4xl font-bold text-center">Login</h1>
            <p class="text-md my-2">Enter your credentials to access your account</p>
            <div class="flex flex-col mt-5 w-full">
                <label for="email" class="text-lg">Email</label>
                <input type="email" name="email" id="email" class="border border-black rounded p-1">
            </div>
            <div class="flex flex-col mt-5 w-full">
                <label for="password" class="text-lg">Password</label>
                <input type="password" name="password" id="password" class="border border-black rounded p-1">
            </div>
            <div class="flex justify-center mt-5 w-full">
                <button type="submit" class="bg-[#262626] rounded p-1 w-full text-white">Login</button>
            </div>
            <hr class="border-t mt-5 mb-3 w-full border-gray-400">
            <div class="flex justify-center items-center gap-1 w-full">
                <p class="text-lg">Don't have an account?</p>
                <a href="/register" class="text-lg text-blue-500">Register</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>