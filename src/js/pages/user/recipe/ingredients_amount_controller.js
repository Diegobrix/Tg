const INGREDIENTS_AMOUNT_HANDLER = document.querySelectorAll(".amount-handler");

INGREDIENTS_AMOUNT_HANDLER.forEach((handler) => {
   handler.addEventListener('click', () => {
      console.log(handler);
   });
});