<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/fungsi.php';

$judulHalaman = "Tentang";
$halamanAktif = "tentang.php";

$profilToko = [
    "deskripsi" => "Kedai Cemal Cemil adalah kedai kopi sederhana yang menyediakan berbagai pilihan kopi dan camilan untuk menemani aktivitas sehari-hari.",
    "alamat" => "Jl. Kedai Cemal Cemil No. 1, Denpasar, Bali",
    "email" => "halo@cemalcemilenakaja.com",
    "telepon" => "+62 812-3456-7890",
    "jamBuka" => [
        "Senin - Jumat" => "08.00 - 21.00 WITA",
        "Sabtu - Minggu" => "09.00 - 22.00 WITA"
    ],
    "layanan" => [
        "Kopi dibuat setelah dipesan",
        "Tempat nyaman untuk nongkrong",
        "Pesanan takeaway tersedia",
        "Promo menu setiap minggu"
    ]
];

require __DIR__ . '/includes/header.php';
?>

<h1 class="text-3xl font-bold mb-2">Tentang <?= $namaToko ?></h1>
<p class="text-slate-500 mb-8">Kenalan lebih dekat dengan kedai kami.</p>

<div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold mb-3">☕ Tentang Kami</h2>
            <p class="text-slate-600 leading-relaxed"><?= $profilToko["deskripsi"] ?></p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">Layanan Kami</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <?php foreach ($profilToko["layanan"] as $item): ?>
                    <div class="p-3 bg-amber-50 rounded-lg">
                        <span class="font-medium text-slate-700">✓ <?= $item ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">Kontak</h2>
            <ul class="space-y-3 text-sm text-slate-600">
                <li>📍 <?= $profilToko["alamat"] ?></li>
                <li>✉️ <?= $profilToko["email"] ?></li>
                <li>📞 <?= $profilToko["telepon"] ?></li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">Jam Buka</h2>
            <ul class="space-y-2 text-sm">
                <?php foreach ($profilToko["jamBuka"] as $hari => $jam): ?>
                    <li class="flex justify-between border-b pb-2">
                        <span><?= $hari ?></span>
                        <span class="font-semibold text-amber-700"><?= $jam ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>