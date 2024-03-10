const STEP_HANDLER = document.querySelectorAll(".step-handler");

STEP_HANDLER.forEach(handler => {
   handler.addEventListener("click", () => {
      window.alert("hey");
   });
});