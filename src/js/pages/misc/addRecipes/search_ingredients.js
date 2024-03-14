const INGREDIENT_SEARCH_BAR = document.getElementById("txtSearchIngredient");

INGREDIENT_SEARCH_BAR.addEventListener("keypress", (event) => {
   if(event.key === "Enter")
   {
      event.preventDefault();
   }
});