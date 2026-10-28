<?php
$judulHalaman = $judulHalaman ?? "Beranda";
$halamanAktif = $halamanAktif ?? "";

$menu = [
    "index.php" => "Menu",
    "pesanan.php" => "Pesanan",
    "tentang.php" => "Tentang"
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judulHalaman ?> - <?= $namaToko ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-stone-100 text-slate-800 min-h-screen flex flex-col">

<header class="bg-white border-b border-stone-200">
    <div class="max-w-5xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-3">
        <a href="index.php" class="text-xl font-bold text-amber-700">
            ☕ <?= $namaToko ?>
        </a>

        <nav class="flex gap-2 text-sm font-semibold">
            <?php foreach ($menu as $file => $teks): ?>
                <?php
                $kelas = ($file === $halamanAktif)
                    ? "bg-amber-600 text-white"
                    : "text-slate-600 hover:bg-amber-50";
                ?>
                <a href="<?= $file ?>" class="px-3 py-2 rounded-lg <?= $kelas ?>">
                    <?= $teks ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>

<main class="max-w-5xl mx-auto px-4 py-8 w-full flex-1">