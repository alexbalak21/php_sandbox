<?php
// Create or open the SQLite database
$db = new SQLite3('notes.db');


$db->exec("DROP TABLE IF EXISTS notes");
// Create the notes table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS notes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT,
  content BLOB,
  raw_text TEXT,
  crated_on DATE TIME,
  updated_on DATE TIME,
  user_id INT
)");

$db->exec("DROP TABLE IF EXISTS images");
// Create the images table if it doesn't exist, with a foreign key referencing the notes table
$db->exec("CREATE TABLE IF NOT EXISTS images (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  image_type TEXT,
  image_data BLOB,
  note_id INTEGER,
  FOREIGN KEY (note_id) REFERENCES notes(id)
)");