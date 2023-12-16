<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="w-full h-screen flex">
    <div class="w-1/2 h-full flex justify-center items-center">
        <form action="/register/auth" method="post" class="flex flex-col w-3/4 p-10 items-start">
            <h1 class="text-4xl font-bold text-center">Register</h1>
            <p class="text-md my-2">Register your account</p>
            <div class="flex flex-col mt-5 w-full">
                <label for="nama" class="text-lg">Nama</label>
                <input type="text" name="nama" placeholder="John Doe" id="nama" class="border border-black rounded p-1 <?= (session('validation') && session('validation')->hasError('nama')) ? 'border-red-500' : '' ?>" value="<?= old('nama'); ?>">
                <?php if (session('validation') && session('validation')->hasError('nama')) : ?>
                    <p class="text-red-500"><?= session('validation')->getError('nama') ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-col mt-5 w-full">
                <label for="email" class="text-lg">Email</label>
                <input type="email" name="email" placeholder="johndoe@gmail.com" id="email" class="border border-black rounded p-1 <?= (session('validation') && session('validation')->hasError('email')) ? 'border-red-500' : '' ?>" value="<?= old('email'); ?>">
                <?php if (session('validation') && session('validation')->hasError('email')) : ?>
                    <p class="text-red-500"><?= session('validation')->getError('email') ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-col mt-5 w-full">
                <label for="password" class="text-lg">Password</label>
                <input type="password" name="password" id="password" placeholder="Password must be at least 8 characters in length." class="border border-black rounded p-1 <?= (session('validation') && session('validation')->hasError('password')) ? 'border-red-500' : '' ?>">
                <?php if (session('validation') && session('validation')->hasError('password')) : ?>
                    <p class="text-red-500"><?= session('validation')->getError('password') ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-col mt-5 w-full">
                <label for="password2" class="text-lg">Confirm Password</label>
                <input type="password" name="password2" id="password2" placeholder="Password must be at least 8 characters in length." class="border border-black rounded p-1 <?= (session('validation') && session('validation')->hasError('password2')) ? 'border-red-500' : '' ?>">
                <?php if (session('validation') && session('validation')->hasError('password2')) : ?>
                    <p class="text-red-500"><?= session('validation')->getError('password2') ?></p>
                <?php endif; ?>
            </div>
            <div class="flex justify-center mt-5 w-full">
                <button type="submit" class="bg-[#262626] rounded p-1 w-full text-white">Register</button>
            </div>
            <hr class="border-t mt-5 mb-3 w-full border-gray-400">
            <div class="flex justify-center items-center gap-1 w-full">
                <p class="text-lg">Already have account?</p>
                <a href="/login" class="text-lg text-blue-500">Login</a>
            </div>
        </form>
    </div>
    <div class="bg-orange-300 w-1/2 h-screen flex justify-center">
        <img src="/car.png" alt="gambar" class="w-3/4 mx-auto my-auto">
    </div>
</div>
<?= $this->endSection(); ?>