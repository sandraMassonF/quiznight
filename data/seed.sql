-- Insertion des utilisateurs
INSERT INTO utilisateur (pseudo, password, score) VALUES
('yannick', 'quiz123', 10),
('james', 'quiz123', 10),
('sandra', 'quiz123', 10);

-- Insertion des quiz Dragon Ball Z
INSERT INTO quiz (titre, description, image, id_user) VALUES
('Dragon Ball Z - Saga Saiyan', 'Quiz sur la saga Saiyan.', NULL, 1),
('Dragon Ball Z - Saga Freezer', 'Quiz sur la saga Freezer.', NULL, 2),
('Dragon Ball Z - Saga Cell', 'Quiz sur la saga Cell.', NULL, 3);

-- Insertion des questions et réponses pour Dragon Ball Z
-- Quiz 1: Saga Saiyan
INSERT INTO question (question, id_quiz) VALUES
('Quel est le frère de Goku ?', 1),
('Qui tue Nappa ?', 1),
('Quelle est la première transformation de Goku en Super Saiyan ?', 1),
('Qui entraîne Gohan pendant l''absence de Goku ?', 1),
('Quelle est la technique signature de Vegeta ?', 1),
('Quel personnage meurt en premier face à Nappa ?', 1);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Raditz', TRUE, 1), ('Vegeta', FALSE, 1), ('Bardock', FALSE, 1), ('Piccolo', FALSE, 1),
('Vegeta', TRUE, 2), ('Goku', FALSE, 2), ('Piccolo', FALSE, 2), ('Krillin', FALSE, 2),
('Contre Freezer', TRUE, 3), ('Contre Vegeta', FALSE, 3), ('Contre Cell', FALSE, 3), ('Contre Buu', FALSE, 3),
('Piccolo', TRUE, 4), ('Krillin', FALSE, 4), ('Vegeta', FALSE, 4), ('Yamcha', FALSE, 4),
('Final Flash', TRUE, 5), ('Kamehameha', FALSE, 5), ('Genkidama', FALSE, 5), ('Makankosappo', FALSE, 5),
('Yamcha', TRUE, 6), ('Krillin', FALSE, 6), ('Tenshinhan', FALSE, 6), ('Chaozu', FALSE, 6);

-- Quiz 2: Saga Freezer
INSERT INTO question (question, id_quiz) VALUES
('Quel est le nom du père de Freezer ?', 2),
('Qui tue Dodoria ?', 2),
('Quelle transformation de Freezer possède 100% de sa puissance ?', 2),
('Quel Saiyan arrive sur Namek pour aider Goku ?', 2),
('Quelle technique Goku utilise contre Freezer ?', 2),
('Qui est le chef des Namekiens ?', 2);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('King Cold', TRUE, 7), ('Bardock', FALSE, 7), ('Cooler', FALSE, 7), ('Nappa', FALSE, 7),
('Vegeta', TRUE, 8), ('Goku', FALSE, 8), ('Gohan', FALSE, 8), ('Piccolo', FALSE, 8),
('Forme Finale 100%', TRUE, 9), ('Forme de base', FALSE, 9), ('Forme dorée', FALSE, 9), ('Forme cyborg', FALSE, 9),
('Vegeta', TRUE, 10), ('Raditz', FALSE, 10), ('Broly', FALSE, 10), ('Trunks', FALSE, 10),
('Genkidama', TRUE, 11), ('Final Flash', FALSE, 11), ('Kamehameha', FALSE, 11), ('Makankosappo', FALSE, 11),
('Guru', TRUE, 12), ('Dende', FALSE, 12), ('Nail', FALSE, 12), ('Slug', FALSE, 12);

-- Quiz 3: Saga Cell
INSERT INTO question (question, id_quiz) VALUES
('Qui est l''ennemi principal de la saga Cell ?', 3),
('Qui entraîne Gohan pour son combat contre Cell ?', 3),
('Quel est le point faible de Cell ?', 3),
('Quelle est la transformation ultime de Gohan contre Cell ?', 3),
('Qui détruit la machine à voyager dans le temps de Trunks ?', 3),
('Quelle technique Gohan utilise pour achever Cell ?', 3);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Cell', TRUE, 13), ('Freezer', FALSE, 13), ('Buu', FALSE, 13), ('Vegeta', FALSE, 13),
('Goku', TRUE, 14), ('Piccolo', FALSE, 14), ('Krillin', FALSE, 14), ('Tenshinhan', FALSE, 14),
('Son arrogance', TRUE, 15), ('Son endurance', FALSE, 15), ('Sa vitesse', FALSE, 15), ('Son Ki', FALSE, 15),
('Super Saiyan 2', TRUE, 16), ('Super Saiyan', FALSE, 16), ('Super Saiyan 3', FALSE, 16), ('Ultra Instinct', FALSE, 16),
('Cell lui-même', TRUE, 17), ('Goku', FALSE, 17), ('Vegeta', FALSE, 17), ('C-18', FALSE, 17),
('Kamehameha Père-Fils', TRUE, 18), ('Genkidama', FALSE, 18), ('Final Flash', FALSE, 18), ('Makankosappo', FALSE, 18);

-- Insertion des quiz One Piece
INSERT INTO quiz (titre, description, image, id_user) VALUES
('One Piece - Saga East Blue', 'Quiz sur la saga East Blue.', NULL, 1),
('One Piece - Saga Alabasta', 'Quiz sur la saga Alabasta.', NULL, 2),
('One Piece - Saga Marineford', 'Quiz sur la saga Marineford.', NULL, 3);

-- Insertion des questions et réponses pour One Piece
-- Quiz 1: Saga East Blue
INSERT INTO question (question, id_quiz) VALUES
('Quel est le premier membre à rejoindre l''équipage de Luffy ?', 4),
('Quel est le rêve de Zoro ?', 4),
('Quel fruit du démon Luffy possède-t-il ?', 4),
('Qui est le principal antagoniste d''Arlong Park ?', 4),
('Quel est le nom du premier navire de Luffy ?', 4),
('Qui est le premier adversaire de Luffy dans la série ?', 4);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Zoro', TRUE, 1), ('Sanji', FALSE, 1), ('Nami', FALSE, 1), ('Usopp', FALSE, 1),
('Devenir le meilleur épéiste', TRUE, 2), ('Devenir le Seigneur des Pirates', FALSE, 2), ('Trouver All Blue', FALSE, 2), ('Devenir le plus riche', FALSE, 2),
('Gomu Gomu no Mi', TRUE, 3), ('Mera Mera no Mi', FALSE, 3), ('Yami Yami no Mi', FALSE, 3), ('Hie Hie no Mi', FALSE, 3),
('Arlong', TRUE, 4), ('Crocodile', FALSE, 4), ('Barbe Noire', FALSE, 4), ('Ener', FALSE, 4),
('Going Merry', TRUE, 5), ('Thousand Sunny', FALSE, 5), ('Red Force', FALSE, 5), ('Moby Dick', FALSE, 5),
('Alvida', TRUE, 6), ('Buggy', FALSE, 6), ('Kuro', FALSE, 6), ('Don Krieg', FALSE, 6);

-- Quiz 2: Saga Alabasta
INSERT INTO question (question, id_quiz) VALUES
('Qui est le chef de Baroque Works ?', 5),
('Quel est le vrai nom de Mr. 2 ?', 5),
('Quel pouvoir possède Crocodile ?', 5),
('Qui sauve Luffy dans le désert d''Alabasta ?', 5),
('Quel est le nom du royaume où se déroule l''arc Alabasta ?', 5),
('Quel est le rôle de Vivi dans ce royaume ?', 5);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Crocodile', TRUE, 7), ('Doflamingo', FALSE, 7), ('Ener', FALSE, 7), ('Barbe Noire', FALSE, 7),
('Bon Clay', TRUE, 8), ('Mr. 3', FALSE, 8), ('Mr. 1', FALSE, 8), ('Mr. 4', FALSE, 8),
('Suna Suna no Mi', TRUE, 9), ('Gomu Gomu no Mi', FALSE, 9), ('Mera Mera no Mi', FALSE, 9), ('Hie Hie no Mi', FALSE, 9),
('Pell', TRUE, 10), ('Ace', FALSE, 10), ('Robin', FALSE, 10), ('Smoker', FALSE, 10),
('Alabasta', TRUE, 11), ('Dressrosa', FALSE, 11), ('Skypiea', FALSE, 11), ('Wano', FALSE, 11),
('Princesse', TRUE, 12), ('Capitaine', FALSE, 12), ('Reine', FALSE, 12), ('Générale', FALSE, 12);

-- Quiz 3: Saga Marineford
INSERT INTO question (question, id_quiz) VALUES
('Quel est l''objectif principal de l''équipage de Barbe Blanche à Marineford ?', 6),
('Qui tue Ace ?', 6),
('Quel Amiral affronte Barbe Blanche en duel ?', 6),
('Quel est le pouvoir de Barbe Blanche ?', 6),
('Qui sauve Luffy à la fin de la bataille de Marineford ?', 6),
('Qui devient Amiral en Chef après Marineford ?', 6);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Sauver Ace', TRUE, 13), ('Vaincre la Marine', FALSE, 13), ('Trouver le One Piece', FALSE, 13), ('Déclarer la guerre au monde', FALSE, 13),
('Akainu', TRUE, 14), ('Aokiji', FALSE, 14), ('Kizaru', FALSE, 14), ('Garp', FALSE, 14),
('Akainu', TRUE, 15), ('Aokiji', FALSE, 15), ('Kizaru', FALSE, 15), ('Fujitora', FALSE, 15),
('Gura Gura no Mi', TRUE, 16), ('Magu Magu no Mi', FALSE, 16), ('Pika Pika no Mi', FALSE, 16), ('Yami Yami no Mi', FALSE, 16),
('Trafalgar Law', TRUE, 17), ('Shanks', FALSE, 17), ('Dragon', FALSE, 17), ('Garp', FALSE, 17),
('Akainu', TRUE, 18), ('Aokiji', FALSE, 18), ('Sengoku', FALSE, 18), ('Kizaru', FALSE, 18);

-- Insertion des quiz Naruto
INSERT INTO quiz (titre, description, image, id_user) VALUES
('Naruto - Genin', 'Quiz sur les débuts de Naruto en tant que Genin.', NULL, 1),
('Naruto - Chunin Exam', 'Quiz sur l''examen Chunin.', NULL, 2),
('Naruto - Grande Guerre Ninja', 'Quiz sur la Quatrième Grande Guerre Ninja.', NULL, 3);

-- Insertion des questions et réponses pour Naruto
-- Quiz 1: Genin
INSERT INTO question (question, id_quiz) VALUES
('Quel est le rêve de Naruto ?', 7),
('Qui est le premier sensei de Naruto ?', 7),
('Quel est le nom du démon scellé en Naruto ?', 7),
('Qui est le premier rival de Naruto ?', 7),
('Quel est le jutsu signature de Naruto ?', 7),
('Quel est le clan de Sasuke ?', 7);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Devenir Hokage', TRUE, 1), ('Devenir Anbu', FALSE, 1), ('Dépasser Sasuke', FALSE, 1), ('Quitter Konoha', FALSE, 1),
('Kakashi', TRUE, 2), ('Iruka', FALSE, 2), ('Jiraiya', FALSE, 2), ('Orochimaru', FALSE, 2),
('Kyubi', TRUE, 3), ('Shukaku', FALSE, 3), ('Hachibi', FALSE, 3), ('Sanbi', FALSE, 3),
('Sasuke', TRUE, 4), ('Neji', FALSE, 4), ('Gaara', FALSE, 4), ('Shikamaru', FALSE, 4),
('Rasengan', TRUE, 5), ('Chidori', FALSE, 5), ('Amaterasu', FALSE, 5), ('Kage Bunshin', FALSE, 5),
('Uchiha', TRUE, 6), ('Senju', FALSE, 6), ('Hyuga', FALSE, 6), ('Akimichi', FALSE, 6);

-- Quiz 2: Chunin Exam
INSERT INTO question (question, id_quiz) VALUES
('Quel est le nom du village de Gaara ?', 8),
('Qui affronte Naruto dans l''examen Chunin ?', 8),
('Quel est le nom du frère et de la sœur de Gaara ?', 8),
('Quelle technique interdit Kakashi à Naruto d''utiliser au début ?', 8),
('Qui est l''examinatrice de la première épreuve ?', 8),
('Qui attaque Konoha durant l''examen Chunin ?', 8);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Suna', TRUE, 7), ('Kiri', FALSE, 7), ('Iwa', FALSE, 7), ('Kumo', FALSE, 7),
('Neji', TRUE, 8), ('Sasuke', FALSE, 8), ('Lee', FALSE, 8), ('Shikamaru', FALSE, 8),
('Kankuro et Temari', TRUE, 9), ('Itachi et Shisui', FALSE, 9), ('Deidara et Sasori', FALSE, 9), ('Kisame et Zabuza', FALSE, 9),
('Multi-clonage', TRUE, 10), ('Rasengan', FALSE, 10), ('Chidori', FALSE, 10), ('Sharingan', FALSE, 10),
('Ibiki Morino', TRUE, 11), ('Anko Mitarashi', FALSE, 11), ('Asuma Sarutobi', FALSE, 11), ('Hiruzen Sarutobi', FALSE, 11),
('Orochimaru', TRUE, 12), ('Akatsuki', FALSE, 12), ('Pain', FALSE, 12), ('Madara', FALSE, 12);

-- Quiz 3: Grande Guerre Ninja
INSERT INTO question (question, id_quiz) VALUES
('Qui est le chef de l''Akatsuki ?', 9),
('Qui ressuscite les anciens Kage ?', 9),
('Quel bijuu possède Killer Bee ?', 9),
('Quelle est la véritable identité de Tobi ?', 9),
('Qui affronte Madara Uchiha en combat final ?', 9),
('Quel est le dernier combat de Naruto dans la série ?', 9);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Pain', TRUE, 13), ('Itachi', FALSE, 13), ('Obito', FALSE, 13), ('Zetsu', FALSE, 13),
('Kabuto', TRUE, 14), ('Orochimaru', FALSE, 14), ('Madara', FALSE, 14), ('Danzo', FALSE, 14),
('Hachibi', TRUE, 15), ('Kyubi', FALSE, 15), ('Sanbi', FALSE, 15), ('Ichibi', FALSE, 15),
('Obito Uchiha', TRUE, 16), ('Madara Uchiha', FALSE, 16), ('Danzo Shimura', FALSE, 16), ('Shisui Uchiha', FALSE, 16),
('Naruto et Sasuke', TRUE, 17), ('Naruto et Kakashi', FALSE, 17), ('Gai et Madara', FALSE, 17), ('Hashirama et Madara', FALSE, 17),
('Naruto vs Sasuke', TRUE, 18), ('Naruto vs Madara', FALSE, 18), ('Naruto vs Pain', FALSE, 18), ('Naruto vs Itachi', FALSE, 18);
