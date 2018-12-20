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
  email VARCHAR NOT NULL,
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
INSERT INTO Channel (name) VALUES ("Worldnews");
INSERT INTO Channel (name) VALUES ("Jokes");


-- All passwords are 1234 in SHA-1 format

INSERT INTO Utilizer (username, password, email, created, points) VALUES ("dominic", "$2y$12$/OR080vuX/1Y4dyPYkPzAOaCmWjqytjr50/trYLXNsrYE9bnTf8da", "dom@gmail.com", 1507901651, 2);
INSERT INTO Utilizer (username, password, email, created, points) VALUES ("zachary", "$2y$12$J4IKd4yNQMlD2scB5xqmYe.5nk1X.SsOZJISEZeEFF3Oyw7p4EUSa", "zack207@hotmail.com", 1508074451, 5);
INSERT INTO Utilizer (username, password, email, created, points) VALUES ("alicia", "$2y$12$EclMUIx/gdXGHk6R7fADZOEXh0WtnWa3Zrkl1ksqhumgLcX6K7HZ.", "foxlover1@hotmail.com", 1508160851, -2);
INSERT INTO Utilizer (username, password, email, created, points) VALUES ("abril", "$2y$12$bNJ35gRTwezT/3lx1thGpurbSIP3n.s9hWaIor7xmrAdApft0eZFm", "april_with_b@yahoo.com", 1508247278, 0);

INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("A Autoeuropa, lembram-se?", 1507901651, "Portugal", "dominic", 0, "Há cerca de um ano estava o sub inundado de posts com notícias sobre a Autoeuropa e algumas divergências entre administração e trabalhadoras, relativamente a folgas, horários e remuneração de dias como sábado e domingo. \");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("Vida profissional de um advogado em Portugal", 1508074451, "Portugal", "abril", 1, "Estou a fazer agora um estágio num escritório enquanto acabo o quarto ano de Direito. Gostava de conhecer o testemunho de alguns advogados enquanto vou conhecendo aos poucos a prática. Como é o ambiente no vosso escritório? Quais as qualidades mais prezadas num advogado/estagiário? Que salário devo esperar quando começar exercer a sério/ estagiar na ordem? Quais os principais problemas que costumam ocorrer e quais os pontos fortes da profissão?");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("Belgium says loot boxes are gambling, wants them banned in Europe", 1529512183, "Worldnews", "alicia", -1, "Last week, Belgium's Gaming Commission announced that it had launched an investigation into whether the loot boxes available for purchase in games like Overwatch and Star Wars Battlefront 2 constitute a form of gambling. Today, VTM News reported that the ruling is in, and the answer is yes. ");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("Russia 'fires on and seizes Ukraine ships'", 1543681783, "Worldnews", "zachary", 4, "Russia has fired on and seized three Ukrainian naval vessels off the Crimean Peninsula in a major escalation of tensions between the two countries.");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("Uber loses landmark case over worker rights, entitling UK drivers to minimum wage and sick leave", 1545323383, "Worldnews", "zachary", 1, "The United Kingdom's courts have ruled against Uber in a groundbreaking fight over industrial protections given to the thousands of drivers who use its app, in a decision that could have ramifications worldwide.");
INSERT INTO Story (title, published, channel, author, points, fulltext) VALUES ("I don’t often tell Dad jokes.", 1545150583, "Jokes", "abril", 1, "But when I do, he laughs.");


INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (6, NULL, "dominic", 1507901651, 2, "Goddamn it. Take your upvote 😉");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (5, NULL, "dominic", 1507901651, 0, "This just in! Uber closes its doors in the UK but a new startup just hit the streets to fill it's place, say hello to Ubar.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (1, 1, "alicia", 1508160851, -1, "Eu não me lembrava.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (3, NULL, "dominic", 1508160851, 0, "Would be hilarious if EA ended up not only hated by the players but also by every other company in their gambling business. And I can totally see the EU screwing them just like that.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (3, NULL, "alicia", 1508160851, 0, "EA not only shot themselves in the foot, they blew off the whole leg for every other developer who is taking advantage of people with loot Crates. This is awesome!");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (3, NULL, "dominic", 1508160851, 0, "I imagine this will be popular in the gaming community, not in the EA boardroom though.");
INSERT INTO Comment (story_id, parent_comment, username, date, points, text) VALUES (6, NULL, "zachary", 1545150883, 1, "This is a dad joke about dad jokes! We're reaching new heights here guys");

INSERT INTO UserSubscriptions VALUES ("abril", "Portugal");
INSERT INTO UserSubscriptions VALUES ("abril", "Worldnews");
INSERT INTO UserSubscriptions VALUES ("alicia", "Worldnews");
INSERT INTO UserSubscriptions VALUES ("dominic", "Worldnews");
INSERT INTO UserSubscriptions VALUES ("zachary", "Worldnews");
INSERT INTO UserSubscriptions VALUES ("abril", "Jokes");
INSERT INTO UserSubscriptions VALUES ("zachary", "Jokes");


INSERT INTO StoryVote VALUES ("dominic", 1, 1);
INSERT INTO StoryVote VALUES ("alicia", 1, 0);
INSERT INTO StoryVote VALUES ("dominic", 2, 1);
INSERT INTO StoryVote VALUES ("abril", 3, 0);
INSERT INTO StoryVote VALUES ("abril", 4, 1);
INSERT INTO StoryVote VALUES ("alicia", 4, 1);
INSERT INTO StoryVote VALUES ("dominic", 4, 1);
INSERT INTO StoryVote VALUES ("zachary", 4, 1);
INSERT INTO StoryVote VALUES ("dominic", 5, 1);


INSERT INTO CommentVote VALUES ("zachary", 1, 1);
INSERT INTO CommentVote VALUES ("alicia", 1, 1);
INSERT INTO CommentVote VALUES ("zachary", 2, 0);
INSERT INTO CommentVote VALUES ("abril", 2, 1); 
INSERT INTO CommentVote VALUES ("zachary", 3, 0);
INSERT INTO CommentVote VALUES ("abril", 7, 1); 

COMMIT;