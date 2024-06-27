const DROPDOWN_MENU_HANDLER = document.querySelector(".btn_menu_add");
const DROPDOWN_MENU = document.querySelector(".dropdown_menu");

DROPDOWN_MENU_HANDLER.addEventListener("click", () => {
   let currentState = DROPDOWN_MENU.getAttribute("aria-hidden");

   if(currentState == "true")
   {
      setTimeout(function(){
         DROPDOWN_MENU.setAttribute("aria-hidden", "false");
      }, 10);
   }
   else
   {
      DROPDOWN_MENU.setAttribute("aria-hidden", "true");
   }
});

var timeoutId;
document.addEventListener("click", (event) => {
   clearTimeout(timeoutId);

   if(DROPDOWN_MENU.getAttribute("aria-hidden") !== "true")
   {
      timeoutId = setTimeout(function() {
         if(event.target !== DROPDOWN_MENU && !DROPDOWN_MENU.contains(event.target))
         {
            DROPDOWN_MENU.setAttribute("aria-hidden", "true");
         }
      }, 5);
   }
});