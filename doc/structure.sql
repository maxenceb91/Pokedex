CREATE TABLE `pokemon_complete` (
  `pokedex_number` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type_1` varchar(50) DEFAULT NULL,
  `type_2` varchar(50) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `attack` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `sp_attack` int(11) DEFAULT NULL,
  `sp_defense` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `base_stat_total` int(11) DEFAULT NULL,
  `height_m` decimal(5,2) DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `base_experience` int(11) DEFAULT NULL,
  `abilities` text DEFAULT NULL,
  `hidden_ability` varchar(100) DEFAULT NULL,
  `generation` int(11) DEFAULT NULL,
  `is_legendary` tinyint(1) DEFAULT NULL,
  `is_mythical` tinyint(1) DEFAULT NULL,
  `is_baby` tinyint(1) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `shape` varchar(50) DEFAULT NULL,
  `egg_groups` varchar(100) DEFAULT NULL,
  `habitat` varchar(50) DEFAULT NULL,
  `growth_rate` varchar(50) DEFAULT NULL,
  `capture_rate` int(11) DEFAULT NULL,
  `base_happiness` int(11) DEFAULT NULL,
  `genus` varchar(100) DEFAULT NULL,
  `evolution_chain_id` int(11) DEFAULT NULL,
  `flavor_text` text DEFAULT NULL,
  `sprite_url` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `pokemon_type` (
  `type` varchar(20) NOT NULL,
  `double_damage_to` text DEFAULT NULL,
  `half_damage_to` text DEFAULT NULL,
  `no_damage_to` text DEFAULT NULL,
  `double_damage_from` text DEFAULT NULL,
  `half_damage_from` text DEFAULT NULL,
  `no_damage_from` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pokemon_list` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;