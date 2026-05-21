<?php
require_once __DIR__ . '/../utils/users.php';
$basePath = basename($_SERVER['PHP_SELF']) === 'index.php' ? '' : '../';
$userId = getUserId();
$user = getUserById($userId);

function renderLinks($basePath, $user, $isMobile = false) {
    $listClass = $isMobile ? "flex flex-col gap-6 p-8" : "flex items-center gap-10";
    $linkClass = "relative inline-block pb-1 transition-colors duration-300 ease-in-out hover:text-red-600 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:origin-left after:scale-x-0 after:bg-red-600 after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100";
    ?>
    <ul class="<?php echo $listClass; ?>">
        <li class="group text-lg font-medium text-gray-700">
            <a href="<?php echo $basePath; ?>index.php" class="<?php echo $linkClass; ?>">Accueil</a>
        </li>
        <li class="group text-lg font-medium text-gray-700">
            <a href="<?php echo $basePath; ?>pages/types.php" class="<?php echo $linkClass; ?>">Types</a>
        </li>
        <?php if ($user && $user->admin): ?>
            <li class="group text-lg font-medium text-red-600">
                <a href="<?php echo $basePath; ?>pages/admin.php" class="<?php echo $linkClass; ?>">Admin</a>
            </li>
        <?php endif; ?>

        <hr class="md:hidden border-gray-100">

        <?php if (isset($_SESSION['user_id'])): 
            $icon = $user->getIcon(); ?>
            <li class="flex items-center gap-4">
                <a href="<?php echo $basePath; ?>pages/profile.php" class="inline-block">
                    <div class="border-2 border-gray-300 rounded-full p-0.5 hover:scale-110 transition-transform duration-300"> 
                        <img src="<?php echo htmlspecialchars($icon, ENT_QUOTES, 'UTF-8'); ?>" alt="User Icon" class="w-8 h-8 rounded-full object-cover">
                    </div>
                </a>
                <?php if($isMobile): ?>
                    <a href="<?php echo $basePath; ?>pages/logout.php" class="text-sm text-gray-400">Déconnexion</a>
                <?php endif; ?>
            </li>
        <?php else: ?>
            <li class="group text-lg font-medium text-gray-700">
                <a href="<?php echo $basePath; ?>pages/register.php" class="<?php echo $linkClass; ?>">Inscription</a>
            </li>
            <li class="group text-lg font-medium">
                <a href="<?php echo $basePath; ?>pages/login.php" class="px-5 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition-all shadow-md">Connexion</a>
            </li>
        <?php endif; ?>
    </ul>
<?php } ?>

<header class="relative z-50 flex items-center justify-between p-6 bg-white shadow-md mb-10 px-6 md:px-12">
    <a href="<?php echo $basePath; ?>index.php" class="flex items-center gap-4 z-50">
        <img src="<?php echo $basePath; ?>assets/pokeball.png" alt="Pokéball" class="w-10 h-10 hover:rotate-180 transition-transform duration-500">
        <h1 class="text-2xl font-bold text-gray-800">Pokédex</h1>
    </a>

    <nav class="hidden md:block">
        <?php renderLinks($basePath, $user); ?>
    </nav>

    <button id="burger-btn" class="relative z-[60] flex flex-col gap-1.5 md:hidden focus:outline-none p-2">
        <span id="line1" class="w-7 h-1 bg-gray-800 rounded-full transition-all duration-300 origin-center"></span>
        <span id="line2" class="w-7 h-1 bg-gray-800 rounded-full transition-all duration-300"></span>
        <span id="line3" class="w-7 h-1 bg-gray-800 rounded-full transition-all duration-300 origin-center"></span>
    </button>

    <div id="menu-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>

    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-white shadow-[-10px_0_15px_-3px_rgba(0,0,0,0.1)] translate-x-full transition-transform duration-300 ease-in-out md:hidden z-50 pt-24">
        <nav>
            <?php renderLinks($basePath, $user, true); ?>
        </nav>
    </div>
</header>