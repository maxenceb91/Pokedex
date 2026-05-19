<?php
require_once '../utils/users.php';
require_once '../utils/pokemon.php';

if (isset($_POST['logout'])) {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
    header('Location: ../index.php');
    exit();
}

include '../components/head.php';
?>

<body class="bg-gray-50 text-gray-900">
    <?php include '../components/header.php'; ?>
    <div class="max-w-5xl mx-auto px-4 py-6">
        <div class="flex items-end justify-between gap-4 mb-5">
            <div>
                <h1 class="flex items-center gap-2 text-3xl font-bold tracking-tight"><i class="ri-user-fill"></i> Profil</h1>
                <p class="text-sm text-gray-500 mt-1">Vue d'ensemble de ton compte et de ton équipe.</p>
            </div>
        </div>

        <?php
        $user = isset($_SESSION['user_id']) ? getUserById($_SESSION['user_id']) : null;
        $team = getTeam();
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            <div class="lg:col-span-5 bg-white/90 backdrop-blur shadow-sm rounded-2xl border border-gray-200 p-5">
                <h2 class="text-lg font-semibold mb-4">Informations personnelles</h2>
                <?php if ($user): ?>
                    <div class="flex items-center gap-4">
                        <img src="<?php echo htmlspecialchars($user->getIcon(), ENT_QUOTES, 'UTF-8'); ?>" alt="Avatar" class="w-16 h-16 rounded-full object-cover border border-gray-200 ring-4 ring-gray-50">
                        <div class="min-w-0">
                            <p class="text-lg font-semibold truncate"><?php echo htmlspecialchars($user->username); ?></p>
                            <p class="text-sm text-gray-600 truncate"><?php echo htmlspecialchars($user->email); ?></p>
                            <p class="text-xs text-gray-500 mt-1">Compte créé le : <?php echo htmlspecialchars($user->created_at ?: 'Date inconnue'); ?></p>
                        </div>
                    </div>

                    <form method="POST" class="mt-5">
                        <button type="submit" name="logout" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-white font-semibold leading-none transition hover:bg-red-600 hover:cursor-pointer">
                            <i class="ri-close-circle-fill text-xl leading-none"></i><span class="text-lg leading-none">Déconnexion</span>
                        </button>
                    </form>
                    <?php
                    if (isset($_POST['logout'])) {
                        session_destroy();
                        header('Location: ../index.php');
                        exit();
                    }
                    ?>
                <?php else: ?>
                    <div class="rounded-xl bg-gray-50 border border-dashed border-gray-300 p-4 text-sm text-gray-600">
                        Vous n'êtes pas connecté.
                    </div>
                <?php endif; ?>
            </div>

            <div class="lg:col-span-7 bg-white/90 backdrop-blur shadow-sm rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <h2 class="text-lg font-semibold">Équipe</h2>
                    <span class="text-xs text-gray-500"><?php echo count($team); ?>/6 Pokémon</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-3">
                    <?php foreach ($team as $pokemon_name): ?>
                        <?php $pokemon = getPokemonByName($pokemon_name); ?>
                        <?php if ($pokemon): ?>
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-3 flex flex-col items-center text-center gap-2 transition duration-300 cursor-pointer hover:bg-red-100 hover:border-gray-300 hover:shadow-md hover:-translate-y-1 hover:scale-105">
                                <div class="w-14 h-14 rounded-full bg-white border border-gray-200 flex items-center justify-center shadow-sm overflow-hidden">
                                    <img src="<?php echo htmlspecialchars($pokemon->getIcon(), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($pokemon->name, ENT_QUOTES, 'UTF-8'); ?>" class="w-11 h-11 object-cover">
                                </div>
                                <p class="text-xs font-semibold leading-tight line-clamp-2"><?php echo htmlspecialchars($pokemon->name, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="mt-5 text-sm text-gray-500">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Modifier les informations</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <form action="edit_profile.php" method="post" class="rounded-lg border border-gray-200 p-3 bg-white/80 transition hover:bg-gray-50 hover:shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="ri-user-line text-lg text-gray-600"></i>
                        <div class="text-sm font-semibold">Pseudo</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="text" name="username" value="<?php echo htmlspecialchars($user->username ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 outline-none transition focus:border-red-400 focus:ring-2 focus:ring-red-100" placeholder="Nouveau pseudo">
                        <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-red-500 text-white transition hover:bg-red-600" aria-label="Modifier le pseudo">
                            <i class="ri-pencil-fill text-lg"></i>
                        </button>
                    </div>
                </form>

                <form action="edit_email.php" method="post" class="rounded-lg border border-gray-200 p-3 bg-white/80 transition hover:bg-gray-50 hover:shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="ri-mail-line text-lg text-gray-600"></i>
                        <div class="text-sm font-semibold">Email</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user->email ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 outline-none transition focus:border-red-400 focus:ring-2 focus:ring-red-100" placeholder="Nouvel email">
                        <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-red-500 text-white transition hover:bg-red-600" aria-label="Modifier l'email">
                            <i class="ri-pencil-fill text-lg"></i>
                        </button>
                    </div>
                </form>

                <form action="change_password.php" method="post" class="rounded-lg border border-gray-200 p-3 bg-white/80 transition hover:bg-gray-50 hover:shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="ri-lock-password-line text-lg text-gray-600"></i>
                        <div class="text-sm font-semibold">Mot de passe</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="password" name="password" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 outline-none transition focus:border-red-400 focus:ring-2 focus:ring-red-100" placeholder="Nouveau mot de passe">
                        <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-red-500 text-white transition hover:bg-red-600" aria-label="Modifier le mot de passe">
                            <i class="ri-pencil-fill text-lg"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>