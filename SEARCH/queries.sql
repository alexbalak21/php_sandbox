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


INSERT INTO articles (page_url, title, content, keywords)
VALUES
  (
    '/programming/python',
    'The Rise of Python',
    'Python has become one of the most popular programming languages in the world due to its simplicity and versatility. This article explores the history of Python, its key features, and how it is used in various industries.',
    JSON_ARRAY('Python', 'Programming', 'Development', 'Software')
  ),
  (
    '/programming/javascript',
    'JavaScript: The Language of the Web',
    'JavaScript is the backbone of modern web development. This article delves into the evolution of JavaScript, its essential role in front-end development, and its growing use in server-side applications.',
    JSON_ARRAY('JavaScript', 'Web Development', 'Programming', 'Front-End')
  ),
  (
    '/programming/java',
    'Java: The Workhorse of the Enterprise',
    'Java has been a mainstay in enterprise environments for decades. This article covers the origins of Java, its robust ecosystem, and why it remains a critical tool for large-scale applications.',
    JSON_ARRAY('Java', 'Enterprise', 'Programming', 'Software Development')
  ),
  (
    '/programming/ruby',
    'Ruby and the Rails Revolution',
    'Ruby, especially in combination with the Rails framework, has revolutionized web development. This article examines the Ruby language, the Rails framework, and how they have influenced modern software engineering.',
    JSON_ARRAY('Ruby', 'Rails', 'Web Development', 'Programming')
  ),
  (
    '/programming/go',
    'Go: Simplicity and Performance',
    'Go, also known as Golang, was created by Google to address the limitations of existing languages in large-scale system development. This article explores Go\'s design philosophy, key features, and its applications in cloud computing and beyond.',
    JSON_ARRAY('Go', 'Golang', 'Programming', 'System Development')
  ),
  (
    '/programming/swift',
    'Swift: The Future of iOS Development',
    'Swift is Apple\'s modern programming language for iOS and macOS development. This article discusses Swift\'s advantages over Objective-C, its powerful features, and how it is shaping the future of mobile and desktop app development.',
    JSON_ARRAY('Swift', 'iOS', 'macOS', 'Programming', 'Development')
  ),
  (
    '/programming/rust',
    'Rust: Safety and Performance',
    'Rust is known for its focus on safety and performance, making it a popular choice for systems programming. This article covers Rust\'s unique features, such as its ownership system, and its growing adoption in various tech communities.',
    JSON_ARRAY('Rust', 'Systems Programming', 'Safety', 'Performance')
  ),
  (
    '/programming/kotlin',
    'Kotlin: The Modern Java Alternative',
    'Kotlin has gained popularity as a modern alternative to Java for Android development. This article explores Kotlin\'s concise syntax, interoperability with Java, and why many developers are making the switch.',
    JSON_ARRAY('Kotlin', 'Android', 'Programming', 'Development')
  ),
  (
    '/programming/php',
    'PHP: The Web\'s Ubiquitous Language',
    'PHP has been a foundational language for web development for many years. This article examines PHP\'s evolution, its current state, and why it continues to be widely used for server-side web programming.',
    JSON_ARRAY('PHP', 'Web Development', 'Server-Side', 'Programming')
  ),
  (
    '/programming/csharp',
    'C#: Microsoft\'s Flagship Language',
    'C# is a versatile language developed by Microsoft for a wide range of applications. This article discusses C#\'s features, its integration with the .NET framework, and its use in building enterprise applications and games.',
    JSON_ARRAY('C#', 'Microsoft', 'Programming', 'Development', '.NET')
  );



INSERT INTO articles (page_url, title, content, keywords) VALUES  ('php.com', 'Learning PHP', 'Introduction to PHP programming.', JSON_ARRAY('PHP', 'programming', 'backend'))


SELECT * FROM articles WHERE content like '%simplicity%'

SELECT * FROM articles WHERE content like '%simplicity%'


SELECT * FROM articles WHERE title LIKE '%Alternative%' OR 'content' LIKE '%Alternative%'


SELECT * FROM articles WHERE title LIKE '%development%' OR 'content' LIKE '%development%'
SELECT * FROM articles WHERE 'content' LIKE '%continues%'

SELECT * FROM articles WHERE content LIKE '%developers%';

SELECT * FROM articles WHERE content LIKE '%development%';
SELECT * FROM articles WHERE content LIKE '%also%';
SELECT * FROM articles WHERE content LIKE '%examines%';
SELECT * FROM articles WHERE content LIKE '%simplicity%';
SELECT * FROM articles WHERE content LIKE '%advantages%';


SELECT * FROM articles WHERE content LIKE '%macOS%';


SELECT * FROM articles WHERE title LIKE '%macOS%' OR 'content' LIKE '%macOS%'


SELECT * FROM articles WHERE title LIKE '%Alternative%' OR 'content' LIKE '%Alternative%'



-- CORRECT
SELECT * FROM articles WHERE title LIKE '%macOS%' OR content LIKE '%macOS%';
-- CORRECT
SELECT * FROM articles WHERE title LIKE '%macOS%' OR content LIKE '%macOS%' OR JSON_CONTAINS(keywords, 'macOS');
-- CORRECT
SELECT * FROM articles WHERE title LIKE '%world%' OR content LIKE '%world%' OR JSON_CONTAINS(keywords, 'world');
-- CORRECT WORK AS EXPECTED
SELECT * FROM articles WHERE title LIKE '%explores%' OR content LIKE '%explores%' OR JSON_CONTAINS(keywords, 'explores');

SELECT * FROM articles WHERE title LIKE '%alternative to Java%' OR content LIKE '%alternative to Java%' OR JSON_CONTAINS(keywords, 'alternative to Java');



SELECT * FROM articles WHERE title LIKE '%macOS%' OR content LIKE '%macOS%' OR JSON_CONTAINS(keywords, macOS)