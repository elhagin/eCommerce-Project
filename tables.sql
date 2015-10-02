CREATE TABLE IF NOT EXISTS `users` (
	user_id INT(64) NOT NULL AUTO_INCREMENT,
    email TEXT,
    _password TEXT,
    first_name TEXT,
    last_name TEXT,
    address TEXT,
    phone TEXT,
    avatar_url TEXT,
    PRIMARY KEY(user_id)
    );
CREATE TABLE IF NOT EXISTS `products` (
	product_id INT(64) NOT NULL AUTO_INCREMENT,
    product_name TEXT,
    description TEXT,
    price TEXT,
    stock INT,
    PRIMARY KEY(product_id)
    )