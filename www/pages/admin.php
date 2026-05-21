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
            <table class="min-w-[720px] w-full overflow-hidden rounded-lg border-collapse">
                <thead class="bg-slate-100 text-slate-900">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap">Photo</th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap">Pseudo</th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap">Email</th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap">Admin</th>
                        <th class="px-4 py-3 text-left font-semibold border-b border-slate-200 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adminUsers as $user): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 border-b border-slate-200">
                                <?php if (!empty($user->icon_url)): ?>
                                    <img src="<?= htmlspecialchars($user->icon_url) ?>" alt="Photo de <?= htmlspecialchars($user->username ?? '') ?>" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover border border-slate-200">
                                <?php else: ?>
                                    <span class="text-slate-400">Aucune photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 border-b border-slate-200 whitespace-nowrap"><?= htmlspecialchars($user->username ?? '') ?></td>
                            <td class="px-4 py-3 border-b border-slate-200 whitespace-nowrap"><?= htmlspecialchars($user->email ?? '') ?></td>
                            <td class="px-4 py-3 border-b border-slate-200">
                                <?php if (!empty($user->admin)): ?>
                                    <span title="Oui" aria-label="Oui" class="text-green-600">✅</span>
                                <?php else: ?>
                                    <span title="Non" aria-label="Non" class="text-red-600">❌</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 border-b border-slate-200 whitespace-nowrap">
                                <form method="post" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                                    <input type="hidden" name="delete_user_id" value="<?= htmlspecialchars($user->id ?? $user->user_id ?? '') ?>">
                                    <button type="submit" class="inline-block px-3 py-1.5 rounded-md text-white bg-red-600 hover:bg-red-700 hover:cursor-pointer hover:shadow-md">Supprimer</button>
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