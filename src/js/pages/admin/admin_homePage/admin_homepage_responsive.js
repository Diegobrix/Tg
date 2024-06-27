const desktopMenu = document.querySelector(".desktop-menu");
const MOBILE_SIZE = 375;

viewportResize(window.innerWidth);
window.addEventListener("resize", () => {
   viewportResize(window.innerWidth);
});

function viewportResize(width)
{
   if(width > MOBILE_SIZE)
   {
      desktopMenu.setAttribute("aria-hidden", "false");
   }
   else
   {
      desktopMenu.setAttribute("aria-hidden", "true");
   }
}