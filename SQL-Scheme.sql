CREATE TABLE IF NOT EXISTS `user` ( -- eğer daha önce tanımlanmamışsa "doctor" tablosunu oluşturuyoruz
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- id'ler otomatik artacak
	`name`			VARCHAR(50) NOT NULL, -- ALT + 9 + 6	
	`mail`			VARCHAR(100) NOT NULL,
	`password`		VARCHAR(50) NOT NULL,
	`status`		TINYINT NOT NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), -- kayıt ne zaman eklenirse otomatik tarih girecek
	UNIQUE (`mail`) -- aynı mail ile tekrar kayıt girilmesin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`name`, `mail`, `password`, `status`)
VALUES ('Dilfuza Karimova', 'dilfuza@karimova.com', '12345', '1');


CREATE TABLE IF NOT EXISTS `specialization` (
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`specialization`	VARCHAR(50) NOT NULL,	
	`description`	VARCHAR(200) NULL,
	`status`		TINYINT NOT NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	UNIQUE (`specialization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `doctor` ( -- eğer daha önce tanımlanmamışsa "doctor" tablosunu oluşturuyoruz
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- id'ler otomatik artacak
	`name`			VARCHAR(50) NOT NULL, -- ALT + 9 + 6
	`phone`			VARCHAR(50) NULL,
	`description`	VARCHAR(200) NULL,
	`status`		TINYINT NOT NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), -- kayıt ne zaman eklenirse otomatik tarih girecek
	UNIQUE (`name`), -- aynı mail ile tekrar kayıt girilmesin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `doctor` (`name`, `mail`, `password`, `phone`, `description`, `status`)
VALUES ('Dilfuza Karimova', 'dilfuza@karimova.com', '12345', '1234567', 'açıklama', '1');


CREATE TABLE IF NOT EXISTS `patient` (
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`name`			VARCHAR(50) NOT NULL,
	`mail`			VARCHAR(100) NOT NULL,
	`password`		VARCHAR(50) NOT NULL,
	`phone`			VARCHAR(50) NULL,
	`birthyear`		INT NOT NULL,
	`address`		VARCHAR(100) NULL,
	`relative`		VARCHAR(100) NULL,
	`history`		VARCHAR(500) NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	UNIQUE (`mail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `timeslots` (
	`id`			BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- daha fazla veri olacağı için bigint yaptık
	`doctor`		INT NOT NULL,
	`slottime`		DATETIME NOT NULL,
	`status`		TINYINT NOT NULL, -- 0-slot açmadı, 1-slot açtı, 2-slot dolu
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	UNIQUE (`doctor`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
