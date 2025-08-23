CREATE DATABASE IF NOT EXISTS smart_energy_store;
USE smart_energy_store;

-- Table: users
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin', 'vendor') DEFAULT 'customer',
    status BOOLEAN DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: addresses
CREATE TABLE addresses (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    address TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    postal_code VARCHAR(20),
    country VARCHAR(100),
    is_default BOOLEAN DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: categories
CREATE TABLE categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: products
CREATE TABLE products (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    short_description TEXT,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    category_id BIGINT,
    image_url TEXT,
    is_active BOOLEAN DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Table: orders
CREATE TABLE orders (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_type ENUM('cod', 'card', 'wallet') DEFAULT 'cod',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: order_items
CREATE TABLE order_items (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT,
    product_id BIGINT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Table: payments
CREATE TABLE payments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT,
    payment_method ENUM('cod', 'card', 'wallet'),
    payment_status ENUM('pending', 'paid', 'failed'),
    transaction_id VARCHAR(255),
    amount DECIMAL(10,2),
    paid_at DATETIME,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Table: deliveries
CREATE TABLE deliveries (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT,
    company_name VARCHAR(255),
    tracking_no VARCHAR(255),
    status ENUM('in_transit', 'delivered', 'failed') DEFAULT 'in_transit',
    estimated_delivery DATE,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Table: product_reviews
CREATE TABLE product_reviews (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    product_id BIGINT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Table: cart_items
CREATE TABLE cart_items (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    product_id BIGINT,
    quantity INT NOT NULL,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Table: wishlists
CREATE TABLE wishlists (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    product_id BIGINT,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Table: notifications
CREATE TABLE notifications (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: chats
CREATE TABLE chats (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    sender_id BIGINT,
    receiver_id BIGINT,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);
