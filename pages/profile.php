<?php
require_once '../utils/users.php';
include '../components/head.php';
?> 

<body>
    <?php include '../components/header.php'; ?>
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl font-bold mb-6">Mon Profil</h1>
        <div class="bg-white shadow-md rounded-lg p-6 border border-gray-300">
            <h2 class="text-xl font-semibold mb-4">Informations personnelles</h2>
            <?php
                $user = isset($_SESSION['user_id']) ? getUserById($_SESSION['user_id']) : null;
            ?>
            <?php if ($user): ?>
                <div class="flex items-center gap-4 mb-4">
                    <img src="<?php echo htmlspecialchars($user->getIcon(), ENT_QUOTES, 'UTF-8'); ?>" alt="Avatar" class="w-16 h-16 rounded-full object-cover border border-gray-300">
                    <div>
                        <p class="text-lg font-semibold"><?php echo htmlspecialchars($user->username); ?></p>
                        <p class="text-gray-700"><?php echo htmlspecialchars($user->email); ?></p>
                    </div>
                </div>
                <p class="text-gray-700"><strong>Compte créé le:</strong> <?php echo htmlspecialchars($user->created_at ?: 'Date inconnue'); ?></p>
            <?php else: ?>
                <p class="text-gray-700">Vous n'êtes pas connecté.</p>
            <?php endif; ?>
        </div>
    </div>
</body>