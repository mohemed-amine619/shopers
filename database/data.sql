DROP DATABASE IF EXISTS shopers;
CREATE DATABASE shopers;
DROP TABLE IF EXISTS categorie;
CREATE TABLE categorie(
    id_categorie int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle varchar(35) NOT NULL,
    icon varchar(200) NOT NULL,
    date_creation date NOT NULL
)ENGINE = INNODB;
DROP TABLE IF EXISTS produit;
CREATE TABLE produit (
    id_produit int(6) NOT NULL PRIMARY KEY,
    libelle varchar(35) NOT NULL,
    prix decimal(20,2) NOT NULL,
    qte int(5) NOT NULL,
    discount int(3) NOT NULL,
    description varchar(150) NOT NULL,
    date_creation date NOT NULL,
    image varchar(200) NOT NULL,
    id_categorie int(4) NOT NULL AUTO_INCREMENT,
    FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE = INNODB;
DROP Table if EXISTS admin ;
CREATE TABLE admin (
    id_admin int(6) NOT NULL PRIMARY KEY,
    login varchar(30) NOT NULL,
    password varchar(60) NOT NULL,
    date_creation date NOT NULL
)ENGINE = INNODB;
DROP Table if EXISTS client;
CREATE Table client(
    id_client int(6) NOT NULL PRIMARY KEY,
    nom_cl varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    num_tel int(10) NOT NULL
    password varchar(60) NOT NULL,
    date_creation date NOT NULL
)ENGINE = INNODB;
DROP Table if EXISTS commande;
CREATE Table commande(
    id_commande int(6) NOT NULL PRIMARY KEY,
    id_client int(6) NOT NULL,
    total decimal(10,2) NOT NULL,
    date_commander DATETIME NOT NULL,
    valid int(1) NOT NULL,
    recu_commande varchar(70) NOT NULL,
    FOREIGN KEY(id_client) REFERENCES client(id_client) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE = INNODB;
DROP Table if EXISTS composer;
CREATE Table composer(
    id_composer int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
     id_commande int(6) NOT NULL,
    id_produit int(6) NOT NULL,
    qte int(5) NOT NULL,
    prix decimal(10,2) NOT NULL,
    total_produit decimal(10,2) NOT NULL,
    FOREIGN KEY(id_commande) REFERENCES commande(id_commande) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(id_produit) REFERENCES produit(id_produit) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE = INNODB;
INSERT INTO ADMIN VALUES ('1111','root','e10adc3949ba59abbe56e057f20f883e','23-05-13');