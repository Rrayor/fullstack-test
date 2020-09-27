SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `fullstack_test` DEFAULT CHARACTER SET latin2 COLLATE latin2_hungarian_ci;
USE `fullstack_test`;

CREATE TABLE `list` (
  `id` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `name` varchar(255) COLLATE latin2_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

INSERT INTO `list` (`id`, `name`) VALUES
('73e2a8f1-a7ec-4b17-9452-810fc875fc38', 'birds'),
('a25e6cb8-d6e9-477e-b773-f6af7e2db306', 'mammals');

CREATE TABLE `list_item` (
  `id` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `text` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `list_id` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

INSERT INTO `list_item` (`id`, `text`, `list_id`, `position`) VALUES
('154fa736-eb95-4c6e-b246-45bc5c387df5', 'cat', 'a25e6cb8-d6e9-477e-b773-f6af7e2db306', 2),
('1f52dfb3-ce4e-4e7c-999f-40d056195093', 'penguin', '73e2a8f1-a7ec-4b17-9452-810fc875fc38', 5),
('247316dc-622d-46b8-afa0-a15d8193c67b', 'whale', 'a25e6cb8-d6e9-477e-b773-f6af7e2db306', 5),
('3094bfcc-5eb7-4f09-8ad4-7c0cce976393', 'platypus', '73e2a8f1-a7ec-4b17-9452-810fc875fc38', 6),
('4ef642c6-034b-4a70-8b77-2c013346fe89', 'bat', 'a25e6cb8-d6e9-477e-b773-f6af7e2db306', 6),
('5d85d1b1-f114-43b1-92e8-2675d1e428db', 'sparrow', '73e2a8f1-a7ec-4b17-9452-810fc875fc38', 4),
('8125d97e-773a-4510-a0b1-18e7006e9737', 'eagle', '73e2a8f1-a7ec-4b17-9452-810fc875fc38', 1),
('9148312d-63ac-4a0b-a594-6f60a9735c08', 'hawk', '73e2a8f1-a7ec-4b17-9452-810fc875fc38', 2),
('c2cb1f99-4563-46f5-9f0f-09b8f7d48bcd', 'bear', 'a25e6cb8-d6e9-477e-b773-f6af7e2db306', 1),
('c5e67f70-b172-488f-8b28-31a9f8f6a437', 'dolphin', 'a25e6cb8-d6e9-477e-b773-f6af7e2db306', 4),
('d8e38e60-d7d5-49d4-9dd3-b7961676d7bc', 'jackdaw', '73e2a8f1-a7ec-4b17-9452-810fc875fc38', 3),
('e1dfbfc7-fd01-432a-ad40-6373e105f5bf', 'dog', 'a25e6cb8-d6e9-477e-b773-f6af7e2db306', 3);

CREATE TABLE `users` (
  `id` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `username` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date NOT NULL DEFAULT current_timestamp(),
  `deletedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

INSERT INTO `users` (`id`, `username`, `password`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
('6c752c62-b70e-4ff6-9d8a-cc78357e8dc1', 'admin', '$2y$12$Ufu694i734neAucJE/ofRuiKPqy6xez0.DfeuEgy/k6tuZBwSVEdS', '2020-09-25', '2020-09-25', NULL);


ALTER TABLE `list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `list_item`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
