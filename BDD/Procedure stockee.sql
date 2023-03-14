/* PROCEDURE QUI PERMET DE VÉRIFIER SI UN VÉHICULE EST DEJA PRÉSENT ET DE L'AJOUTER S'IL NE L'EST PAS */
DELIMITER //
CREATE PROCEDURE ajoutVehicule(IN num_interne INT(10), IN marque VARCHAR(50), IN modele VARCHAR(50), IN nature VARCHAR(50), IN codeParc INT(10), IN carburant VARCHAR(50), IN compteur INT(10) )
BEGIN
    DECLARE vehiculeExiste INT;

    SELECT COUNT(*) INTO vehiculeExiste FROM vehicule WHERE v_num_interne = num_interne;

    IF vehiculeExiste = 0 THEN
        INSERT INTO vehicule(v_num_interne, v_marque, v_modele, v_nature, v_code_parc, v_carburant, v_compteur) VALUES (num_interne, marque, modele, nature, codeParc, carburant, compteur);
    END IF;
END //
DELIMITER ;


/* PROCEDURE QUI PERMET DE FAIRE LES AFFICHAGE DE TABLEAU POUR LE CARNET DE SANTÉ*/
DELIMITER //
CREATE PROCEDURE afficher(IN choice VARCHAR(50), IN id_vehicule VARCHAR(50) )
BEGIN
    CASE choix
        WHEN 'vehicule' THEN
            SELECT * FROM vehicule WHERE v_num_interne = id_vehicule;
        WHEN 'fourniture' THEN
            SELECT * FROM fourniture WHERE f_id_vehicule = id_vehicule;
        WHEN 'prestation' THEN
            SELECT * FROM prestation WHERE p_id_vehicule = id_vehicule;
        WHEN 'main doeuvre' THEN
            SELECT * FROM main_doeuvre WHERE mo_id_vehicule =id_vehicule;
        WHEN 'controle' THEN
            SELECT * FROM controle WHERE c_id_vehicule =id_vehicule;
        WHEN 'controle' THEN
            SELECT * FROM users;
        ELSE
            SELECT 'Invalid choice' AS message;
    END CASE;
END //
DELIMITER ;

    /* PROCEDURE QUI PERMET DE FAIRE LA SOMME POUR LE PRX TOTAL DE TABLEAU POUR LE CARNET DE SANTÉ*/
DELIMITER //
CREATE PROCEDURE SommePrix(IN choix VARCHAR(50), IN id_vehicule VARCHAR(50) )
BEGIN
    CASE choix
        WHEN 'fourniture' THEN
            SELECT SUM(f_quantite * f_prix) AS total_prix FROM fourniture WHERE f_id_vehicule = id_vehicule;
        WHEN 'prestation' THEN
            SELECT SUM(p_prix) AS total_prix FROM prestation WHERE p_id_vehicule = id_vehicule;
        WHEN 'main doeuvre' THEN
            SELECT SUM(mo_prix) AS total_prix FROM main_doeuvre WHERE mo_id_vehicule = id_vehicule;
        WHEN 'controle' THEN
            SELECT SUM(mo_prix) AS total_prix FROM controle WHERE c_id_vehicule = id_vehicule;
        ELSE
            SELECT 'Invalid choice' AS message;
        END CASE;
END //
DELIMITER ;


    DELIMITER //
CREATE PROCEDURE AjoutFourniture( IN date DATE, IN designation VARCHAR(50), IN code VARCHAR(50),IN quantite INT(10),IN prix FLOAT(10),IN type VARCHAR(50),IN num_bon VARCHAR(50), IN id VARCHAR(50))
BEGIN
INSERT INTO fourniture (f_id, f_date, f_designation, f_code, f_quantite, f_prix, f_type, f_num_bon, f_id_vehicule) VALUES (NULL, date, designation, code, quantite, prix, type, num_bon , id);
END //
DELIMITER ;