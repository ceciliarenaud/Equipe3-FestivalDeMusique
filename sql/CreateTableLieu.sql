GRANT ALL ON festival . * TO 'festival'@'localhost' IDENTIFIED BY 'secret';

DROP TABLE IF EXISTS `Lieu`;
 
CREATE TABLE Lieu
(id char(8) not null, 
nomLieu varchar(45) not null,
adresseLieu varchar(100) not null, 
capaciteLieu char(5),
constraint pk_Lieu primary key(id))
ENGINE=INNODB;