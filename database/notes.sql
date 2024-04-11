DROP DATABASE IF EXISTS NoteStudio;
CREATE DATABASE NoteStudio;
USE NoteStudio;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tenants` (
  `tenant_code` varchar(5) NOT NULL,
  `tenant_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_role` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_age` int(10) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_joined` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_code` varchar(5) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_phone` (`user_phone`),
  FOREIGN KEY (`tenant_code`) REFERENCES `tenants`(`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_date` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_code` varchar(5) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`),
  FOREIGN KEY (`tenant_code`) REFERENCES `tenants`(`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `notes` (
  `note_id` int(10) NOT NULL AUTO_INCREMENT,
  `note_user` int(10) NOT NULL,
  `note_title` varchar(255) NOT NULL,
  `note_desc` longtext NOT NULL,
  `notes_status` int(10) NOT NULL,
  `note_views` int(10) NOT NULL,
  `note_cat` int(10) NOT NULL,
  `note_date` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_code` varchar(5) NOT NULL,
  PRIMARY KEY (`note_id`),
  FOREIGN KEY (`note_user`) REFERENCES `users`(`user_id`),
  FOREIGN KEY (`note_cat`) REFERENCES `categories`(`cat_id`),
  FOREIGN KEY (`tenant_code`) REFERENCES `tenants`(`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;
