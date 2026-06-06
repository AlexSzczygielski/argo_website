CREATE TABLE IF NOT EXISTS posts(
    id int PRIMARY KEY AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    date date NOT NULL,
    author varchar(255),
    excerpt varchar(255),
    cover_image varchar(255),
    results_url varchar(255),
    content LONGTEXT
    
);

CREATE TABLE IF NOT EXISTS post_gallery(
    id int PRIMARY KEY AUTO_INCREMENT,
    post_id int NOT NULL,
    filename varchar(255) NOT NULL,
    directory varchar(255) NOT NULL,
    sort_order int NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
)