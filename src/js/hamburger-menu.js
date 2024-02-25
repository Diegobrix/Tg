const MENU_HANDLER = document.getElementById("mobile_menu--handler");
const MOBILE_MENU = document.querySelector(".mobile-menu");

MENU_HANDLER.addEventListener("click", () => {
   let currentState = MOBILE_MENU.getAttribute("aria-expanded");
   
   if(currentState == "false")
   {
      MOBILE_MENU.setAttribute("aria-expanded", "true");
   }
});