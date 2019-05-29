DROP TABLE IF EXISTS `Representation`;

CREATE TABLE Representation(
id INTEGER, 
date DATE, 
groupe VARCHAR(255), 
idLieu INTEGER
);
 
 
 ALTER TABLE Representation ADD FOREIGN KEY (idLieu) references CUSTOMER (Lieu)