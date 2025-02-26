const express = require("express");
const bodyParser = require("body-parser");
const sqlite3 = require("sqlite3").verbose();
const { JSDOM } = require("jsdom");

// Create or open the SQLite database
const db = new sqlite3.Database("notes.db");

// Create tables if they don't exist
db.serialize(() => {
  db.run(
    "CREATE TABLE IF NOT EXISTS notes (id INTEGER PRIMARY KEY AUTOINCREMENT, content TEXT)"
  );
  db.run(
    "CREATE TABLE IF NOT EXISTS images (id INTEGER PRIMARY KEY AUTOINCREMENT, image_type TEXT, image_data BLOB)"
  );
});

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));

function saveImgToDb(imageType, base64Data, callback) {
  db.run(
    "INSERT INTO images (image_type, image_data) VALUES (?, ?)",
    [imageType, base64Data],
    function (err) {
      if (err) {
        return callback(err);
      }
      callback(null, this.lastID);
    }
  );
}

function parseContentSaveImg(content, callback) {
  if (!content) return callback(null, "");

  const dom = new JSDOM(content);
  const document = dom.window.document;

  const imgElements = document.querySelectorAll("img");
  let pending = imgElements.length;

  if (pending === 0) {
    return callback(null, dom.serialize());
  }

  imgElements.forEach((img) => {
    const src = img.getAttribute("src");
    const match = src.match(/^data:(image\/\w+);base64,(.+)$/);
    if (match) {
      const imageType = match[1];
      const base64Data = match[2];
      saveImgToDb(imageType, base64Data, (err, imageId) => {
        if (err) return callback(err);
        img.setAttribute("src", `id=${imageId}`);
        if (--pending === 0) {
          callback(null, dom.serialize());
        }
      });
    } else {
      if (--pending === 0) {
        callback(null, dom.serialize());
      }
    }
  });
}

function saveContent(content, callback) {
  if (!content) return callback(null, 0);
  db.run("INSERT INTO notes (content) VALUES (?)", [content], function (err) {
    if (err) {
      return callback(err);
    }
    callback(null, this.lastID);
  });
}

app.post("/save", (req, res) => {
  const editorContent = req.body["editor-content"] || "";
  parseContentSaveImg(editorContent, (err, parsedContent) => {
    if (err) {
      return res.status(500).send(err.message);
    }
    saveContent(parsedContent, (err, id) => {
      if (err) {
        return res.status(500).send(err.message);
      }
      res.send(parsedContent);
    });
  });
});

app.listen(3000, () => {
  console.log("Server is running on http://localhost:3000");
});
