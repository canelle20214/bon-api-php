DROP TABLE IF EXISTS admin;
CREATE TABLE IF NOT EXISTS admin(
    id INT NOT NULL AUTO_INCREMENT,
    mail varchar(100) NOT NULL,
    password text NOT NULL,
    nom varchar(100) NOT NULL,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS commande;
CREATE TABLE IF NOT EXISTS commande (
    id int not null AUTO_INCREMENT,
    nom varchar(100) not null,
    reference varchar(100) not null,
    prix float not null,
    status varchar(100) not null,
    insertion timestamp not null default CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS tables;
CREATE TABLE IF NOT EXISTS tables(
    id int not null AUTO_INCREMENT,
    nombre_de_personnes int not null,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS plat;
CREATE TABLE IF NOT EXISTS plat (
    id int not null AUTO_INCREMENT,
    nom varchar(100) not null,
    prix float not null,
    image text not null,
    description TEXT not null,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS reservation;
CREATE TABLE IF NOT EXISTS reservation(
    id int not null AUTO_INCREMENT,
    nom varchar(100) not null,
    nombre_reservation int not null,
    creneaux timestamp not null,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS plat_commande;
CREATE TABLE IF NOT EXISTS plat_commande(
    id int not null AUTO_INCREMENT,
    plat_id int NOT NULL,
    commande_id int not NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (plat_id) REFERENCES plat(id) ON DELETE CASCADE,
    FOREIGN KEY (commande_id) REFERENCES commande(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS table_reservation;
CREATE TABLE IF NOT EXISTS table_reservation(
    id int not null,
    reservation_id int not null,
    tables_id int not null,
    PRIMARY KEY (id), 
    FOREIGN KEY (reservation_id) references reservation(id) ON DELETE CASCADE,
    FOREIGN KEY (tables_id) references tables(id) ON DELETE CASCADE
);

-------------------------------- 
INSERT INTO `plat` (`id`, `nom`, `prix`, `image`, `description`) VALUES
(2, 'Fourmis rouges avec du boeuf et du basilic', 25.6, 'https://www.mamawax.fr/img/cms/banniere-conseils-fourmis-rouges.jpg', 'Des fourmis de différentes tailles, dont certaines sont à peine visibles et d\'autres de presque un pouce de long, sont sautés avec du gingembre, de la citronnelle, de l\'ail, des échalotes et du bœuf émincé.\r\n\r\nBeaucoup de piments complètent le plat aromatique, sans dominer la saveur aigre délicate que les fourmis donnent au bœuf.\r\n\r\nCe repas est servi avec du riz, et si vous êtes chanceux, vous aurez aussi une partie de larves de fourmis dans votre bol.');


insert into commande(nom, reference, prix,status, insertion) values ('Alexandre', 'Test',14.3," En cours de préparation","2022-01-19 03:14:07");
insert into plat_commande(plat_id, commande_id) values (2,1);
INSERT INTO `reservation`( `nom`, `nombre_reservation`, `creneaux`) VALUES ('Alexandre',4,'2038-01-19 03:14:07'); 