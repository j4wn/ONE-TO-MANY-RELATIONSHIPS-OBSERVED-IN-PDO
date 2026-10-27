CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE gowns (
    gown_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    gown_name VARCHAR(100) NOT NULL,
    color VARCHAR(50),
    rental_price DECIMAL(10, 2),
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);