/* exemple des utilisateur(mécaniciens) ayant accès à l'application
   mot de passe: 1234   */
INSERT INTO users (u_id, u_identifiant, u_password)
VALUES (NULL, 'meca1', '$2y$10$wCz57QDRxt.neXvU8M5u3eG7Q0s7NtUZLYSyfmWiw8aPD0/lFrQiS'),
       (NULL, 'meca2', '$2y$10$wCz57QDRxt.neXvU8M5u3eG7Q0s7NtUZLYSyfmWiw8aPD0/lFrQiS'),
       (NULL, 'meca3', '$2y$10$wCz57QDRxt.neXvU8M5u3eG7Q0s7NtUZLYSyfmWiw8aPD0/lFrQiS'),
       (NULL, 'meca4', '$2y$10$wCz57QDRxt.neXvU8M5u3eG7Q0s7NtUZLYSyfmWiw8aPD0/lFrQiS'),
       (NULL, 'meca5', '$2y$10$wCz57QDRxt.neXvU8M5u3eG7Q0s7NtUZLYSyfmWiw8aPD0/lFrQiS');

/* Ajout de véhicule */
INSERT INTO vehicule(v_num_interne, v_marque, v_modele, v_nature, v_code_parc, v_carburant, v_compteur)
VALUES ('8261 TS','OPEL','CORSA','TAXI',3310,'SP 95',45000),
       ('3157 RY','FIAT','FIORINO','FOURGONETTE',2618,'SP 95',60000),
       ('0017 CL','FIAT','500','TAXI',3312,'SP 95',20000),
       ('1783 PL','TESLA','C','SEMI REMORQUE',1200,'ELECTRIQUE',17000);