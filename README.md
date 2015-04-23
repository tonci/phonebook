# phonebook
Simple PhoneBook Application

# How to install
*  Make sure you have web server installed with php version >= 5.5.*
*  Navigate to web accesible folder and execute:
```
git clone https://github.com/tonci/phonebook phonebook
```
*  Get dependencies: [Additional instructions](https://getcomposer.org/doc/00-intro.md)
```
composer install
```
*  Open config/db.php and setup a database
*  Run this SQL:
```
CREATE DATABASE IF NOT EXISTS `phonebook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `phonebook`;

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```
