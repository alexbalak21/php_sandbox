//EDITOR TOOLBAR CONFIG
const quill = new Quill("#editor", {
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, false] }],
      ["bold", "italic", "underline"],
      ["image"],
      [{ list: "ordered" }, { list: "bullet" }], // Add list options
      [{ align: ["", "center", "right"] }], // Add alignment options
    ],
  },
  placeholder: "Note...",
  theme: "snow", // or 'bubble'
});

const form = document.getElementById("editor-form");
form.onsubmit = () => {
  document.getElementById("editor-content").value = document.querySelector(".ql-editor").innerHTML;
};
