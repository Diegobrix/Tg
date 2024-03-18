const MODAL = document.getElementById("add_ingredient-modal");
const MODAL_HANDLER = document.querySelector(".add_ingredient");
const MODAL_CONTENT_CONTROLLER = document.getElementById("add_ingredient_modal_controller");
const MODAL_CONTENT = MODAL.querySelector(".amount-wrapper");
const INGREDIENT_TITLE_INPUT = MODAL.querySelector("#txtIngredient");

MODAL_HANDLER.addEventListener("click", () => {
   setTimeout(() => {
   }, 10);
});

MODAL.showModal();

window.addEventListener("click", (event) => {
   let modalState = MODAL.getAttribute("open");

   if(modalState != null)
   {
      if((event.target !== MODAL) && (!MODAL.contains(event.target)))
      {
         setTimeout(() => {
            MODAL.removeAttribute("open");
         }, 5);
      }
   }
});

MODAL_CONTENT_CONTROLLER.addEventListener("click", () => {
   if(INGREDIENT_TITLE_INPUT.value.length > 0)
   {
      let currentAction = MODAL_CONTENT_CONTROLLER.dataset.currentAction;
      console.log(currentAction);
      
      modalContentStateHandler(currentAction);
   }
   return;
});

function modalContentStateHandler(currentAction)
{
   if(currentAction == "next")
   {
      MODAL_CONTENT_CONTROLLER.dataset.currentAction = "finish";
      MODAL_CONTENT.ariaHidden = !MODAL_CONTENT.ariaHidden;
   }
   else 
   {
      MODAL_CONTENT_CONTROLLER.dataset.currentAction = "next";
   }
}