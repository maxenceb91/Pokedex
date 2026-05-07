<header class="flex items-center justify-between p-15 bg-white shadow-md mb-10">
    <a href="/Pokedex/index.php" class="flex items-center gap-4">
        <img src="/Pokedex/assets/pokeball.png" alt="Pokéball" class="w-10 h-10">
        <h1 class="text-2xl font-bold text-gray-800">Pokédex</h1>
    </a>
    <nav>
        <ul class="flex items-center gap-10">
            <li class="group text-lg font-medium text-gray-700">
                <a href="/Pokedex/index.php" class="relative inline-block pb-1 transition-colors duration-300 ease-in-out hover:text-red-600 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:origin-left after:scale-x-0 after:bg-red-600 after:transition-transform after:duration-300 after:ease-in-out group-hover:after:scale-x-100">Accueil</a>
            </li>
            <li class="group text-lg font-medium text-gray-700">
                <a href="/Pokedex/pages/types.php" class="relative inline-block pb-1 transition-colors duration-300 ease-in-out hover:text-red-600 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:origin-left after:scale-x-0 after:bg-red-600 after:transition-transform after:duration-300 after:ease-in-out group-hover:after:scale-x-100">Types</a>
            </li>
            <?php
            if (isset($_SESSION['user_id'])):
                require_once __DIR__ . '/../utils/users.php';
                $user = getUserById($_SESSION['user_id']);
                $icon = $user->getIcon();

                                echo '<li class="flex items-center">
                        <a href="/Pokedex/pages/profile.php" class="inline-block">
                            <div class="border-2 border-gray-300 rounded-full p-1"> 
                                <img src="' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . '" 
                                         alt="User Icon" 
                                         class="w-8 h-8 rounded-full object-cover">
                            </div>
                        </a>
                    </li>';
            ?>
            <?php else: ?>
                <li class="group text-lg font-medium text-gray-700">
                    <a href="/Pokedex/pages/register.php" class="relative inline-block pb-1 transition-colors duration-300 ease-in-out hover:text-red-600 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:origin-left after:scale-x-0 after:bg-red-600 after:transition-transform after:duration-300 after:ease-in-out group-hover:after:scale-x-100">Inscription</a>
                </li>
                <li class="group text-lg font-medium text-gray-700">
                    <a href="/Pokedex/pages/login.php" class="relative inline-block pb-1 transition-colors duration-300 ease-in-out hover:text-red-600 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:origin-left after:scale-x-0 after:bg-red-600 after:transition-transform after:duration-300 after:ease-in-out group-hover:after:scale-x-100">Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>