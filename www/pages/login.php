<?php
require_once '../utils/users.php';
include '../components/head.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
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
            if (authenticateUser($email, $password)) {
                header('Location: ../index.php');
                exit();
            } else {
                $error = 'Email ou mot de passe incorrect.';
            }
        } catch (PDOException $e) {
            $error = 'Erreur lors de la connexion.';
        }
    }
}
?>

<body>
    <?php include '../components/header.php'; ?>
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl font-bold mb-6">Connexion</h1>
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form method="post" class="bg-white shadow-md rounded-lg p-6 border border-gray-300">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-red-500">

            <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe:</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-red-500">

            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Se connecter</button>
        </form>
        <a href="register.php" class="block text-center text-gray-600 mt-4 hover:text-gray-800">Pas encore de compte? Inscrivez-vous</a>
    </div>
</body>