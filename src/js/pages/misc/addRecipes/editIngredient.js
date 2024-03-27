const EDIT_INGREDIENTS = document.querySelector(".ingredients_edit");
const BTNS_REMOVE_INGREDIENT = document.querySelectorAll(".btn_remove"); 

EDIT_INGREDIENTS.addEventListener("click", () => {
   BTNS_REMOVE_INGREDIENT.forEach(btn => {
      let curState = btn.ariaHidden;
      btn.ariaHidden = curState == "true"?"false":"true";
   });
});

BTNS_REMOVE_INGREDIENT.forEach(btn => {
   btn.addEventListener("click", () => {
      window.alert("Oops");
   });
});