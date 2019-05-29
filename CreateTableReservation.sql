DROP TABLE IF EXISTS `Reservation`;

CREATE TABLE Reservation(
id INTEGER, 
idClient INTEGER,
idRepresentation INTEGER
);
 
 
 ALTER TABLE Reservation ADD FOREIGN KEY (idClient) references CUSTOMER (Client);
 ALTER TABLE Reservation ADD FOREIGN KEY (idRepresentation) references CUSTOMER (Representation):