const BTNS_EXIT_PAGE = document.querySelectorAll(".btn_back");

BTNS_EXIT_PAGE.forEach(btn => {
   btn.addEventListener("click", () => {
      history.back();
   });
})

function goTo(page)
{
   document.location.href = page;
}