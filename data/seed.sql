-- Insertion des utilisateurs
INSERT INTO utilisateur (pseudo, password, score) VALUES
('yannick', 'quiz123', 10),
('james', 'quiz123', 10),
('sandra', 'quiz123', 10);

-- Insertion des quiz (3 par thème)
INSERT INTO quiz (titre, description, image, id_user) VALUES
('Dragon Ball Z - Saiyans', 'Connaissez-vous les Saiyans ?', 'dbz_saiyans.jpg', 1),
('Dragon Ball Z - Ennemis', 'Testez vos connaissances sur les ennemis de DBZ', 'dbz_ennemis.jpg', 2),
('Dragon Ball Z - Transformations', 'Quiz sur les transformations de DBZ', 'dbz_transfo.jpg', 3),
('One Piece - Chapeau de paille', 'Que savez-vous de l\'équipage du Chapeau de Paille ?', 'onepiece_strawhats.jpg', 4),
('One Piece - Marines', 'Quiz sur les Marines et la Marineford', 'onepiece_marines.jpg', 5),
('One Piece - Fruits du Démon', 'Testez vos connaissances sur les Fruits du Démon', 'onepiece_fruits.jpg', 6),
('Naruto - Hokage', 'Tout savoir sur les Hokages de Konoha', 'naruto_hokage.jpg', 7),
('Naruto - Akatsuki', 'Testez vos connaissances sur l\'Akatsuki', 'naruto_akatsuki.jpg', 8),
('Naruto - Jutsus', 'Quiz sur les techniques ninjas de Naruto', 'naruto_jutsus.jpg', 9);

-- Insertion des questions et réponses pour chaque quiz

-- Dragon Ball Z - Saiyans
INSERT INTO question (question, id_quiz) VALUES
('Quel est le vrai nom de Vegeta ?', 1),
('Quel Saiyan a atteint le premier le Super Saiyan ?', 1),
('Qui est le frère de Goku ?', 1),
('Quel Saiyan est considéré comme une légende ?', 1),
('Qui a détruit la planète Vegeta ?', 1),
('Quel Saiyan a survécu à la destruction de la planète Vegeta ?', 1);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Vegeta IV', TRUE, 1), ('Prince Kakarot', FALSE, 1), ('King Vegeta II', FALSE, 1), ('Tarble', FALSE, 1),
('Goku', FALSE, 2), ('Vegeta', FALSE, 2), ('Bardock', FALSE, 2), ('Freezer', TRUE, 2),
('Raditz', TRUE, 3), ('Bardock', FALSE, 3), ('Vegeta', FALSE, 3), ('Nappa', FALSE, 3),
('Broly', TRUE, 4), ('Goku', FALSE, 4), ('Gohan', FALSE, 4), ('Trunks', FALSE, 4),
('Freezer', TRUE, 5), ('Beerus', FALSE, 5), ('Cell', FALSE, 5), ('Babidi', FALSE, 5),
('Goku', TRUE, 6), ('Nappa', FALSE, 6), ('Raditz', FALSE, 6), ('Bardock', FALSE, 6);

-- Naruto - Hokage
INSERT INTO question (question, id_quiz) VALUES
('Qui est le premier Hokage ?', 7),
('Quel Hokage a sacrifié sa vie pour sceller Kyubi ?', 7),
('Qui est le 5ème Hokage ?', 7),
('Quel Hokage a combattu Orochimaru ?', 7),
('Qui est le père de Naruto ?', 7),
('Quel Hokage est considéré comme le Dieu des Shinobi ?', 7);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Hashirama Senju', TRUE, 19), ('Tobirama Senju', FALSE, 19), ('Minato Namikaze', FALSE, 19), ('Hiruzen Sarutobi', FALSE, 19),
('Hiruzen Sarutobi', TRUE, 20), ('Minato Namikaze', FALSE, 20), ('Tobirama Senju', FALSE, 20), ('Hashirama Senju', FALSE, 20),
('Tsunade', TRUE, 21), ('Kakashi', FALSE, 21), ('Naruto', FALSE, 21), ('Hiruzen', FALSE, 21),
('Hiruzen Sarutobi', TRUE, 22), ('Minato', FALSE, 22), ('Tobirama', FALSE, 22), ('Danzo', FALSE, 22),
('Minato Namikaze', TRUE, 23), ('Naruto Uzumaki', FALSE, 23), ('Jiraiya', FALSE, 23), ('Sasuke Uchiha', FALSE, 23),
('Hashirama Senju', TRUE, 24), ('Tobirama Senju', FALSE, 24), ('Hiruzen Sarutobi', FALSE, 24), ('Minato Namikaze', FALSE, 24);