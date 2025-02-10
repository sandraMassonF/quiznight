-- Insertion des utilisateurs
INSERT INTO utilisateur (pseudo, password, score) VALUES
('yannick', 'quiz123', 0),
('james', 'quiz123', 0),
('sandra', 'quiz123', 0);

-- Insertion des quiz
INSERT INTO quiz (titre, description, image, id_user) VALUES
('Dragon Ball Z', 'Testez vos connaissances sur Dragon Ball Z', 'dbz.jpg', 1),
('One Piece', 'Êtes-vous un vrai pirate de One Piece ?', 'onepiece.jpg', 2),
('Seven Deadly Sins', 'Connaissez-vous bien les Seven Deadly Sins ?', 'sds.jpg', 3);

-- Insertion des questions et réponses pour le quiz "Dragon Ball Z"
INSERT INTO question (question, id_quiz) VALUES
("Comment s\'appelle le père de Goku ?", 1),
('Quelle est la transformation la plus puissante de Goku dans DBZ ?', 1),
('Qui a tué Freezer sur Namek ?', 1),
("Quel est le nom de l\'attaque signature de Vegeta ?", 1);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Raditz', FALSE, 1), ('Bardock', TRUE, 1), ('Nappa', FALSE, 1), ('King Vegeta', FALSE, 1),
('Super Saiyan', FALSE, 2), ('Super Saiyan 3', FALSE, 2), ('Super Saiyan God', FALSE, 2), ('Super Saiyan Blue', TRUE, 2),
('Goku', FALSE, 3), ('Trunks du futur', TRUE, 3), ('Vegeta', FALSE, 3), ('Gohan', FALSE, 3),
('Final Flash', TRUE, 4), ('Big Bang Attack', FALSE, 4), ('Kamehameha', FALSE, 4), ('Masenko', FALSE, 4);

-- Insertion des questions et réponses pour le quiz "One Piece"
INSERT INTO question (question, id_quiz) VALUES
('Quel est le rêve de Monkey D. Luffy ?', 2),
("Qui est le premier membre à rejoindre l'équipage de Luffy ?", 2),
("Comment s'appelle l'île où se trouve le One Piece ?", 2),
('Quel fruit du démon possède Trafalgar Law ?', 2);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Devenir le roi des mers', FALSE, 5), ('Devenir le Roi des Pirates', TRUE, 5), ("Devenir l\'homme le plus fort", FALSE, 5), ('Trouver tous les trésors', FALSE, 5),
('Sanji', FALSE, 6), ('Zoro', TRUE, 6), ('Nami', FALSE, 6), ('Usopp', FALSE, 6),
('Raftel', TRUE, 7), ('Marineford', FALSE, 7), ('Dressrosa', FALSE, 7), ('Wano', FALSE, 7),
('Gomu Gomu no Mi', FALSE, 8), ('Ope Ope no Mi', TRUE, 8), ('Mera Mera no Mi', FALSE, 8), ('Yami Yami no Mi', FALSE, 8);

-- Insertion des questions et réponses pour le quiz "Seven Deadly Sins"
INSERT INTO question (question, id_quiz) VALUES
('Quel est le péché de Meliodas ?', 3),
("Comment s\'appelle l\'épée de Meliodas ?", 3),
("Quel est le vrai nom d\'Escanor ?", 3),
("Qui est l\'amour perdu de Ban ?", 3);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Péché de la colère', TRUE, 9), ('Péché de la gourmandise', FALSE, 9), ("Péché de l\'envie", FALSE, 9), ('Péché de la luxure', FALSE, 9),
('Démon Blade', FALSE, 10), ('Lostvayne', TRUE, 10), ('Excalibur', FALSE, 10), ('Ragnarok', FALSE, 10),
('Arthur', FALSE, 11), ('Escanor', FALSE, 11), ('Lionel', FALSE, 11), ('Son vrai nom est inconnu', TRUE, 11),
('Diane', FALSE, 12), ('Elaine', TRUE, 12), ('Elizabeth', FALSE, 12), ('Merlin', FALSE, 12);