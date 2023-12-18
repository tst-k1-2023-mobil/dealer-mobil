<?php if (current_url(true)->getSegment(1) !== 'login' && current_url(true)->getSegment(1) !== 'register') : ?>
    <?php
    $session = Config\Services::session();
    $role = $session->get('user')['admin'];
    ?>
    <nav class="flex w-full justify-between items-center px-20 py-4 bg-orange-300 mb-8">
        <h1 class="text-3xl font-bold text-white">Dealer.in</h1>
        <div class="flex gap-10">
            <ul class="flex gap-7 text-lg font-semibold">
                <li>
                    <a href="/" class="<?= current_url(true)->getSegment(1) == '' ? 'text-[#262626] underline' : 'text-white' ?>">
                        List Mobil
                    </a>
                </li>
                <li>
                    <a href="/transaksi" class="<?= current_url(true)->getSegment(1) == 'transaksi' ? 'text-[#262626] underline' : 'text-white' ?>">
                        Transaksi
                    </a>
                </li>
                <?php if ($role == 0) : ?>
                    <li>
                        <a href="/pesan" class="<?= current_url(true)->getSegment(1) == 'pesan' ? 'text-[#262626] underline' : 'text-white' ?>">
                            Pesan
                        </a>
                    </li>
                    <li>
                        <a href="/loyalty" class="<?= current_url(true)->getSegment(1) == 'loyalty' ? 'text-[#262626] underline' : 'text-white' ?>">
                            Loyalty
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <form action="/logout" method="post" class="px-3 py-1 bg-red-500 flex justify-center items-center rounded-md">
                <button type="submit" class="text-lg font-semibold text-white">Logout</button>
            </form>
        </div>
    </nav>
<?php endif; ?>