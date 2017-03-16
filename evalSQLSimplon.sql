-- On crée le schema hospital
CREATE DATABASE IF NOT EXISTS `hospital`;
-- On uttilise le schema hospital
USE `hospital`;

-- On crée la table Patient
CREATE TABLE IF NOT EXISTS `hospital`.`patient` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `gender` ENUM('Male', 'Female') NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- On crée la table Staff
CREATE TABLE IF NOT EXISTS `hospital`.`staff` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `gender` ENUM('Male', 'Female') NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  `speciality` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- On crée la table Address
CREATE TABLE IF NOT EXISTS `hospital`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `address` VARCHAR(255) NOT NULL,
  `zipcode` VARCHAR(20) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `patient_id` INT,
  `staff_id` INT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`patient_id`)
  REFERENCES `hospital`.`patient` (`id`),
  FOREIGN KEY (`staff_id`)
  REFERENCES `hospital`.`staff` (`id`)
) ENGINE = InnoDB;


-- On crée la table Bills
CREATE TABLE IF NOT EXISTS `hospital`.`bills` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bill_number` VARCHAR(45) NOT NULL,
  `total_price` DECIMAL(10,2) NOT NULL,
  `paid` DATETIME NOT NULL,
  `patient_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`patient_id`)
  REFERENCES `hospital`.`patient` (`id`)
) ENGINE = InnoDB;


-- On crée la table Bills_Items
CREATE TABLE IF NOT EXISTS `hospital`.`bills_items` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `quantity` INT NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `bills_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`bills_id`)
  REFERENCES `hospital`.`bills` (`id`)
) ENGINE = InnoDB;


-- On crée la table Room
CREATE TABLE IF NOT EXISTS `hospital`.`room` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `room_number` INT NOT NULL,
  `occupied_from` DATETIME NOT NULL,
  `occupied_until` DATETIME NOT NULL,
  `patient_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`patient_id`)
  REFERENCES `hospital`.`patient` (`id`)
) ENGINE = InnoDB;


-- On crée la table Records_Component
CREATE TABLE IF NOT EXISTS `hospital`.`record_component` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `record` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- On crée la table Records
CREATE TABLE IF NOT EXISTS `hospital`.`records` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type_of_record` VARCHAR(45) NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `patient_id` INT NOT NULL,
  `record_component_id` INT NOT NULL,
  `staff_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`patient_id`)
  REFERENCES `hospital`.`patient` (`id`),
  FOREIGN KEY (`record_component_id`)
  REFERENCES `hospital`.`record_component` (`id`),
  FOREIGN KEY (`staff_id`)
  REFERENCES `hospital`.`staff` (`id`)
) ENGINE = InnoDB;


-- On crée la table Payment_Method
CREATE TABLE IF NOT EXISTS `hospital`.`payment_method` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type_of_payment` VARCHAR(45) NOT NULL,
  `patient_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`patient_id`)
  REFERENCES `hospital`.`patient` (`id`)
) ENGINE = InnoDB;


-- le(s) script(s) de création des utilisateurs avec leur(s) droit(s)

-- On crée un uttilisateur et un password pour la database hospital
CREATE USER 'hospital'@'localhost' IDENTIFIED BY 'hospital';
GRANT ALL PRIVILEGES ON hospital.* TO 'hospital'@'localhost';

-- le(s) script(s) d’insertion de données
-- On insere des patients

INSERT INTO `hospital`.`patient` (`firstname`,`lastname`,`date_of_birth`,`gender`,`phone_number`) VALUES
('Jennifer', 'Hunt', '1998-12-01', 'Female', '221-(385)515-3504'),
('Walter', 'Parker', '1979-03-11', 'Male', '39-(542)782-7329'),
('Anne', 'Perry', '1953-10-20', 'Female', '46-(813)707-4801'),
('Willie', 'Austin', '1987-06-14', 'Male', '51-(111)948-2455'),
('Victor', 'Coleman', '1995-09-24', 'Male', '46-(664)615-2656'),
('Pamela', 'Ryan', '1980-08-05', 'Female', '351-(861)478-0810'),
('Joyce', 'Morris', '1992-06-17', 'Female', '46-(874)147-2510'),
('Janice', 'Allen', '1972-07-04', 'Female', '976-(245)550-5888'),
('Raymond', 'Mccoy', '1958-07-10', 'Male', '216-(154)585-9237'),
('Nicholas', 'Cunningham', '1976-06-27', 'Male', '970-(156)209-1013');

-- On insere du staff
INSERT INTO `hospital`.`staff` (`firstname`,`lastname`,`date_of_birth`,`gender`,`phone_number`, `speciality`) VALUES
('Jennifer', 'Harper', '1982-02-27', 'Female', '380-(227)209-9458', 'Baclofen'),
('Sharon', 'Kelly', '1972-04-07', 'Female', '52-(598)745-5811', 'ACETAMINOPHEN, CHLORPHENIRAMINE MALEATE, DEXTROMETHORPHAN HYDROBROMIDE'),
('Roger', 'Gordon', '1951-08-08', 'Male', '86-(651)155-9275', 'Blue Spruce'),
('Julie', 'Alvarez', '1954-06-23', 'Female', '1-(900)634-6827', 'Avobenzone, Octinoxate, Octisalate'),
('Christopher', 'Mills', '1979-08-05', 'Male', '62-(959)325-4643', 'Ibuprofen'),
('Sharon', 'Olson', '1961-05-08', 'Female', '39-(769)577-6460', 'Doxepin Hydrochloride'),
('Doris', 'Baker', '1982-12-30', 'Female', '380-(865)504-4626', 'OCTINOXATE, OXYBENZONE'),
('Ernest', 'Hanson', '2001-06-15', 'Male', '48-(841)264-5149', 'White Ash'),
('Annie', 'Hughes', '1999-06-24', 'Female', '86-(367)886-6927', 'ciprofloxacin hydrochloride'),
('Tammy', 'Adams', '1997-11-16', 'Female', '33-(264)883-1447', 'Argentum Malachite Athletes Foot Relief');

-- On insere des adresses pour les patients et le staff
INSERT INTO `hospital`.`address` (`address`, `zipcode`, `city`, `patient_id`, `staff_id`) VALUES
('908 Texas Plaza', '90112', 'Taoyuan', null, 1),
('4 Kedzie Place', '90110', 'Hat Yai', null, 2),
('89 4th Plaza', '90120', 'Hod HaSharon', null, 3),
('4 Independence Crossing', '92110', 'Mandiana', null, 4),
('15442 Waxwing Trail', '93110', 'Beigao', null, 5),
('2 Dapin Court', 'J6V', 'Repentigny', null, 6),
('77 Dayton Park', '95110', 'Chengjiang', null, 7),
('91 Banding Terrace', '962-0305', 'Moriya', null, 8),
('68185 Dayton Road', '2710-145', 'Carrascal', null, 9),
('70356 Merchant Street', '9034', 'Changqing', null, 10),
('6 Cordelia Court', '111831', 'Bogotá', 1, null),
('8 Fremont Lane', '91110', 'Tabou', 2, null),
('90443 Vera Drive', '90110', 'Huashan', 3, null),
('6 Homewood Trail', 'K1W', 'Altona', 4, null),
('01916 Springview Place', '90110', 'Shahrisabz Shahri', 5, null),
('041 Golf View Parkway', '69902 CEDEX 20', 'Lyon', 6, null),
('9 Trailsway Parkway', '4329', 'Sampaloc', 7, null),
('563 Ridgeway Way', '90110', 'Tarkwa', 8, null),
('96512 Sutherland Place', '31150', 'Srinagarindra', 9, null),
('72077 Pine View Alley', '90110', 'Gantang', 10, null);

-- On Insere des rooms pour les patients
INSERT INTO `hospital`.`room` (`room_number`, `occupied_from`, `occupied_until`, `patient_id`) VALUES
('667', '2017-03-16 00:00:00', '2017-07-17 09:09:40', 1),
('095', '2017-03-16 00:00:00', '2017-11-02 11:25:54', 2),
('49697', '2017-03-16 00:00:00', '2017-06-13 09:46:09', 3),
('67543', '2017-03-16 00:00:00', '2017-08-07 06:22:58', 4),
('3845', '2017-03-16 00:00:00', '2017-11-19 17:13:54', 5),
('64905', '2017-03-16 00:00:00', '2017-08-14 05:45:37', 6),
('7', '2017-03-16 00:00:00', '2017-09-19 06:15:31', 7),
('4', '2017-03-16 00:00:00', '2017-06-25 22:05:09', 8),
('15', '2017-03-16 00:00:00', '2017-12-11 13:14:11', 9),
('102', '2017-03-16 00:00:00', '2018-02-13 21:36:11', 10);

-- On insere des payment_methods pour les patients
INSERT INTO `hospital`.`payment_method` (type_of_payment, patient_id) VALUES
('visa', 1),
('diners-club-enroute', 2),
('jcb', 3),
('jcb', 4),
('mastercard', 5),
('laser', 6),
('visa-electron', 7),
('mastercard', 8),
('jcb', 9),
('visa-electron', 10);

-- On insere des bills
INSERT INTO `hospital`.`bills` (`bill_number`, `total_price`, `paid`, `patient_id`) VALUES
('9900108175', 55.18, '2017-02-14 02:43:36', 1),
('2606980565', 73.61, '2016-06-11 17:00:43', 2),
('6283589944', 62.71, '2016-10-05 18:43:27', 3),
('24077456810', 94.41, '2016-05-21 00:46:19', 4),
('8340269402', 61.52, '2016-03-29 22:21:34', 5),
('4649998689', 57.99, '2016-11-28 03:28:58', 6),
('0332851133', 92.6, '2016-07-13 05:53:45', 7),
('2509774573', 68.5, '2016-04-29 20:37:50', 8),
('2515757944', 92.79, '2017-02-16 13:47:27', 9),
('0676085415', 57.3, '2016-05-27 02:17:28', 10);

-- On insere des Bills_Items
INSERT INTO `hospital`.`bills_items` (`description`, `quantity`, `total`, `bills_id`) VALUES
('Customizable', 81, 2845.29, 1),
('Public-key', 10, 1532.65, 2),
('Front-line', 61, 4741.23, 3),
('Devolved', 94, 9815.76, 4),
('instruction set', 81, 12410.35, 5),
('portal', 20, 2283.92, 6),
('Future-proofed', 100, 5798.41, 7),
('policy', 43, 6046.15, 8),
('moderator', 85, 960.9, 9),
('local', 1, 2978.91, 10);

-- On insere des Records_Component
INSERT INTO `hospital`.`record_component` (`record`) VALUES
('Excision of Thoracic Vertebra, Percutaneous Endoscopic Approach'),
('Ultrasonography of Left Hand, Densitometry'),
('Replacement of Left Thumb Phalanx with Nonautologous Tissue Substitute, Percutaneous Endoscopic Approach'),
('Revision of Infusion Device in Upper Extremity Subcutaneous Tissue and Fascia, Percutaneous Approach'),
('Fluoroscopy of Right Hip using High Osmolar Contrast'),
('Drainage of Hypoglossal Nerve with Drainage Device, Open Approach'),
('Opn aortic valvuloplasty'),
('Diagnostic asp of orbit'),
('Ureteral operation NEC'),
('Open reduc-metac/car fx'),
('Permanent ileostomy NEC'),
('Remov other genit device');

-- On insere des Records
INSERT INTO `hospital`.`records` (`type_of_record`, `updated_at`, `patient_id`, `record_component_id`, `staff_id`) VALUES
('Diagnosis', '2016-11-17 04:41:44', 1, 1, 1),
('Diagnosis', '2016-06-05 12:55:04', 2, 2, 2),
('Diagnosis', '2016-03-25 18:38:07', 3, 3, 3),
('Diagnosis', '2016-12-06 21:50:49', 6, 6, 6),
('Diagnosis', '2016-04-03 17:26:33', 7, 7, 7),
('Diagnosis', '2016-09-02 21:55:23', 8, 8, 8),
('Medication', '2016-06-19 21:36:55', 4, 4, 4),
('Medication', '2017-01-26 01:31:08', 5, 5, 5),
('Medication', '2016-06-12 20:07:33', 9, 9, 9),
('Medication', '2016-08-20 02:56:38', 10, 10, 10);
