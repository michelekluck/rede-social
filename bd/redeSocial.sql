use redeSocial;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(10) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) 
);

CREATE TABLE likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT,
    user_id INT, 
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);