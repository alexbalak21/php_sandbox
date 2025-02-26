<?php
// Create or open the SQLite database
$db = new SQLite3('notes.db');

$db->exec("CREATE TABLE IF NOT EXISTS  notes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT,
  content BLOB
)");

// Create a table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS images (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  image_type TEXT,
  image_data BLOB
)");

