const EXIT_PAGE_HANDLERS = document.querySelectorAll(".btn_exit");

EXIT_PAGE_HANDLERS.forEach(handler => {
   handler.addEventListener("click", () => {
      window.history.back();
   });
});