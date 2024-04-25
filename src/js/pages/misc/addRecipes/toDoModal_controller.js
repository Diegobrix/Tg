const TODO_MODAL = document.getElementById("way_to_do-modal");
const TODO_HANDLER = document.getElementById("todo-handler");
const TODO_SUBMIT = document.getElementById("btn-set_step");
const TODO_DESCRIPTION = document.getElementById("todo_content");
const TODO_TEMPLATE = document.getElementById("todo-template");

TODO_HANDLER.addEventListener("click", () => {
   TODO_MODAL.showModal();
});

TODO_SUBMIT.addEventListener("click", () => {
   let description = TODO_DESCRIPTION.value;
   let pattern = /\S+/g;

   if((description.match(pattern)) && (description.length > 0))
   {
      addTodo();
   }
});

function addTodo()
{

}