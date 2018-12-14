BEGIN TRANSACTION;

.headers on
.mode columns

drop table if exists Channel;
drop table if exists Story;
drop table if exists Utilizer;
drop table if exists UserSubscriptions;
drop table if exists Comment;
drop table if exists StoryVote;
drop table if exists CommentVote;

CREATE TABLE Channel (
  name VARCHAR PRIMARY KEY
);

CREATE TABLE Story (
  id INTEGER PRIMARY KEY,
  title VARCHAR,
  published INTEGER, -- date when the story was published in epoch format
  channel VARCHAR REFERENCES channel, -- comma separated tags
  author VARCHAR REFERENCES utilizer, -- who wrote the article
  points INTEGER DEFAULT 0,
  fulltext VARCHAR
);

CREATE TABLE Utilizer (
  username VARCHAR PRIMARY KEY,
  password VARCHAR NOT NULL,
  points INTEGER DEFAULT 0,
  created INTEGER -- date when the utilizer was created in epoch format
);

CREATE TABLE Comment (
  id INTEGER PRIMARY KEY,
  story_id INTEGER REFERENCES story,
  parent_comment INTEGER REFERENCES comment,
  username VARCHAR REFERENCES utilizer,
  date INTEGER NOT NULL, -- date when comment was published in epoch format
  points INTEGER DEFAULT 0,
  text VARCHAR NOT NULL
);

CREATE TABLE UserSubscriptions (
  username VARCHAR REFERENCES utilizer,
  channel VARCHAR REFERENCES channel,
  PRIMARY KEY (username, channel)
);

CREATE TABLE StoryVote (
  username VARCHAR REFERENCES utilizer,
  story_id INTEGER REFERENCES story,
  type INTEGER CHECK (type = 0 OR type = 1),
  PRIMARY KEY (username, story_id)
);

CREATE TABLE CommentVote (
  username VARCHAR REFERENCES utilizer,
  comment_id INTEGER REFERENCES comment,
  type INTEGER CHECK (type = 0 OR type = 1),
  PRIMARY KEY (username, comment_id)
);

CREATE TRIGGER insertVote 
AFTER INSERT ON StoryVote
BEGIN
    UPDATE Story
    SET points = (
                  SELECT
                  (SELECT COUNT(*) FROM StoryVote WHERE type == 1 AND story_id = NEW.story_id) 
                - (SELECT COUNT(*) FROM StoryVote WHERE type == 0 AND story_id = NEW.story_id) AS Result
                )
    WHERE id = NEW.story_id;
END;

CREATE TRIGGER changeVote 
AFTER DELETE ON StoryVote
BEGIN
    UPDATE Story
    SET points = (
                  SELECT
                  (SELECT COUNT(*) FROM StoryVote WHERE type == 1 AND story_id = OLD.story_id) 
                - (SELECT COUNT(*) FROM StoryVote WHERE type == 0 AND story_id = OLD.story_id) AS Result
                )
    WHERE id = OLD.story_id;
END;

CREATE TRIGGER insertComment
AFTER INSERT ON CommentVote
BEGIN
    UPDATE Comment
    SET points = (
              SELECT
              (SELECT COUNT(*) FROM CommentVote WHERE type == 1 AND comment_id = NEW.comment_id) 
            - (SELECT COUNT(*) FROM CommentVote WHERE type == 0 AND comment_id = NEW.comment_id) AS Result
            )
    WHERE id = NEW.comment_id;
END;

CREATE TRIGGER changeComment
AFTER DELETE ON CommentVote
BEGIN
    UPDATE Comment
    SET points = (
              SELECT
              (SELECT COUNT(*) FROM CommentVote WHERE type == 1 AND comment_id = OLD.comment_id) 
            - (SELECT COUNT(*) FROM CommentVote WHERE type == 0 AND comment_id = OLD.comment_id) AS Result
            )
    WHERE id = OLD.comment_id;
END;

CREATE TRIGGER userPointsStoryUpdate
AFTER UPDATE ON Story
BEGIN
    UPDATE Utilizer
    SET points = (
            SELECT
            (SELECT COALESCE (SUM(Story.points), 0) FROM Story
            WHERE author = OLD.author)
          +
            (SELECT COALESCE (SUM(Comment.points), 0) FROM Comment 
            WHERE username = OLD.author) 
              
            AS Result
          )
    WHERE username = OLD.author;
END;

CREATE TRIGGER userPointsCommentUpdate
AFTER UPDATE ON Comment
BEGIN
    UPDATE Utilizer
        SET points = (
            SELECT
            (SELECT COALESCE (SUM(Story.points), 0) FROM Story
            WHERE author = OLD.username)
          +
            (SELECT COALESCE (SUM(Comment.points), 0) FROM Comment 
            WHERE username = OLD.username) 
              
            AS Result
          )
    WHERE username = OLD.username;
END;

PRAGMA foreign_keys = ON;

INSERT INTO Channel (name) VALUES ("Portugal");
INSERT INTO Channel (name) VALUES ("Lorem Ipsum");

-- All passwords are 1234 in SHA-1 format

INSERT INTO Utilizer (username, password, created, points) VALUES ("dominic", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", 1507901651, 0);
INSERT INTO Utilizer (username, password, created, points) VALUES ("zachary", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", 1508074451, 0);
INSERT INTO Utilizer (username, password, created, points) VALUES ("alicia", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", 1508160851, -1);
INSERT INTO Utilizer (username, password, created, points) VALUES ("abril", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", 1508247278, 0);

INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("A Autoeuropa, lembram-se?", 1507901651, "Portugal", "dominic", 0, "Há cerca de um ano estava o sub inundado de posts com notícias sobre a Autoeuropa e algumas divergências entre administração e trabalhadoras, relativamente a folgas, horários e remuneração de dias como sábado e domingo. Alguns dos títulos:");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("Vida profissional de um advogado em Portugal", 1508074451, "Portugal", "abril", 1, "Estou a fazer agora um estágio num escritório enquanto acabo o quarto ano de Direito. Gostava de conhecer o testemunho de alguns advogados enquanto vou conhecendo aos poucos a prática. Como é o ambiente no vosso escritório? Quais as qualidades mais prezadas num advogado/estagiário? Que salário devo esperar quando começar exercer a sério/ estagiar na ordem? Quais os principais problemas que costumam ocorrer e quais os pontos fortes da profissão?");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("What is Lorem Ipsum?", 1508160851, "Lorem Ipsum", "alicia", -1, "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("Where does it come from?", 1508247278, "Lorem Ipsum", "zachary", 0, "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, comes from a line in section 1.10.32.");

INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (1, NULL, "dominic", 1507901651, 1, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at consequat libero. Ut a orci orci. Proin sodales venenatis risus.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (2, NULL, "dominic", 1507901651, 0, "Lorem ipsum dolor sit amet, atis risus.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (2, NULL, "abril", 1507901651, -1, "testing comments");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (1, 1, "alicia", 1508160851, 0, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id convallis odio. Vivamus risus velit, accumsan in pellentesque sed, commodo.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (3, NULL, "dominic", 1508160851, 0, "Sed ullamcorper nec elit ut egestas. Ut et vehicula tellus. Donec faucibus, massa sit amet porta pharetra, dolor lorem consequat.");

INSERT INTO UserSubscriptions VALUES ("abril", "Portugal");
INSERT INTO UserSubscriptions VALUES ("abril", "Lorem Ipsum");
INSERT INTO UserSubscriptions VALUES ("alicia", "Lorem Ipsum");

INSERT INTO StoryVote VALUES ("dominic", 1, 1);
INSERT INTO StoryVote VALUES ("alicia", 1, 0);
INSERT INTO StoryVote VALUES ("dominic", 2, 1);
INSERT INTO StoryVote VALUES ("abril", 3, 0);

INSERT INTO CommentVote VALUES ("zachary", 1, 1);
INSERT INTO CommentVote VALUES ("zachary", 2, 0);
INSERT INTO CommentVote VALUES ("abril", 2, 1); 
INSERT INTO CommentVote VALUES ("zachary", 3, 0);

COMMIT;