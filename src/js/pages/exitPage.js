const BTN_EXIT_PAGE = document.getElementById("btn_exit");

BTN_EXIT_PAGE.addEventListener("click", () => {
   history.back();
});