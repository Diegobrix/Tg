const DISPLAY_MODE_HANDLERS = document.querySelectorAll(".display_mode");

DISPLAY_MODE_HANDLERS.forEach(handler => {
   handler.addEventListener("click", () => {
      let currentMode = handler.dataset.mode;
      changeMode(currentMode);
   });
});

function changeMode(currentMode)
{
   DISPLAY_MODE_HANDLERS.forEach(handler => {
      handler.ariaSelected = "false";
   });

   if(currentMode == "list")
   {
      return DISPLAY_MODE_HANDLERS[0].ariaSelected = "true";
   }

   return DISPLAY_MODE_HANDLERS[1].ariaSelected = "true";
}