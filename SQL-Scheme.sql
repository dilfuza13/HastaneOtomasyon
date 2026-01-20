CREATE TABLE IF NOT EXISTS `user` ( -- eğer daha önce tanımlanmamışsa "doctor" tablosunu oluşturuyoruz
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- id'ler otomatik artacak
	`name`			VARCHAR(50) NOT NULL, -- ALT + 9 + 6	
	`username`		VARCHAR(50) NOT NULL,
	`password`		VARCHAR(50) NOT NULL,
	`status`		TINYINT NOT NULL, -- 0 Pasif, 1 Aktif
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), -- kayıt ne zaman eklenirse otomatik tarih girecek
	UNIQUE (`username`) -- aynı username ile tekrar kayıt girilmesin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`name`, `username`, `password`, `status`)
	VALUES 	('Admin', 'admin', '12345', 1),
			('Dilfuza Karimova', 'dilfuza', '12345', '1');


CREATE TABLE IF NOT EXISTS `specialization` (
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`specialization`	VARCHAR(50) NOT NULL,	
	`description`	VARCHAR(200) NULL,
	`status`		TINYINT NOT NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	UNIQUE (`specialization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `specialization` (`specialization`, `description`, `status`)
	VALUES 	('Acil Tıp', 'Acil Tıp', 1),
			('İç Hastalıkları', 'adİç Hastalıklarımin', 1),
			('Kardiyoloji', 'Kardiyoloji', 1),
			('Göz Hastalıkları', 'Göz Hastalıkları', 1),
			('Çocuk Sağlığı ve Hastalıkları', 'Çocuk Sağlığı ve Hastalıkları', 1),
			('Beyin Cerrahisi', 'Beyin Cerrahisi', 1),
			('Genel Cerrahi', 'Genel Cerrahi', 1),
			('Kadın Hastalıkları ve Doğum', 'Kadın Hastalıkları ve Doğum', 1),
			('Ortopedi', 'Ortopedi', 1),
			('KBB', 'KBB', 1),
			('Dermatoloji', 'Dermatoloji', 1);


CREATE TABLE IF NOT EXISTS `doctor` ( -- eğer daha önce tanımlanmamışsa "doctor" tablosunu oluşturuyoruz
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- id'ler otomatik artacak
	`name`			VARCHAR(50) NOT NULL, -- ALT + 9 + 6
	`specialization`	INT NOT NULL,
	`description`	VARCHAR(200) NULL,
	`phone`			VARCHAR(50) NULL,
	`profilephoto`	VARCHAR(200) NULL,
	`status`		TINYINT NOT NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), -- kayıt ne zaman eklenirse otomatik tarih girecek
	UNIQUE (`name`) -- aynı mail ile tekrar kayıt girilmesin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `doctor` (`name`, `specialization`, `description`, `phone`, `status`)
	VALUES	('Dilfuza Karimova', '1', 'Dilfuza Karimova hakkında', '1234567', '1'),
			('Doctor Strange', '2', 'Doctor Strange hakkında', '1234567', '1');


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


CREATE TABLE IF NOT EXISTS `timeslot` (
	`id`			BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- daha fazla veri olacağı için bigint yaptık
	`doctor`		INT NOT NULL,
	`timeslot`		DATETIME NOT NULL,
	`status`		TINYINT NOT NULL, -- 0-slot açmadı, 1-slot açtı, 2-slot dolu
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	UNIQUE (`doctor`,`timeslot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `appointment` (
	`id`			INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`doctor`		INT NOT NULL,
	`patient`		INT NOT NULL,
	`timeslot`		DATETIME NOT NULL,
	`status`		TINYINT NOT NULL,
	`createdtime`	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	UNIQUE (`doctor`, `timeslot`),
	UNIQUE (`patient`, `timeslot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

