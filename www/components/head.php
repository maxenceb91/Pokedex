<?php
session_start();
$basePath = basename($_SERVER['PHP_SELF']) === 'index.php' ? '' : '../';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="icon" type="image/png" href="<?php echo $basePath; ?>assets/pokeball.png">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="<?php echo $basePath; ?>scripts/script.js?v=<?php echo time(); ?>" defer></script>
</head>