-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 27/09/2019 às 02:17
-- Versão do servidor: 8.0.17
-- Versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `brands`
--

CREATE TABLE `brands` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'LG'),
(2, 'AOC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `sub` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `sub`, `name`) VALUES
(1, NULL, 'Monitor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `coupon_type` int(11) NOT NULL,
  `coupon_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `options`
--

CREATE TABLE `options` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `options`
--

INSERT INTO `options` (`id`, `name`) VALUES
(1, 'Cor'),
(2, 'Tamanho'),
(3, 'Memória RAM'),
(4, 'Polegadas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pages`
--

CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `stock` int(11) NOT NULL,
  `price` float NOT NULL,
  `price_from` float NOT NULL,
  `rating` float NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `sale` tinyint(1) NOT NULL,
  `bestseller` tinyint(1) NOT NULL,
  `new_product` tinyint(1) NOT NULL,
  `options` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `id_category`, `id_brand`, `name`, `description`, `stock`, `price`, `price_from`, `rating`, `featured`, `sale`, `bestseller`, `new_product`, `options`) VALUES
(1, 1, 1, 'Monitor 21\"', 'Descrição do monitor', 10, 499, 599, 0, 0, 1, 1, 0, NULL),
(2, 1, 2, 'Monitor 18\"', 'Descrição do outro monitor', 10, 399, 499, 0, 0, 0, 0, 0, NULL),
(3, 1, 1, 'Monitor 23\"', 'Descrição do outro monitor', 10, 399, 466, 0, 0, 1, 0, 0, NULL),
(4, 2, 2, 'Monitor 19\"', 'Descrição do outro monitor', 10, 125, 0, 0, 0, 0, 0, 0, NULL),
(5, 2, 1, 'Monitor 14\"', 'Descrição do outro monitor', 10, 500, 300, 0, 0, 0, 0, 1, NULL),
(6, 2, 2, 'Monitor 20\"', 'Descrição do outro monitor', 10, 325, 300, 0, 0, 0, 1, 0, NULL),
(7, 2, 1, 'Monitor 17\"', 'Descrição do outro monitor', 10, 315, 300, 0, 0, 0, 0, 1, NULL),
(8, 2, 2, 'Monitor 19\"', 'Descrição do outro monitor', 10, 125, 300, 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_images`
--

CREATE TABLE `products_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_product` int(11) NOT NULL,
  `url` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `products_images`
--

INSERT INTO `products_images` (`id`, `id_product`, `url`) VALUES
(1, 1, '3.jpg'),
(2, 3, '3.jpg'),
(3, 2, '7.jpg'),
(4, 4, '3.jpg'),
(5, 8, '7.jpg'),
(6, 7, '8.jpg'),
(7, 5, '7.jpg'),
(8, 6, '3.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_options`
--

CREATE TABLE `products_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `p_value` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_coupon` int(11) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `payment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `purchases_products`
--

CREATE TABLE `purchases_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `purchase_transactions`
--

CREATE TABLE `purchase_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `amount` float NOT NULL,
  `transaction_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rates`
--

CREATE TABLE `rates` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_rated` datetime NOT NULL,
  `points` int(11) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products_options`
--
ALTER TABLE `products_options`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `purchases_products`
--
ALTER TABLE `purchases_products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `products_options`
--
ALTER TABLE `products_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `purchases_products`
--
ALTER TABLE `purchases_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
