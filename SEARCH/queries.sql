CREATE DATABASE search;

-- Use the database
USE search;

-- Create a sample table
CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  content TEXT,
  keywords JSON
);

-- Insert some sample data
INSERT INTO articles (title, content) VALUES
  ('PHP Basics', 'Introduction to PHP and basic concepts.'),
  ('SQL Queries', 'Learning how to write SQL queries.'),
  ('PHP and SQL', 'Integrating PHP with SQL for web applications.'),
  ('Introduction to HTML', 'HTML is the standard markup language for creating web pages.'),
  ('CSS Fundamentals', 'Learn the basics of CSS and how to style web pages.'),
  ('JavaScript Basics', 'An introduction to JavaScript programming and DOM manipulation.'),
  ('Advanced PHP', 'Exploring advanced features of PHP, such as object-oriented programming and design patterns.'),
  ('SQL Optimization', 'Tips and tricks to optimize SQL queries for better performance.'),
  ('Secure PHP Development', 'Best practices for developing secure PHP applications.'),
  ('Web Development Tools', 'Overview of popular web development tools and frameworks.'),
  ('Understanding Databases', 'An overview of different types of databases and their use cases.'),
  ('RESTful APIs with PHP', 'How to create RESTful APIs using PHP and frameworks like Laravel.'),
  ('Introduction to Bootstrap', 'Learn how to use Bootstrap for responsive web design.'),
  ('Version Control with Git', 'An introduction to Git and basic version control concepts.'),
  ('Debugging PHP Applications', 'Techniques and tools for debugging PHP applications effectively.'),
  ('Using AJAX with PHP', 'Integrating AJAX into your PHP applications for dynamic content updates.'),
  ('Database Design Basics', 'Fundamental concepts in database design and normalization.'),
  ('Deploying PHP Applications', 'Steps to deploy PHP applications to a web server.'),
  ('PHP Frameworks Overview', 'A look at popular PHP frameworks like Laravel and Symfony.'),
  ('Unit Testing in PHP', 'An introduction to unit testing and PHPUnit for PHP applications.'),
  ('Working with JSON in PHP', 'How to work with JSON data in PHP and use it for API communication.');




INSERT INTO `keywords` (title, keywrds) VALUES ("JavaScript", '["var", "let", "const", "function", "return", "if", "else", "switch", "case", "break", "continue", "for", "while", "do", "try", "catch", "throw", "class", "extends", "import", "export", "new", "this", "super", "yield", "await", "async",]');
INSERT INTO `keywords` (keywrds) VALUES ('["var", "let", "const", "function", "return", "if", "else", "switch", "case", "break", "continue", "for", "while", "do", "try", "catch", "throw", "class", "extends", "import", "export", "new", "this", "super", "yield", "await", "async",]');
INSERT INTO keywords (title, content, keywrds)
VALUES (
  'JavaScript Basics',
  'Introduction to JavaScript',
  JSON_ARRAY('var', 'let', 'const', 'function', 'return')
);

INSERT INTO keywords (title, content, keywrds)
VALUES (
  'Python Fundamentals',
  'Learning Python basics',
  '[ "def", "return", "if", "else", "for" ]'
);

SELECT * FROM keywords WHERE keywrds LIKE 'let';

UPDATE example_table
SET data = JSON_ARRAY_APPEND(data, '$', 'four')
WHERE id = 1;

UPDATE keywords SET keywrds = JSON_ARRAY_APPEND(keywrds, '$', 'case') WHERE id=1;

SELECT * FROM `keywords` WHERE title LIKE 'let' OR description LIKE 'let' OR JSON_CONTAINS(keywrds, 'let');


  CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  page_url VARCHAR(255),
  title VARCHAR(255),
  short VARCHAR(255),
  content TEXT,
  keywords JSON
);



INSERT INTO articles (page_url, title, content, keywords) VALUES  ('php.com', 'Learning PHP', 'Introduction to PHP programming.', JSON_ARRAY('PHP', 'programming', 'backend'))