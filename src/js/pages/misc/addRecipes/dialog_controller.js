const MODAL = document.getElementById("add_ingredient-modal");
const MODAL_HANDLER = document.querySelector(".add_ingredient");

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