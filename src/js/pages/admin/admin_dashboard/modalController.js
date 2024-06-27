const MODAL_HANDLERS = document.querySelectorAll(".content");

MODAL_HANDLERS.forEach(handler => {
   const MODAL = handler.querySelector('#video-modal');

   if(MODAL != null)
   {
      
      handler.addEventListener("click", (event) => {
         event.stopPropagation();
         MODAL.showModal();
      });
      
      const MODAL_CLOSE = MODAL.querySelector(".decoration");
      MODAL_CLOSE.addEventListener("click", (event) => {
         event.stopPropagation();
         MODAL.close();
      });
   }
});