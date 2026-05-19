INSERT INTO `pokemon_complete` (`pokedex_number`, `name`, `type_1`, `type_2`, `hp`, `attack`, `defense`, `sp_attack`, `sp_defense`, `speed`, `base_stat_total`, `height_m`, `weight_kg`, `base_experience`, `abilities`, `hidden_ability`, `generation`, `is_legendary`, `is_mythical`, `is_baby`, `color`, `shape`, `egg_groups`, `habitat`, `growth_rate`, `capture_rate`, `base_happiness`, `genus`, `evolution_chain_id`, `flavor_text`, `sprite_url`) VALUES
(1, 'Bulbasaur', 'Grass', 'Poison', 45, 49, 49, 65, 65, 45, 318, 0.71, 6.90, 64, 'Overgrow', 'Chlorophyll', 1, 0, 0, 0, 'Green', 'Quadruped', 'Monster,Plant', 'Grassland', 'Medium Slow', 45, 70, 'Seed', 1, 'Bulbasaur can be seen napping in bright sunlight.', 'https://example.com/bulbasaur.png'),
(4, 'Charmander', 'Fire', NULL, 39, 52, 43, 60, 50, 65, 309, 0.61, 8.50, 62, 'Blaze', 'Solar Power', 1, 0, 0, 0, 'Red', 'Quadruped', 'Monster,Dragon', 'Mountain', 'Medium Slow', 45, 70, 'Lizard', 2, 'Charmander prefers hot places.', 'https://example.com/charmander.png'),
(7, 'Squirtle', 'Water', NULL, 44, 48, 65, 50, 64, 43, 314, 0.51, 9.00, 63, 'Torrent', 'Rain Dish', 1, 0, 0, 0, 'Blue', 'Quadruped', 'Monster,Water1', 'Water', 'Medium Slow', 45, 70, 'Tiny Turtle', 3, 'Squirtle withdraws into its shell.', 'https://example.com/squirtle.png');

INSERT INTO `pokemon_type` (`type`, `double_damage_to`, `half_damage_to`, `no_damage_to`, `double_damage_from`, `half_damage_from`, `no_damage_from`) VALUES
('Fire', 'Grass,Ice,Bug,Steel', 'Fire,Grass,Fairy,Bug,Steel', NULL, 'Water,Ground,Rock', 'Grass,Ice,Bug,Steel,Fairy', NULL),
('Water', 'Fire,Ground,Rock', 'Water,Grass,Ice', NULL, 'Grass,Electric', 'Fire,Water,Ice,Steel', NULL),
('Grass', 'Water,Ground,Rock', 'Grass,Ground,Water,Electric', NULL, 'Fire,Ice,Poison,Flying,Bug', 'Ground,Water,Grass,Electric', NULL);

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `icon_url`, `created_at`) VALUES
(1, 'trainer_ash', 'ash@pokemon.com', 'hash_password_123', 'https://example.com/ash.png', NOW()),
(2, 'trainer_misty', 'misty@pokemon.com', 'hash_password_456', 'https://example.com/misty.png', NOW()),
(3, 'trainer_brock', 'brock@pokemon.com', 'hash_password_789', 'https://example.com/brock.png', NOW());

INSERT INTO `teams` (`id`, `user_id`, `pokemon_list`) VALUES
(1, 1, '1,4,7'),
(2, 2, '1,4,7'),
(3, 3, '1,4,7');
