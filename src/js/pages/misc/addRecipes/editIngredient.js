const EDIT_INGREDIENTS = document.querySelector(".ingredients_edit");
const BTNS_REMOVE_INGREDIENT = document.querySelectorAll(".btn_remove"); 

EDIT_INGREDIENTS.addEventListener("click", () => {
   BTNS_REMOVE_INGREDIENT.forEach(btn => {
      let curState = btn.ariaHidden;
      btn.ariaHidden = curState == "true"?"false":"true";
   });
});

BTNS_REMOVE_INGREDIENT.forEach(btn => {
   btn.addEventListener("click", (event) => {
      event.preventDefault();

      let parent = btn.parentElement;
      let ingredientTitle = parent.querySelector(".ingredient_title").innerText;

      if(confirm(`Deseja mesmo remover o ingrediente "${ingredientTitle}" da receita?`))
      {
         parent.remove();
      }
   });
});