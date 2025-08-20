<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Drag from Div to Table</title>
    <style>
      #wordBank {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
      }
      .draggableItem {
        padding: 8px 12px;
        background-color: #d1e7dd;
        border: 1px solid #0f5132;
        cursor: grab;
        border-radius: 4px;
      }
      table {
        border-collapse: collapse;
        width: 50%;
      }
      td {
        border: 1px solid #ccc;
        height: 50px;
        width: 100px;
        text-align: center;
        vertical-align: middle;
      }
      td.dropTarget {
        background-color: #f8f9fa;
      }
      td.over {
        background-color: #cfe2ff;
      }
    </style>
  </head>
  <body>
    <h2>Drag words into the table cells</h2>

    <div id="wordBank">
      <div class="draggableItem" draggable="true">Sun</div>
      <div class="draggableItem" draggable="true">Moon</div>
      <div class="draggableItem" draggable="true">Stars</div>
    </div>

    <table>
      <tr>
        <td class="dropTarget"></td>
        <td class="dropTarget"></td>
        <td class="dropTarget"></td>
      </tr>
      <tr>
        <td class="dropTarget"></td>
        <td class="dropTarget"></td>
        <td class="dropTarget"></td>
      </tr>
    </table>

    <script>
      let draggedItem = null;

      document.querySelectorAll(".draggableItem").forEach((item) => {
        item.addEventListener("dragstart", (e) => {
          draggedItem = item;
          e.dataTransfer.setData("text/plain", item.textContent);
        });
      });

      document.querySelectorAll("td.dropTarget").forEach((cell) => {
        cell.addEventListener("dragover", (e) => {
          e.preventDefault();
          cell.classList.add("over");
        });

        cell.addEventListener("dragleave", () => {
          cell.classList.remove("over");
        });

        cell.addEventListener("drop", (e) => {
          e.preventDefault();
          cell.classList.remove("over");
          if (draggedItem) {
            cell.textContent = draggedItem.textContent;
            draggedItem.remove(); // Optional: remove from word bank after drop
            draggedItem = null;
          }
        });
      });
    </script>
  </body>
</html>
