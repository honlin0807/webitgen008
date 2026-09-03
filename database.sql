CREATE DATABASE IF NOT EXISTS myneivceweb;
USE myneivceweb;

CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE site_content (
    content_key VARCHAR(100) NOT NULL PRIMARY KEY,
    content_value TEXT NOT NULL
);

INSERT INTO site_content (content_key, content_value) VALUES
('company_name', 'NEIVCE Trading PLT'),
('announcement', 'Welcome to NEIVCE Trading PLT.'),
('introduction', 'NEIVCE Trading PLT provides e-commerce, computer programming services and computer training.'),
('about', 'NEIVCE Trading PLT is based in Kajang, Selangor. We provide practical digital services and training for customers.'),
('mission', 'To provide useful and affordable digital services.'),
('vision', 'To be a trusted local digital service provider.'),
('values', 'Good service, honesty and continuous learning.'),
('service_ecommerce', 'We help businesses with online selling and e-commerce activities.'),
('service_programming', 'We create simple websites and computer programs for business needs.'),
('service_training', 'We provide basic computer training for students and adults.'),
('address', 'B5 - B7, Block B, Jalan TKS 1, Taman Kajang Sentral, 43000 Kajang, Selangor'),
('telephone', '03-8737 8770'),
('contact_about', 'NEIVCE Trading PLT provides e-commerce, computer programming services and computer training.');
