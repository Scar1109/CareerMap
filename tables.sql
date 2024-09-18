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
    avatar VARCHAR(255) DEFAULT NULL, -- Store the avatar file name
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
