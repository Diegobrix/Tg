const MENU_HANDLER = document.getElementById("mobile_menu--handler");
const MOBILE_MENU = document.querySelector(".mobile-menu");
const BTN_CLOSE = document.getElementById("btn_close");

MENU_HANDLER.addEventListener("click", () => {
   if(MOBILE_MENU.getAttribute("aria-expanded") == "false")
   {
      setTimeout(function(){
         MOBILE_MENU.setAttribute("aria-expanded", "true");
      }, 10);
   }
});

BTN_CLOSE.addEventListener("click", () => {
   if(MOBILE_MENU.getAttribute("aria-expanded") == "true")
   {
      setTimeout(function(){
         MOBILE_MENU.setAttribute("aria-expanded", "false")
      }, 10);
   }
});

var tmId;
document.addEventListener("click", (event) => {
   if(MOBILE_MENU.getAttribute("aria-expanded") == "true")
   {
      clearTimeout(tmId);
      if(event.target !== MOBILE_MENU && !MOBILE_MENU.contains(event.target))
      {
         tmId = setTimeout(function(){
            MOBILE_MENU.setAttribute("aria-expanded", "false");
         }, 5);
      }
   }
});