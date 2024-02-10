const WIDGET_HANDLER = document.querySelectorAll(".widget_controller");

WIDGET_HANDLER.forEach((handler) => {
   handler.addEventListener("click", () => {
      window.alert("Ma oi");
   });
});