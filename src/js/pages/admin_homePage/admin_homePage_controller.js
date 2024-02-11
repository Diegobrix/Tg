const desktopMenu = document.querySelector(".desktop-menu");
const MOBILE_SIZE = 375;

init(window.innerWidth);
window.addEventListener("resize", () => {
   init(window.innerWidth);
});

function init(width)
{
   if(width > MOBILE_SIZE)
   {
      desktopMenu.setAttribute("aria-hidden", "false");
   }
   else
   {
      desktopMenu.setAttribute("aria-hidden", "true");
   }
}


/* Apenas para testes */
const SUGGESTION = document.querySelectorAll(".suggestion");
const CURRENT_ITEM_HANDLER = document.querySelectorAll(".btn-handler");

SUGGESTION.forEach((sug) => {
   sug.addEventListener("click", () => {
      window.alert("Clicado: " + sug.getAttribute("id"));
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
