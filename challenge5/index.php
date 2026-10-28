<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/fungsi.php';

$judulHalaman = "Menu";
$halamanAktif = "index.php";

$jumlahProduk = count($produk);
$jumlahDiskon = hitungProdukDiskon($produk);
$nilaiStok = hitungNilaiStok($produk);

$semuaHarga = array_column($produk, 'harga');
$rataRataHarga = array_sum($semuaHarga) / count($semuaHarga);

$kategoriDipilih = $_GET['kategori'] ?? "";

$jumlahPerKategori = [];
foreach ($produk as $item) {
    $kat = $item["kategori"];
    $jumlahPerKategori[$kat] = ($jumlahPerKategori[$kat] ?? 0) + 1;
}

require __DIR__ . '/includes/header.php';
?>

<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Menu <?= $namaToko ?></h1>
    <p class="text-slate-500">Nikmati kopi dan camilan favorit dengan rasa yang nyaman di setiap tegukan.</p>
    <p class="text-sm text-slate-600 mt-3">
        Rata-rata harga menu:
        <span class="font-semibold text-amber-700"><?= formatRupiah($rataRataHarga) ?></span>
    </p>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-sm text-slate-500">Jumlah menu</p>
        <p class="text-2xl font-bold"><?= $jumlahProduk ?></p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-sm text-slate-500">Menu promo</p>
        <p class="text-2xl font-bold"><?= $jumlahDiskon ?></p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-sm text-slate-500">Nilai stok</p>
        <p class="text-2xl font-bold"><?= formatRupiah($nilaiStok) ?></p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-sm text-slate-500">Termurah</p>
        <p class="text-lg font-bold"><?= cariProdukTermurah($produk)['nama'] ?></p>
    </div>
</div>

<div class="mb-6 text-sm text-slate-600 font-medium">
    Kategori:
    <?php
    $output = [];
    foreach ($jumlahPerKategori as $kategori => $jumlah) {
        $kelas = ($kategori === $kategoriDipilih) ? "text-amber-700 font-bold" : "hover:underline";
        $output[] = "<a href=\"?kategori=" . urlencode($kategori) . "\" class=\"$kelas\">$kategori ($jumlah)</a>";
    }
    if ($kategoriDipilih !== "") {
        $output[] = '<a href="index.php" class="px-2 py-1 rounded-full text-red-700 bg-red-100">× Reset</a>';
    }
    echo implode(' · ', $output);
    ?>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
<?php foreach ($produk as $kode => $item): ?>
    <?php if ($kategoriDipilih !== "" && $kategoriDipilih !== $item['kategori']) continue; ?>
    <?php $hargaAkhir = hargaSetelahDiskon($item["harga"], $item["diskon"]); ?>

    <article class="bg-white rounded-2xl shadow overflow-hidden flex flex-col border border-slate-100">
        <div class="bg-amber-50 text-7xl text-center h-44 flex items-center justify-center">
            <?= $item["ikon"] ?>
        </div>

        <div class="p-5 flex flex-col flex-1">
            <p class="text-xs text-slate-500"><?= $kode ?> · <?= $item["kategori"] ?></p>
            <h2 class="font-bold text-lg mt-1 mb-2"><?= $item["nama"] ?></h2>

            <?php if ($item["diskon"] > 0): ?>
                <p class="text-sm text-slate-400 line-through"><?= formatRupiah($item["harga"]) ?></p>
                <span class="text-xs font-bold text-red-600 mb-1">PROMO -<?= $item["diskon"] ?>%</span>
            <?php endif; ?>

            <p class="text-xl font-bold text-amber-700 mb-3"><?= formatRupiah($hargaAkhir) ?></p>

            <span class="mt-auto self-start text-xs font-semibold px-2 py-1 rounded-full <?= warnaStok($item["stok"]) ?>">
                <?= labelStok($item["stok"]) ?>
            </span>
        </div>
    </article>
<?php endforeach; ?>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>