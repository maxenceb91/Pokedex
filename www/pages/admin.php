<?php
require_once '../utils/users.php';
include '../components/head.php';

if (isset($_POST['delete_user_id'])) {
    $deleteId = intval($_POST['delete_user_id']);
    if (function_exists('deleteUser')) {
        deleteUser($deleteId);
    }

    header('Location: admin.php');
    exit;
}
?>

<body>
    <?php include '../components/header.php'; ?>
    <main class="max-w-5xl mx-auto my-6 sm:my-10 p-4 sm:p-6 bg-white rounded-xl shadow-lg">
        <h1 class="mb-5 text-xl sm:text-2xl font-semibold text-slate-800">Administration des utilisateurs</h1>
        <?php
        $adminUsers = [];

        if (function_exists('getAllUsers')) {
            $adminUsers = getAllUsers();
        } elseif (function_exists('getUsers')) {
            $adminUsers = getUsers();
        }
        ?>

        <?php if (!empty($adminUsers) && is_array($adminUsers)): ?>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full overflow-hidden rounded-lg border-collapse">
                    <thead class="bg-slate-100 text-slate-900">
                        <tr>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm">Photo</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm">Pseudo</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm hidden sm:table-cell">Email</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm hidden md:table-cell">Admin</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($adminUsers as $user): ?>
                            <tr class="hover:bg-slate-50">
                                <td class="px-2 sm:px-4 py-2 sm:py-3 border-b border-slate-200">
                                    <?php if (!empty($user->getIcon())): ?>
                                        <img src="<?= htmlspecialchars($user->icon_url) ?>" alt="Photo de <?= htmlspecialchars($user->username ?? '') ?>" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full object-cover border border-slate-200">
                                    <?php else: ?>
                                        <span class="text-slate-400 text-xs sm:text-sm">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-2 sm:px-4 py-2 sm:py-3 border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm"><?= htmlspecialchars($user->username ?? '') ?></td>
                                <td class="px-2 sm:px-4 py-2 sm:py-3 border-b border-slate-200 whitespace-nowrap text-xs sm:text-sm hidden sm:table-cell"><?= htmlspecialchars($user->email ?? '') ?></td>
                                <td class="px-2 sm:px-4 py-2 sm:py-3 border-b border-slate-200 hidden md:table-cell">
                                    <form action="../utils/edit_profile.php" method="post" class="inline-block">
                                        <input type="hidden" name="edit_user_id" value="<?= htmlspecialchars($user->id ?? $user->user_id ?? '') ?>">
                                        <?php if (!empty($user->admin)): ?>
                                            <button name="toggle-admin" title="Oui" aria-label="Oui" class="text-red-600 font-semibold">👑 Administrateur</button>
                                        <?php else: ?>
                                            <button name="toggle-admin" aria-label="Non" class="text-blue-600 font-semibold">👤 Utilisateur</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                                <td class="px-2 sm:px-4 py-2 sm:py-3 border-b border-slate-200 whitespace-nowrap">
                                    <form method="post" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                                        <input type="hidden" name="delete_user_id" value="<?= htmlspecialchars($user->id ?? $user->user_id ?? '') ?>">
                                        <button type="submit" class="inline-block px-2 sm:px-3 py-1 sm:py-1.5 rounded-md text-white text-xs sm:text-sm bg-red-600 hover:bg-red-700 hover:cursor-pointer hover:shadow-md">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-slate-500">Aucun utilisateur à afficher.</p>
        <?php endif; ?>
    </main>
</body>