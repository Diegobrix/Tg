const TODO_MODAL = document.getElementById("way_to_do-modal");
const TODO_HANDLER = document.getElementById("todo-handler");
const TODO_SUBMIT = document.getElementById("btn-set_step");
const TODO_DESCRIPTION = document.getElementById("todo_content");
const TODO_TEMPLATE = document.getElementById("todo-template");
const TODO_CONTAINER = document.querySelector(".ways_to_do-container");

TODO_HANDLER.addEventListener("click", () => {
   TODO_MODAL.showModal();
});

TODO_SUBMIT.addEventListener("click", () => {
   let description = TODO_DESCRIPTION.value;
   let pattern = /\S+/g;

   if((description.match(pattern)) && (description.length > 0))
   {
      addTodo(description);
      TODO_DESCRIPTION.value = "";
      TODO_MODAL.close();
   }
});

let currentWayToDo = 1;
function addTodo(content)
{
   const WAYTODO = TODO_TEMPLATE.content.cloneNode(true).children[0];   
   const CONTENT_INPUT = WAYTODO.querySelector(".waytodo_input");
   const CONTENT_DISPLAY = WAYTODO.querySelector(".waytodo_content");

   CONTENT_INPUT.value = currentWayToDo + "@" + content +"|";
   CONTENT_DISPLAY.innerHTML = content;
   CONTENT_DISPLAY.dataset.sequence = currentWayToDo;
   
   TODO_CONTAINER.append(WAYTODO);
   currentWayToDo += 1;
}