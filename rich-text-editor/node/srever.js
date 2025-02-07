const express = require("express")
const multer = require("multer")
const mysql = require("mysql")
const app = express()
const port = 3000

const upload = multer()
const connection = mysql.createConnection({
  host: "localhost",
  user: "yourusername",
  password: "yourpassword",
  database: "yourdatabase",
})

connection.connect()

app.post("/upload", upload.single("file"), (req, res) => {
  const file = req.file

  if (!file) {
    return res.status(400).send("No file uploaded.")
  }

  const sql = "INSERT INTO images (image) VALUES (?)"
  connection.query(sql, [file.buffer], (err, result) => {
    if (err) {
      console.error("Error inserting BLOB:", err)
      return res.status(500).send("Error inserting BLOB.")
    }

    res.send({message: "Image uploaded successfully!", id: result.insertId})
  })
})

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}/`)
})
