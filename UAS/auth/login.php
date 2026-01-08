<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . "/../config/db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = (string) ($_POST["password"] ?? "");

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }

    if ($password === "") {
        $errors[] = "Password wajib diisi.";
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "SELECT id, name, email, password_hash, role 
             FROM users 
             WHERE email = ?"
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user["password_hash"])) {
            $errors[] = "Email atau password salah.";
        } else {
            session_regenerate_id(true);

            $_SESSION["user_id"]   = (int) $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_role"] = $user["role"];

            header("Location: ../dashboard.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Fujikawa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="antialiased bg-gradient-to-b from-slate-900 to-gray-950">
<main class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-slate-800 border border-slate-700 rounded-xl p-8">

        <h1 class="text-2xl font-bold text-white">Login</h1>
        <p class="text-gray-300 mt-2">Masuk ke Sistem Internal.</p>

        <?php if ($errors): ?>
            <div class="mt-6 p-4 rounded-lg bg-red-950/40 border border-red-900 text-red-200 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" class="mt-6 space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-200">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="email@email.com"
                    class="mt-1 w-full rounded-md
                           bg-slate-900
                           border border-slate-600
                           text-white
                           placeholder-slate-400
                           px-3 py-2
                           focus:border-blue-500
                           focus:ring-2 focus:ring-blue-500
                           focus:outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-200">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="mt-1 w-full rounded-md
                           bg-slate-900
                           border border-slate-600
                           text-white
                           placeholder-slate-400
                           px-3 py-2
                           focus:border-blue-500
                           focus:ring-2 focus:ring-blue-500
                           focus:outline-none"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 transition-colors
                       text-white font-semibold py-2.5 rounded-md"
            >
                Login
            </button>
        </form>

        <a
            href="../index.php"
            class="inline-block mt-6 text-sm text-blue-400 hover:text-blue-300"
        >
            ← Kembali ke Beranda
        </a>

    </div>
</main>
</body>
</html>
