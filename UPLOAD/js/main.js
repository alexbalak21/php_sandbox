document.addEventListener("DOMContentLoaded", function () {
  let xhr
  const progressBar = document.getElementById("progressBar")
  const progressText = document.getElementById("progressText")
  const cancelButton = document.getElementById("cancelButton")
  const output = document.getElementById("output")

  document.getElementById("uploadForm").addEventListener("submit", function (e) {
    e.preventDefault()
    const formData = new FormData(this)
    const inputName = document.getElementById("name").value.trim()
    const fileInput = document.getElementById("fileToUpload")
    const file = fileInput.files[0]
    const fileNameParts = file.name.split(".")
    const fileExtension = fileNameParts.pop()
    const originalFileName = fileNameParts.join(".")
    const name = inputName !== "" ? inputName : originalFileName
    formData.set("name", name)
    formData.append("fileToUpload", file, name + "." + fileExtension)

    // Reset output
    output.innerText = ""
    output.setAttribute("class", "")

    xhr = new XMLHttpRequest()
    xhr.open("POST", "upload.php")

    xhr.upload.addEventListener(
      "progress",
      function (event) {
        if (event.lengthComputable) {
          const percentComplete = (event.loaded / event.total) * 100
          progressBar.style.width = percentComplete + "%"
          progressText.textContent = percentComplete.toFixed(2) + "%"
        }
      },
      false
    )

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          console.log(xhr.responseText)
          output.classList.add("text-success")
          output.innerText = xhr.responseText // Set the response text in the output element
          progressBar.classList.add("bg-success") // Add green background color
        } else {
          console.error("Error:", xhr.responseText)
          output.innerText = xhr.responseText // Display the error message in the output element
          output.classList.add("text-danger") // Add text-danger class to indicate error
          progressBar.classList.add("bg-danger") // Add red background color for error
        }
      }
    }

    xhr.send(formData)
  })

  cancelButton.addEventListener("click", function () {
    if (xhr && xhr.readyState !== XMLHttpRequest.DONE) {
      xhr.abort()
      progressBar.style.width = "0%"
      progressText.textContent = "0%"
      output.innerText = "Upload cancelled."
      output.classList.add("text-danger") // Add text-danger class to indicate cancellation
    }
  })

  // Reset output when a new file is selected
  document.getElementById("fileToUpload").addEventListener("change", function () {
    output.innerText = ""
    output.setAttribute("class", "")
    progressBar.style.width = "0%"
    progressText.textContent = "0%"
    progressBar.classList.remove("bg-danger")
    progressBar.classList.remove("bg-success")
  })

  // Reset output when upload button is clicked
  document.getElementById("uploadButton").addEventListener("click", function () {
    output.innerText = ""
    output.classList.remove("text-danger")
    progressBar.style.width = "0%"
    progressText.textContent = "0%"
    progressBar.classList.remove("bg-danger")
    progressBar.classList.remove("bg-success")
  })
})
