const MENU_HANDLER = document.getElementById("mobile_menu--handler");
const MOBILE_MENU = document.querySelector(".mobile-menu");
const BTN_CLOSE = document.getElementById("btn_close");

MENU_HANDLER.addEventListener("click", () => {
   menuHandle(MOBILE_MENU.getAttribute("aria-expanded"));
});

BTN_CLOSE.addEventListener("click", () => {
   menuHandle(MOBILE_MENU.getAttribute("aria-expanded"));
});

function menuHandle(currentState)
{
   currentState=="true"?MOBILE_MENU.setAttribute("aria-expanded", "false"):MOBILE_MENU.setAttribute("aria-expanded", "true")
}