const SLIDE_PANEL = document.querySelector(".advice-wrapper");
const SLIDE_PANEL_HANDLER = document.querySelectorAll(".panel--handler");

var signUp = document.querySelector(".signup--wrapper");
var login = document.querySelector(".login--wrapper");

SLIDE_PANEL_HANDLER.forEach((handler) => {
   handler.addEventListener("click", () => {
      var states = [signUp, login];
      var stateHandler = handler.parentElement;
 
      states.filter((x) => x == stateHandler?x.setAttribute("cur-state", "false"):x.setAttribute("cur-state", "true"));
      return stateHandler.getAttribute("class") == "signup--wrapper"?SLIDE_PANEL.setAttribute("data-state", "login"):SLIDE_PANEL.setAttribute("data-state", "signup");
   });
});