/*
|
|	REMOVING UNEEDED TABLES
|
*/
DROP TABLE `faq`;
DROP TABLE `migrations`;
DROP TABLE `compo`;
DROP TABLE `compo_join`;
DROP TABLE `compo_team`;
DROP TABLE `cron_job`;
DROP TABLE `cron_manager`;

/*
|
|	FIXING THE USERS TABLE
|
*/
/* DROP COLUMNS */
ALTER TABLE `users` DROP password_temp;
ALTER TABLE `users` DROP code;
ALTER TABLE `users` DROP arrived;
ALTER TABLE `users` DROP reservedcount;
ALTER TABLE `users` DROP address;
ALTER TABLE `users` DROP active;
ALTER TABLE `users` DROP ismod;
ALTER TABLE `users` DROP isadmin;
ALTER TABLE `users` DROP issuperadmin;
ALTER TABLE `users` DROP remember_token;
ALTER TABLE `users` DROP zipcode;
ALTER TABLE `users` DROP author_id;
ALTER TABLE `users` DROP deleted_at;

/* ADD AND UPDATE COLUMNS */
ALTER TABLE `users` CHANGE `uid` `uid` INT(11) NOT NULL AFTER `id`;
ALTER TABLE `users` CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `uid`;
ALTER TABLE `users` CHANGE `password` `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `email`;
ALTER TABLE `users` ADD `permissions` TEXT NOT NULL AFTER `password`;
ALTER TABLE `users` ADD `last_login` TIMESTAMP NULL AFTER `permissions`;
ALTER TABLE `users` CHANGE `firstname` `firstname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `last_login`;
ALTER TABLE `users` CHANGE `lastname` `lastname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `firstname`;
ALTER TABLE `users` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `lastname`;
ALTER TABLE `users` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `created_at`;
ALTER TABLE `users` CHANGE `username` `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `updated_at`;
ALTER TABLE `users` CHANGE `gender` `gender` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `username`;
ALTER TABLE `users` CHANGE `location` `location` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `gender`;
ALTER TABLE `users` CHANGE `occupation` `occupation` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `location`;
ALTER TABLE `users` ADD `birthdate` DATE NOT NULL DEFAULT '1970-01-01' AFTER `occupation`;
ALTER TABLE `users` CHANGE `last_activity` `last_activity` TIMESTAMP NULL DEFAULT NULL AFTER `birthdate`;
ALTER TABLE `users` CHANGE `profilepicture` `profilepicture` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `last_activity`;
ALTER TABLE `users` CHANGE `profilepicturesmall` `profilepicturesmall` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `profilepicture`;
ALTER TABLE `users` ADD `profilecover` VARCHAR(255) NULL AFTER `profilepicturesmall`;
ALTER TABLE `users` CHANGE `referral` `referral` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `profilecover`;
ALTER TABLE `users` CHANGE `referral_code` `referral_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `referral`;
ALTER TABLE `users` CHANGE `userdateformat` `userdateformat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'd. M Y' AFTER `referral_code`;
ALTER TABLE `users` CHANGE `usertimeformat` `usertimeformat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'H:i' AFTER `userdateformat`;
ALTER TABLE `users` CHANGE `showemail` `showemail` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' AFTER `usertimeformat`;
ALTER TABLE `users` CHANGE `showname` `showname` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' AFTER `showemail`;
ALTER TABLE `users` CHANGE `showonline` `showonline` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' AFTER `showname`;

/*
|
|	FIXING THE NEWS TABLE
|
*/
/* ADD AND UPDATE COLUMNS */
ALTER TABLE `news` CHANGE `title` `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `id`;
ALTER TABLE `news` ADD `slug` VARCHAR(255) NOT NULL AFTER `title`;
ALTER TABLE `news` CHANGE `content` `content` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `slug`;
ALTER TABLE `news` ADD `category_id` INT NOT NULL DEFAULT '1' AFTER `content`;
ALTER TABLE `news` ADD `author_id` INT NOT NULL AFTER `category_id`;
ALTER TABLE `news` CHANGE `author_id` `editor_id` INT(11) NOT NULL AFTER `author_id`;
ALTER TABLE `news` CHANGE `active` `active` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' AFTER `editor_id`;
ALTER TABLE `news` ADD `published_at` DATETIME NOT NULL AFTER `active`;
ALTER TABLE `news` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `published_at`;
ALTER TABLE `news` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `created_at`;
ALTER TABLE `news` CHANGE `deleted_at` `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;
