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

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text,
  `avatar_serve` varchar(255) DEFAULT 'http://127.0.0.1:8080/',
  `avatar_rute` varchar(255) DEFAULT 'assets/images/Logo.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos de la tabla users:
INSERT INTO users (`id`, `email`, `name`, `user`, `password`, `remember_token`, `phone_number`, `address`, `avatar_serve`, `avatar_rute`, `created_at`) VALUES ('1', 'admin@a.co', 'Admin', 'Admin', '$2y$10$Uxbqdy1U9/LO.G5Kh82q/uYlvV.G5GLRg4m7pY91HLVGRcGnvWHTG', '03c8bee8822d073cba432e8a452accbeedf03aaa630291479c9220db8aca9fe6', '123', '12231', 'http://127.0.0.1:8080/', 'assets/images/Logo.jpg', '2023-11-18 01:51:23');

