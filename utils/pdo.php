<?php
$host = 'mysql-pokedexx.alwaysdata.net';
$dbname = 'pokedexx_bdd';
$username = 'pokedexx';
$password = 'U76Ac5u3Nhj7Rf';

try {
	$pdo = new PDO(
		"mysql:host={$host};dbname={$dbname};charset=utf8mb4",
		$username,
		$password,
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		]
	);
} catch (PDOException $e) {
	die('Database connection failed: ' . $e->getMessage());
}
?>