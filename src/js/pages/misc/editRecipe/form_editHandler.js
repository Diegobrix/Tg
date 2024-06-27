const INPUTS = document.querySelectorAll('input[type="text"], textarea');

INPUTS.forEach(input => {
   input.addEventListener("keydown", (event) => {
      if(event.key === 'Enter')
      {
         event.preventDefault();
         input.blur();
      }
   });   
});