CREATE DATABASE IF NOT EXISTS portal_gereja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portal_gereja;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('admin','jemaat') NOT NULL DEFAULT 'jemaat',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE families (
 id INT AUTO_INCREMENT PRIMARY KEY,
 family_name VARCHAR(160) NOT NULL,
 address TEXT NULL
);

CREATE TABLE members (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NULL,
 family_id INT NULL,
 member_no VARCHAR(50) UNIQUE,
 full_name VARCHAR(160) NOT NULL,
 gender VARCHAR(20) NULL,
 birth_date DATE NULL,
 phone VARCHAR(40) NULL,
 address TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL,
 FOREIGN KEY(family_id) REFERENCES families(id) ON DELETE SET NULL
);

CREATE TABLE announcements (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(200) NOT NULL,
 content TEXT NOT NULL,
 published_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE worship_services (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(200) NOT NULL,
 service_date DATE NOT NULL,
 content LONGTEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(200) NOT NULL,
 event_date DATE NOT NULL,
 event_time TIME NULL,
 location VARCHAR(200) NULL,
 description TEXT NULL
);

CREATE TABLE service_schedules (
 id INT AUTO_INCREMENT PRIMARY KEY,
 service_date DATE NOT NULL,
 service_type VARCHAR(120) NOT NULL,
 member_name VARCHAR(160) NOT NULL
);

CREATE TABLE prayer_requests (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 request_text TEXT NOT NULL,
 is_private TINYINT(1) DEFAULT 0,
 status ENUM('baru','didoakan','selesai') DEFAULT 'baru',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE financial_accounts (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 account_type VARCHAR(50) NOT NULL
);

CREATE TABLE financial_transactions (
 id INT AUTO_INCREMENT PRIMARY KEY,
 account_id INT NULL,
 transaction_date DATE NOT NULL,
 type ENUM('income','expense') NOT NULL,
 category VARCHAR(120) NOT NULL,
 amount DECIMAL(15,2) NOT NULL,
 description TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(account_id) REFERENCES financial_accounts(id) ON DELETE SET NULL
);

CREATE TABLE donations (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NULL,
 donation_date DATE NOT NULL,
 category VARCHAR(120) NOT NULL,
 amount DECIMAL(15,2) NOT NULL,
 payment_method VARCHAR(50) NULL,
 reference_code VARCHAR(120) NULL,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE audit_logs (
 id BIGINT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NULL,
 action VARCHAR(100) NOT NULL,
 target_table VARCHAR(100) NULL,
 target_id INT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Demo users
INSERT INTO users (name,email,password_hash,role) VALUES
('Administrator Gereja','admin@gereja.local','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC5J5rW9yY2nY6X4p7u','admin'),
('Jemaat Demo','jemaat@gereja.local','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC5J5rW9yY2nY6X4p7u','jemaat');

INSERT INTO families (family_name,address) VALUES ('Keluarga Demo','Alamat contoh');

INSERT INTO members (user_id,family_id,member_no,full_name,gender,birth_date,phone,address)
VALUES (2,1,'JMT-0001','Jemaat Demo','L','1995-01-01','081234567890','Alamat contoh');

INSERT INTO announcements (title,content) VALUES
('Selamat Datang di Portal Digital Gereja','Portal Digital Gereja menjadi pusat informasi, pelayanan, administrasi, dan komunikasi jemaat.'),
('Rapat Pelayanan','Rapat pelayanan akan dilaksanakan sesuai jadwal yang telah ditentukan. Mohon seluruh pelayan memperhatikan pengumuman.');

INSERT INTO worship_services (title,service_date,content) VALUES
('Ibadah Minggu','2026-09-20','1. Saat Teduh\n2. Votum\n3. Nyanyian Pembukaan\n4. Doa\n5. Pembacaan Alkitab\n6. Khotbah\n7. Persembahan\n8. Doa Syafaat\n9. Pengutusan\n10. Berkat');

INSERT INTO events (title,event_date,event_time,location,description) VALUES
('Ibadah Minggu','2026-09-20','09:00:00','Gedung Gereja','Ibadah Minggu bersama seluruh jemaat.'),
('Latihan Paduan Suara','2026-09-23','19:00:00','Ruang Musik','Latihan paduan suara.');

INSERT INTO service_schedules (service_date,service_type,member_name) VALUES
('2026-09-20','Liturgos','Budi Santoso'),
('2026-09-20','Pemimpin Pujian','Maria'),
('2026-09-20','Singer','Tim Pujian');
