CREATE TABLE developers (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    bio TEXT NOT NULL,
    skills VARCHAR(255) NOT NULL,
    pay DECIMAL(10, 2) NOT NULL,
    github_link VARCHAR(255),
    linkedin_link VARCHAR(255),
    behance_link VARCHAR(255),
    stackoverflow_link VARCHAR(255),
    portfolio_link VARCHAR(255),
    avatar VARCHAR(255), -- File name for the uploaded avatar image
    user_id INT(11) NOT NULL, -- Foreign key from users table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


