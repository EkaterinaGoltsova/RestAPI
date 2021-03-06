SET NAMES utf8;
USE mysql;

CREATE TABLE IF NOT EXISTS authors(
	  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	  name VARCHAR(30) NOT NULL,
	  nameAblative VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS avatars(
	  		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	  		file VARCHAR(80) NOT NULL,
	  		width INT NOT NULL,
	  		height INT NOT NULL,
	  		author_id INT NOT NULL,
	  		INDEX (`author_id`)
);

ALTER TABLE `avatars`
 	ADD CONSTRAINT `fk_authors_avatars`
 	FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) 
 	ON DELETE CASCADE ON UPDATE CASCADE;