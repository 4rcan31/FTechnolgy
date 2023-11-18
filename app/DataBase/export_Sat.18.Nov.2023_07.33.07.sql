DROP TABLE IF EXISTS `apps`; 
CREATE TABLE `apps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `avatar_serve` varchar(255) DEFAULT 'http://192.168.80.103:8080/',
  `avatar_rute` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla apps:
INSERT INTO apps (`id`, `name`, `description`, `price`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('1', 'Croquette', 'Croquette o Croquette Control es un dispensador de comida para mascotas, el cual permite al dueño brindar un cuidado alimenticio personalizado a través de una aplicación ', '60', 'http://192.168.80.103:8080/', 'assets/images/GatoDeHecho.png', '2023-11-07 15:10:56');


DROP TABLE IF EXISTS `apps_user`; 
CREATE TABLE `apps_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_apps` int NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_apps` (`id_apps`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla apps_user:
INSERT INTO apps_user (`id`, `id_apps`, `id_user`, `created_at`) VALUES ('1', '1', '2', '2023-11-07 15:55:12');

DROP TABLE IF EXISTS `contactus`; 
CREATE TABLE `contactus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_user_name` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `croquette_user`; 
CREATE TABLE `croquette_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_croquette` int NOT NULL,
  `id_user` int NOT NULL,
  `state` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_croquette` (`id_croquette`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla croquette_user:
INSERT INTO croquette_user (`id`, `id_croquette`, `id_user`, `state`, `created_at`) VALUES ('1', '1', '2', '0', '2023-11-07 15:55:12');
DROP TABLE IF EXISTS `croquettes_auths`; 
CREATE TABLE `croquettes_auths` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `in_use` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla croquettes_auths:
INSERT INTO croquettes_auths (`id`, `token`, `in_use`, `created_at`) VALUES ('1', 'a20412736e926666573981193f5319ff78a5bccbc958df73d6e6bfce311193f6', '1', '2023-11-07 15:10:56');
INSERT INTO croquettes_auths (`id`, `token`, `in_use`, `created_at`) VALUES ('2', '2fedc89a55934e8a4188e7b2e9bd19d11020db9ead0475064331fa6dbf7e0ff5', '0', '2023-11-07 15:10:56');
DROP TABLE IF EXISTS `exception_server_croquette`; 
CREATE TABLE `exception_server_croquette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `stack_trace` text,
  `client_ip` varchar(45) DEFAULT NULL,
  `server_ip` varchar(45) DEFAULT NULL,
  `additional_info` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `faq`; 
CREATE TABLE `faq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla faq:
INSERT INTO faq (`id`, `question`, `answer`, `create_at`) VALUES ('1', '¿Tengo algún tipo de garantía en la reparación del producto?', 'Sí, tu reparación tiene una garantía de 6 meses siempre y cuando la falla que se presente sea de fabrica.', '2023-11-07 15:10:57');
INSERT INTO faq (`id`, `question`, `answer`, `create_at`) VALUES ('2', '¿Qué tipo de comida se puede poner en el dispensador?', 'Este dispensador está hecho para comida seca o croquetas para animal.', '2023-11-07 15:10:57');
INSERT INTO faq (`id`, `question`, `answer`, `create_at`) VALUES ('3', '¿Qué hacer si el dispensador falla? ', 'Lo primero es revisar el manual de instrucciones, dónde podrás encontrar el problema y la posible solución, alguna de las causas puede ser que se atasco la comida, polvo en el mecanismo interno, etc. Si el problema persiste o no encuentras la solución llama al soporte técnico, al vendedor para una revisión y un posible cambio.', '2023-11-07 15:10:57');
INSERT INTO faq (`id`, `question`, `answer`, `create_at`) VALUES ('4', '¿El dispensador de comida se puede utilizar con cualquier mascota?', 'Por el momento solo es disponible y recomendable utilizarlos solo en perros y gatos.', '2023-11-07 15:10:57');
INSERT INTO faq (`id`, `question`, `answer`, `create_at`) VALUES ('5', '¿De qué material esta hecho el dispensador?', 'El dispensador esta compuesto por la carcaza que viene siendo de plastico resistente eco-amigable y el interior del plato es conformado por aluminio, para facilitar su limpieza.', '2023-11-07 15:10:57');
DROP TABLE IF EXISTS `order_comments_ceo`; 
CREATE TABLE `order_comments_ceo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_order` int DEFAULT NULL,
  `id_staff` int DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `comment_status` varchar(20) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `private_note` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `orders`; 
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `shipping_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `notes` text,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `pets`; 
CREATE TABLE `pets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `species` varchar(100) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `avatar_serve` varchar(255) DEFAULT 'http://192.168.80.103:8080/',
  `avatar_rute` varchar(255) DEFAULT 'assets/images/Logo.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla pets:
INSERT INTO pets (`id`, `user_id`, `name`, `species`, `breed`, `age`, `gender`, `color`, `weight`, `birthdate`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('1', '1', '', '', '', '', '', '', '123.00', '2005-02-23', 'http://192.168.80.103:8080/', 'assets/images/Logo.jpg', '2023-11-18 00:38:31');
DROP TABLE IF EXISTS `users`; 
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT (_utf8mb3'Aun no has llenado tu teléfono'),
  `address` text DEFAULT (_utf8mb3'Aun no has llenado tu dirección'),
  `avatar_serve` varchar(255) DEFAULT 'http://192.168.80.103:8080/',
  `avatar_rute` varchar(255) DEFAULT 'assets/images/Logo.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla users:
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('1', 'admin@a.co', 'Admin', 'Admin', '$2y$10$I9IB4Lo4BTTZXGwOD6c3ve7eE/pcXnBNRm5fblNOkQGtd/wVZae6O', '3a1259a772a86014003dfa50e92a18e96a27701d05df7e970a0809fac9eb8af1', 'Aun no has llenado tu teléfono', 'Aun no has llenado tu dirección', 'http://192.168.80.103:8080/', 'assets/images/Logo.jpg', '2023-11-07 15:10:57');
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('2', 'kerenguerrerolopez17@gmail.com', 'Keren', 'Keren-', '$2y$10$2xKZcTAz5.toXYthDo/Vz.U3sPrG79QVi2ybo6frIqbzDiKhVm8Xu', 'e14868f63a73cf6533b0b8e6a256ec41866016c40ec4621b72bd59f124044b00', 'Aun no has llenado tu teléfono', 'Aun no has llenado tu dirección', 'http://192.168.80.103:8080/', '/uploads/e2e9a5dd9f7778269251526140f96c6234436b550f6a4f5434b9a30e87fd9bc7.jpg', '2023-11-07 15:53:55');
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('3', 'anayadaniela293@gmail.com', 'Daniela Liévano ', 'Dani_lievano', '$2y$10$IVeSqnZ/x2BksCFYLTgUOeuRwyES5egwbWl02ZxpjEKAm5siUEpPq', '7c26ddb39ba75dbe0da035b259c98b7058e9f43882e9cab6d2b8eed899ad3232', 'Aun no has llenado tu teléfono', 'Aun no has llenado tu dirección', 'http://192.168.80.103:8080/', 'assets/images/Logo.jpg', '2023-11-07 16:13:38');
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('4', 'Gmrecinos.23@gmail.com', 'Gabriela ', 'Jk97', '$2y$10$GqKLlkLvVDtOqBkGv2wlH.s88wJMksJX1PigSKlMpq0wZGdEULYdq', '15cf13023b38b735371bd5353bf182a17d3217d7e4f88467a8296cad0723bb42', 'Aun no has llenado tu teléfono', 'Aun no has llenado tu dirección', 'http://192.168.80.103:8080/', 'assets/images/Logo.jpg', '2023-11-07 16:32:05');
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('5', 'nataly.elias@oportunidades.org.sv', 'Nataly', 'Nat12', '$2y$10$Ubm6VQHrD6vtlQZfjJlFz.J4y724TIs6lnxzlwnwUHEIl0.usMq8.', '09a535e3e81fb0824d7d630d3dfe2962e72da5eb2de492cec5f8869f0bb51f35', 'Aun no has llenado tu teléfono', 'Aun no has llenado tu dirección', 'http://192.168.80.103:8080/', 'assets/images/Logo.jpg', '2023-11-07 16:43:17');
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('6', 'test@test.com', 'Rodrigo', 'Rodrigo', '$2y$10$.LEn1Nmo0aZ4CNyvsfNuF.FUsg1Jb5pMKySWalRcPGJprkED9piES', '', 'Aun no has llenado tu teléfono', 'Aun no has llenado tu dirección', 'http://192.168.80.103:8080/', 'assets/images/Logo.jpg', '2023-11-16 11:32:48');

