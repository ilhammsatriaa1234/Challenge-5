<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/fungsi.php';

$judulHalaman = "Pesanan";
$halamanAktif = "pesanan.php";

$totalBelanja = 0;
$totalBarang = 0;

foreach ($pesanan as $kode => $jumlah) {
    $hargaAkhir = hargaSetelahDiskon($produk[$kode]["harga"], $produk[$kode]["diskon"]);
    $totalBelanja += $hargaAkhir * $jumlah;
    $totalBarang += $jumlah;
}

$potongan = diskonBelanja($totalBelanja);
$totalBayar = $totalBelanja - $potongan;

require __DIR__ . '/includes/header.php';
?>

<h1 class="text-3xl font-bold mb-2">Pesanan Pelanggan</h1>
<p class="text-slate-500 mb-6">Ringkasan pesanan di <?= $namaToko ?>.</p>

<div class="bg-white rounded-2xl shadow p-6 max-w-3xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b text-sm text-slate-500">
                    <th class="py-3">No</th>
                    <th>Menu</th>
                    <th class="text-right">Harga</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; ?>
            <?php foreach ($pesanan as $kode => $jumlah): ?>
                <?php
                $item = $produk[$kode];
                $hargaAkhir = hargaSetelahDiskon($item["harga"], $item["diskon"]);
                ?>
                <tr class="border-b">
                    <td class="py-3"><?= $no++ ?></td>
                    <td class="py-3"><?= $item["ikon"] ?> <?= $item["nama"] ?></td>
                    <td class="text-right"><?= formatRupiah($hargaAkhir) ?></td>
                    <td class="text-center"><?= $jumlah ?></td>
                    <td class="text-right"><?= formatRupiah($hargaAkhir * $jumlah) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-5 space-y-2">
        <p class="flex justify-between"><span>Total item</span><span><?= $totalBarang ?></span></p>
        <p class="flex justify-between"><span>Total belanja</span><span><?= formatRupiah($totalBelanja) ?></span></p>
        <p class="flex justify-between text-red-600"><span>Diskon</span><span>- <?= formatRupiah($potongan) ?></span></p>
        <p class="flex justify-between text-xl font-bold border-t pt-3">
            <span>Total bayar</span><span><?= formatRupiah($totalBayar) ?></span>
        </p>
    </div>

    <?php if ($potongan === 0): ?>
        <p class="mt-5 text-sm text-slate-500">
            💡 Belanja minimal Rp 200.000 untuk mendapatkan diskon tambahan.
        </p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>