DROP TABLE `user`;

CREATE TABLE `user` (
    id_user INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50),
    PRIMARY KEY (id_user)
);

Insert into `user` (nom, prenom, email, mdp)
VALUES ('Bob', 'Dupont', 'bob@dupont', 'test');

Insert into `user` (nom, prenom, email, mdp)
VALUES ('Alice', 'Dupont', 'alice@dupont', 'test');

Insert into `user` (nom, prenom, email, mdp)
VALUES ('John', 'Dupont', 'john@dupont', 'test');