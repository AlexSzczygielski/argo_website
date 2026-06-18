CREATE TABLE IF NOT EXISTS posts(
    id int PRIMARY KEY AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    date date NOT NULL,
    author varchar(255),
    excerpt varchar(255),
    cover_image varchar(255),
    results_url varchar(255),
    content LONGTEXT,
    photo_credits TINYINT(1) DEFAULT 0,
    status ENUM('draft', 'pending', 'published') DEFAULT 'draft'
);

CREATE TABLE IF NOT EXISTS post_gallery(
    id int PRIMARY KEY AUTO_INCREMENT,
    post_id int NOT NULL,
    filename varchar(255) NOT NULL,
    directory varchar(255) NOT NULL,
    sort_order int NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS users(
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    email varchar(255) NOT NULL UNIQUE,
    surname varchar(255),
    password varchar(255) NOT NULL,
    admin TINYINT(1) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS activity_log(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int NULL,
    action varchar(40) NOT NULL,
    target_type varchar(20) NULL,
    target_id int NULL,
    details JSON NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created (created_at),
    INDEX idx_user (user_id),
    CONSTRAINT fk_activity_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE SET NULL
);