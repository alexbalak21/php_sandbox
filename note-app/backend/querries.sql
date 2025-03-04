CREATE USER 'backend'@'localhost' IDENTIFIED BY 'Azerty1239*';
GRANT ALL PRIVILEGES ON notes.* TO 'backend'@'localhost';
FLUSH PRIVILEGES;

DROP TABLE notes; 
CREATE TABLE IF NOT EXISTS notes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  content BLOB,
  raw_text TEXT,
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  user_id INT
);

DROP TABLE images;
CREATE TABLE IF NOT EXISTS images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image_type VARCHAR(10),
  image_data BLOB,
  note_id INT
);