/* Apenas para testes */
const SUGGESTION = document.querySelectorAll(".suggestion");
const CURRENT_ITEM_HANDLER = document.querySelectorAll(".btn-handler");

SUGGESTION.forEach((sug) => {
   sug.addEventListener("click", () => {
      window.alert("Clicado: " + sug.getAttribute("data-current_step"));
   })
});

CURRENT_ITEM_HANDLER.forEach((handler) => {
   handler.addEventListener("click", () => {
      if(handler.classList.contains("btn-prev"))
      {
         window.alert("Goto: Anterior");
      }
      else
      {
         window.alert("Goto: Próximo");
      }
   });
});
