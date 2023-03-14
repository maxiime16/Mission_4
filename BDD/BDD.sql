CREATE TABLE vehicule(
    v_num_interne VARCHAR(50) NOT NULL,
    v_marque VARCHAR(20),
    v_modele VARCHAR(20),
    v_nature VARCHAR(20),
    v_code_parc INT(10),
    v_carburant VARCHAR(10),
    v_compteur INT(10),
    PRIMARY KEY (v_num_interne)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

CREATE TABLE fourniture(
    f_id INT(10) NOT NULL AUTO_INCREMENT,
    f_date DATE,
    f_designation VARCHAR(50),
    f_code VARCHAR(50),
    f_quantite INT(10),
    f_prix FLOAT(10),
    f_type VARCHAR(50),
    f_num_bon VARCHAR(50),
    f_id_vehicule VARCHAR(50),
    PRIMARY KEY (f_id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

CREATE TABLE main_doeuvre(
    mo_id INT(10) NOT NULL AUTO_INCREMENT,
    mo_date DATE,
    mo_libelle VARCHAR(50),
    mo_temps VARCHAR(20),
    mo_num_ordre_rep VARCHAR(50),
    mo_prix FLOAT(10),
    mo_id_vehicule VARCHAR(50),
    PRIMARY KEY (mo_id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

CREATE TABLE prestation(
    p_id INT(10) NOT NULL AUTO_INCREMENT,
    p_date_debut DATE,
    p_date_fin DATE,
    p_num_marche INT(10),
    p_etat VARCHAR(50),
    p_fournisseur VARCHAR(50),
    p_nature_travaux VARCHAR(50),
    p_num_bon VARCHAR(50),
    p_prix FLOAT(10),
    p_id_vehicule VARCHAR(50),
    PRIMARY KEY (p_id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

CREATE TABLE controle(
    c_id INT NOT NULL AUTO_INCREMENT,
    c_designation VARCHAR(50),
    c_date DATE,
    c_num_or VARCHAR(50),
    c_cpt INT,
    c_cpt_dernier INT,
    c_observation VARCHAR(50),
    c_seuil INT,
    c_date_dernier DATE,
    c_date_prochain DATE,
    c_id_vehicule VARCHAR(50),
    c_prix FLOAT(10),
    PRIMARY KEY (c_id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

CREATE TABLE users(
    u_id INT NOT NULL AUTO_INCREMENT,
    u_identifiant VARCHAR (50),
    u_password VARCHAR (255),
    PRIMARY KEY (u_id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8;

ALTER TABLE fourniture ADD FOREIGN KEY (f_id_vehicule) REFERENCES vehicule(v_num_interne);
ALTER TABLE prestation ADD FOREIGN KEY (p_id_vehicule) REFERENCES vehicule(v_num_interne);
ALTER TABLE main_doeuvre ADD FOREIGN KEY (mo_id_vehicule) REFERENCES vehicule(v_num_interne);
ALTER TABLE controle ADD FOREIGN KEY (c_id_vehicule) REFERENCES vehicule(v_num_interne);


INSERT INTO users