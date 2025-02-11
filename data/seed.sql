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
('Zoro', TRUE, 19), ('Sanji', FALSE, 19), ('Nami', FALSE, 19), ('Usopp', FALSE, 19),
('Devenir le meilleur épéiste', TRUE, 20), ('Devenir le Seigneur des Pirates', FALSE, 20), ('Trouver All Blue', FALSE, 20), ('Devenir le plus riche', FALSE, 20),
('Gomu Gomu no Mi', TRUE, 21), ('Mera Mera no Mi', FALSE, 21), ('Yami Yami no Mi', FALSE, 21), ('Hie Hie no Mi', FALSE, 21),
('Arlong', TRUE, 22), ('Crocodile', FALSE, 22), ('Barbe Noire', FALSE, 22), ('Ener', FALSE, 22),
('Going Merry', TRUE, 23), ('Thousand Sunny', FALSE, 23), ('Red Force', FALSE, 23), ('Moby Dick', FALSE, 23),
('Alvida', TRUE, 24), ('Buggy', FALSE, 24), ('Kuro', FALSE, 24), ('Don Krieg', FALSE, 24);

-- Quiz 2: Saga Alabasta
INSERT INTO question (question, id_quiz) VALUES
('Qui est le chef de Baroque Works ?', 5),
('Quel est le vrai nom de Mr. 2 ?', 5),
('Quel pouvoir possède Crocodile ?', 5),
('Qui sauve Luffy dans le désert d''Alabasta ?', 5),
('Quel est le nom du royaume où se déroule l''arc Alabasta ?', 5),
('Quel est le rôle de Vivi dans ce royaume ?', 5);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Crocodile', TRUE, 25), ('Doflamingo', FALSE, 25), ('Ener', FALSE, 25), ('Barbe Noire', FALSE, 25),
('Bon Clay', TRUE, 26), ('Mr. 3', FALSE, 26), ('Mr. 1', FALSE, 26), ('Mr. 4', FALSE, 26),
('Suna Suna no Mi', TRUE, 27), ('Gomu Gomu no Mi', FALSE, 27), ('Mera Mera no Mi', FALSE, 27), ('Hie Hie no Mi', FALSE, 27),
('Pell', TRUE, 28), ('Ace', FALSE, 28), ('Robin', FALSE, 28), ('Smoker', FALSE, 28),
('Alabasta', TRUE, 29), ('Dressrosa', FALSE, 29), ('Skypiea', FALSE, 29), ('Wano', FALSE, 29),
('Princesse', TRUE, 30), ('Capitaine', FALSE, 30), ('Reine', FALSE, 30), ('Générale', FALSE, 30);

-- Quiz 3: Saga Marineford
INSERT INTO question (question, id_quiz) VALUES
('Quel est l''objectif principal de l''équipage de Barbe Blanche à Marineford ?', 6),
('Qui tue Ace ?', 6),
('Quel Amiral affronte Barbe Blanche en duel ?', 6),
('Quel est le pouvoir de Barbe Blanche ?', 6),
('Qui sauve Luffy à la fin de la bataille de Marineford ?', 6),
('Qui devient Amiral en Chef après Marineford ?', 6);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Sauver Ace', TRUE, 31), ('Vaincre la Marine', FALSE, 31), ('Trouver le One Piece', FALSE, 31), ('Déclarer la guerre au monde', FALSE, 31),
('Akainu', TRUE, 32), ('Aokiji', FALSE, 32), ('Kizaru', FALSE, 32), ('Garp', FALSE, 32),
('Akainu', TRUE, 33), ('Aokiji', FALSE, 33), ('Kizaru', FALSE, 33), ('Fujitora', FALSE, 33),
('Gura Gura no Mi', TRUE, 34), ('Magu Magu no Mi', FALSE, 34), ('Pika Pika no Mi', FALSE, 34), ('Yami Yami no Mi', FALSE, 34),
('Trafalgar Law', TRUE, 35), ('Shanks', FALSE, 35), ('Dragon', FALSE, 35), ('Garp', FALSE, 35),
('Akainu', TRUE, 36), ('Aokiji', FALSE, 36), ('Sengoku', FALSE, 36), ('Kizaru', FALSE, 36);

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
('Devenir Hokage', TRUE, 37), ('Devenir Anbu', FALSE, 37), ('Dépasser Sasuke', FALSE, 37), ('Quitter Konoha', FALSE, 37),
('Kakashi', TRUE, 38), ('Iruka', FALSE, 38), ('Jiraiya', FALSE, 38), ('Orochimaru', FALSE, 38),
('Kyubi', TRUE, 39), ('Shukaku', FALSE, 39), ('Hachibi', FALSE, 39), ('Sanbi', FALSE, 39),
('Sasuke', TRUE, 40), ('Neji', FALSE, 40), ('Gaara', FALSE, 40), ('Shikamaru', FALSE, 40),
('Rasengan', TRUE, 41), ('Chidori', FALSE, 41), ('Amaterasu', FALSE, 41), ('Kage Bunshin', FALSE, 41),
('Uchiha', TRUE, 42), ('Senju', FALSE, 42), ('Hyuga', FALSE, 42), ('Akimichi', FALSE, 42);

-- Quiz 2: Chunin Exam
INSERT INTO question (question, id_quiz) VALUES
('Quel est le nom du village de Gaara ?', 8),
('Qui affronte Naruto dans l''examen Chunin ?', 8),
('Quel est le nom du frère et de la sœur de Gaara ?', 8),
('Quelle technique interdit Kakashi à Naruto d''utiliser au début ?', 8),
('Qui est l''examinatrice de la première épreuve ?', 8),
('Qui attaque Konoha durant l''examen Chunin ?', 8);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Suna', TRUE, 43), ('Kiri', FALSE, 43), ('Iwa', FALSE, 43), ('Kumo', FALSE, 43),
('Neji', TRUE, 44), ('Sasuke', FALSE, 44), ('Lee', FALSE, 44), ('Shikamaru', FALSE, 44),
('Kankuro et Temari', TRUE, 45), ('Itachi et Shisui', FALSE, 45), ('Deidara et Sasori', FALSE, 45), ('Kisame et Zabuza', FALSE, 45),
('Multi-clonage', TRUE, 46), ('Rasengan', FALSE, 46), ('Chidori', FALSE, 46), ('Sharingan', FALSE, 46),
('Ibiki Morino', TRUE, 47), ('Anko Mitarashi', FALSE, 47), ('Asuma Sarutobi', FALSE, 47), ('Hiruzen Sarutobi', FALSE, 47),
('Orochimaru', TRUE, 48), ('Akatsuki', FALSE, 48), ('Pain', FALSE, 48), ('Madara', FALSE, 48);

-- Quiz 3: Grande Guerre Ninja
INSERT INTO question (question, id_quiz) VALUES
('Qui est le chef de l''Akatsuki ?', 9),
('Qui ressuscite les anciens Kage ?', 9),
('Quel bijuu possède Killer Bee ?', 9),
('Quelle est la véritable identité de Tobi ?', 9),
('Qui affronte Madara Uchiha en combat final ?', 9),
('Quel est le dernier combat de Naruto dans la série ?', 9);

INSERT INTO reponse (reponse, resultat, id_question) VALUES
('Pain', TRUE, 49), ('Itachi', FALSE, 49), ('Obito', FALSE, 49), ('Zetsu', FALSE, 49),
('Kabuto', TRUE, 50), ('Orochimaru', FALSE, 50), ('Madara', FALSE, 50), ('Danzo', FALSE, 50),
('Hachibi', TRUE, 51), ('Kyubi', FALSE, 51), ('Sanbi', FALSE, 51), ('Ichibi', FALSE, 51),
('Obito Uchiha', TRUE, 52), ('Madara Uchiha', FALSE, 52), ('Danzo Shimura', FALSE, 52), ('Shisui Uchiha', FALSE, 52),
('Naruto et Sasuke', TRUE, 53), ('Naruto et Kakashi', FALSE, 53), ('Gai et Madara', FALSE, 53), ('Hashirama et Madara', FALSE, 53),
('Naruto vs Sasuke', TRUE, 54), ('Naruto vs Madara', FALSE, 54), ('Naruto vs Pain', FALSE, 54), ('Naruto vs Itachi', FALSE, 54);
