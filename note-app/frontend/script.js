//EDITOR TOOLBAR CONFIG
const quill = new Quill("#editor", {
  modules: {
    toolbar: [
      [{header: [1, 2, 3, false]}],
      ["bold", "italic", "underline"],
      ["image"],
      [{list: "ordered"}, {list: "bullet"}], // Add list options
      [{align: ["", "center", "right"]}], // Add alignment options
    ],
  },
  placeholder: "Note...",
  theme: "snow", // or 'bubble'
})

const form = document.getElementById("editor-form")
form.onsubmit = () => {
  document.getElementById("editor-content").value = document.querySelector(".ql-editor").innerHTML
}

//APPENDING ITEMS TO THE LIST

const list_item = document.querySelector(".list-group-item")
const list = document.querySelector("#list")

function append_item(number) {
  for (let i = 0; i < number; i++) {
    const new_item = list_item.cloneNode(true)
    new_item.classList.remove("active")
    list.appendChild(new_item)
  }
}

append_item(2)

const aside = document.querySelector("aside")
const main = document.querySelector("main")
aside.style.width = "50%"
main.style.width = "50%"
