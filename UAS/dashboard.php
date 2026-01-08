<?php
require_once __DIR__ . "/includes/auth_guard.php";

$userName = $_SESSION["user_name"] ?? "User";
$userRole = $_SESSION["user_role"] ?? "user";

// Contoh data dummy (nanti bisa kamu ganti dari DB)
$stats = [
    ["label" => "Permintaan Info", "value" => 12, "desc" => "Total form masuk"],
    ["label" => "Status Sistem", "value" => "Online", "desc" => "API & DB normal"],
    ["label" => "Role", "value" => strtoupper($userRole), "desc" => "Hak akses akun"],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Fujikawa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="antialiased bg-gradient-to-b from-slate-900 to-gray-950 text-slate-100">
<header class="sticky top-0 z-40 border-b border-slate-800 bg-slate-950/60 backdrop-blur">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-lg bg-blue-600/20 border border-blue-500/30 grid place-items-center">
                <span class="text-blue-300 font-black">F</span>
            </div>
            <div>
                <p class="text-sm text-slate-400 leading-none">Fujikawa Internal</p>
                <h1 class="text-lg font-bold leading-tight">Dashboard</h1>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="index.php"
               class="bg-slate-800 hover:bg-slate-700 border border-slate-700 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                Kembali
            </a>
            <a href="auth/logout.php"
               class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-sm font-semibold transition-colors">
                Logout
            </a>
        </div>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-10 space-y-10">

    <!-- HERO / WELCOME -->
    <section class="rounded-2xl border border-slate-800 bg-slate-900/40 p-8 overflow-hidden relative">
        <div class="absolute inset-0 pointer-events-none opacity-50"
             style="background: radial-gradient(700px circle at 20% 20%, rgba(59,130,246,.25), transparent 60%),
                            radial-gradient(700px circle at 80% 30%, rgba(168,85,247,.18), transparent 60%);">
        </div>

        <div class="relative">
            <p class="text-slate-300">Halo,</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                <?= htmlspecialchars($userName) ?>
                <span class="text-slate-400 text-lg font-semibold">(<?= htmlspecialchars($userRole) ?>)</span>
            </h2>git status

On branch main
Your branch is up to date with 'origin/main'.

Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git restore <file>..." to discard changes in working directory)
	modified:   index.php

Untracked files:
  (use "git add <file>..." to include in what will be committed)
	auth/
	config/
	dashboard.php
	includes/
	test_db.php

no changes added to commit (use "git add" and/or "git commit -a")
            <p class="mt-3 text-slate-300 max-w-2xl">
                Selamat datang di sistem internal. Gunakan panel ini untuk mengelola permintaan informasi dan memantau status portal.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="#overview"
                   class="bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-md text-sm font-semibold transition-colors">
                    Lihat Ringkasan
                </a>
                <a href="#actions"
                   class="bg-slate-800 hover:bg-slate-700 border border-slate-700 px-5 py-2.5 rounded-md text-sm font-semibold transition-colors">
                    Quick Actions
                </a>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section id="overview" class="space-y-4">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h3 class="text-xl font-bold">Ringkasan</h3>
                <p class="text-slate-400 text-sm">Snapshot cepat untuk kondisi portal.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($stats as $s): ?>
                <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-5">
                    <p class="text-slate-400 text-sm"><?= htmlspecialchars($s["label"]) ?></p>
                    <p class="mt-2 text-3xl font-extrabold">
                        <?= htmlspecialchars((string)$s["value"]) ?>
                    </p>
                    <p class="mt-2 text-slate-400 text-sm"><?= htmlspecialchars($s["desc"]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- GRID: PROFILE + ACTIONS -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Profile -->
        <div class="lg:col-span-1 rounded-xl border border-slate-800 bg-slate-900/40 p-6">
            <h3 class="font-bold text-lg">Profil Akun</h3>
            <div class="mt-4 space-y-3 text-sm">
                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Nama</span>
                    <span class="font-semibold"><?= htmlspecialchars($userName) ?></span>
                </div>
                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Role</span>
                    <span class="font-semibold uppercase"><?= htmlspecialchars($userRole) ?></span>
                </div>
                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Session</span>
                    <span class="font-semibold">Aktif</span>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-lg border border-slate-800 bg-slate-950/40 text-slate-300 text-sm">
                Tip: Untuk nilai UAS, jelaskan bahwa login memakai <b>password_hash</b> dan <b>password_verify</b>, serta session untuk otentikasi.
            </div>
        </div>

        <!-- Actions -->
        <div id="actions" class="lg:col-span-2 rounded-xl border border-slate-800 bg-slate-900/40 p-6">
            <h3 class="font-bold text-lg">Quick Actions</h3>
            <p class="text-slate-400 text-sm mt-1">Tombol cepat untuk fitur inti UAS.</p>

            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="index.php#contact"
                   class="rounded-xl border border-slate-800 bg-slate-950/30 hover:bg-slate-950/50 p-5 transition-colors">
                    <p class="font-semibold">Lihat Form Permintaan</p>
                    <p class="text-slate-400 text-sm mt-1">Arahkan ke section contact.</p>
                </a>

                <a href="#"
                   class="rounded-xl border border-slate-800 bg-slate-950/30 hover:bg-slate-950/50 p-5 transition-colors">
                    <p class="font-semibold">Kelola User</p>
                    <p class="text-slate-400 text-sm mt-1">Placeholder (ntah mau isi apa).</p>
                </a>

                <a href="#"
                   class="rounded-xl border border-slate-800 bg-slate-950/30 hover:bg-slate-950/50 p-5 transition-colors">
                    <p class="font-semibold">Riwayat Login</p>
                    <p class="text-slate-400 text-sm mt-1">Placeholder (ntah mau isi apa).</p>
                </a>

                <a href="auth/logout.php"
                   class="rounded-xl border border-red-900 bg-red-950/30 hover:bg-red-950/50 p-5 transition-colors">
                    <p class="font-semibold text-red-200">Logout</p>
                    <p class="text-red-200/70 text-sm mt-1">Akhiri session aman.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center text-slate-500 text-sm py-6">
        &copy; 2025 Fujikawa Defense Technology — Internal Portal
    </footer>

</main>
</body>
</html>
