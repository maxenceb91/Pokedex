<?php
require_once '../utils/users.php';
include '../components/head.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Tous les champs sont obligatoires.';
    } elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[^a-zA-Z0-9]/', $password)
    ) {
        $error = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole.';
    } else {
        try {
            if (addUser($username, $email, $password)) {
                $success = 'Utilisateur créé avec succès!';
            } else {
                $error = 'Erreur lors de la création de l\'utilisateur.';
            }
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), '1062') !== false) {
                $error = 'Cet email est déjà utilisé.';
            } else {
                $error = 'Erreur lors de la création de l\'utilisateur.';
            }
        }
    }
}
?>

<body>
    <?php include '../components/header.php'; ?>
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl font-bold mb-6">Inscription</h1>
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        <form method="post" class="bg-white shadow-md rounded-lg p-6 border border-gray-300">
            <label for="username" class="block text-gray-700 font-semibold mb-2">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-red-500">

            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-red-500">

            <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe:</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-red-500">

            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">S'inscrire</button>
        </form>
        <a href="login.php" class="block text-center text-gray-600 mt-4 hover:text-gray-800">Déjà un compte? <span class="text-red-500 hover:text-red-700">Connectez-vous</span></a>
    </div>
</body>