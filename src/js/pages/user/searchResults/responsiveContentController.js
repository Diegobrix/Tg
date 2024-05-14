document.addEventListener("DOMContentLoaded", () => {
   adjustResponsiveContent(checkWindowSize());
});

window.addEventListener('resize', () => {
   adjustResponsiveContent(checkWindowSize());
});

function checkWindowSize()
{
   const DESKTOP_SIZE = 1440;
   return DESKTOP_SIZE > window.innerWidth?'mobile':'desktop';
}

const DISPLAY_HANDLERS = document.querySelectorAll('.display_mode');
function adjustResponsiveContent(currentState)
{
   if(currentState === 'mobile')
   {
      DISPLAY_HANDLERS[0].ariaSelected = 'true';
      DISPLAY_HANDLERS[1].ariaSelected = 'false';
      return;
   }
   DISPLAY_HANDLERS[0].ariaSelected = 'false';
   DISPLAY_HANDLERS[1].ariaSelected = 'true';
}