const WAYTODO_EDIT_HANDLER = document.getElementById("waytodo_edit-handler");
const WAYTODO_MODAL = document.getElementById("waytodo-dialog");
const MODAL_CLOSE_HANDLERS = document.querySelectorAll(".category_modal-decoration");
const WAYTODO_MODAL_OPEN = document.getElementById("waytodo_modal-handler");

WAYTODO_MODAL_OPEN.addEventListener('click', () => {
   WAYTODO_MODAL.showModal();
});


const INGREDIENTS_MODAL = document.getElementById("ingredients-dialog");
const INGREDIENTS_MODAL_OPEN = document.getElementById("ingredients_edit-handler");

INGREDIENTS_MODAL_OPEN.addEventListener('click', () => {
   INGREDIENTS_MODAL.showModal();
});

MODAL_CLOSE_HANDLERS.forEach(handler => {
   handler.addEventListener('click', () => {
      if(handler.dataset.modal == 'ingredients')
      {
         return INGREDIENTS_MODAL.close();
      }

      return WAYTODO_MODAL.close();
   });
});

INGREDIENTS_MODAL.showModal();