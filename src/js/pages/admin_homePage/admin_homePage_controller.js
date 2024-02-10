const desktopMenu = document.querySelector(".desktop-menu");
const MOBILE_SIZE = 375;

init(window.innerWidth);
window.addEventListener("resize", () => {
   init(window.innerWidth);
});

function init(width)
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