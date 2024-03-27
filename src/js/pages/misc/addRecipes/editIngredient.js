const EDIT_INGREDIENTS = document.querySelector(".ingredients_edit");
const BTNS_REMOVE_INGREDIENT = document.querySelectorAll(".btn_remove"); 
const INGREDIENTS = document.querySelectorAll(".ingredient");

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

const INGREDIENT_MODAL = document.getElementById("ingredient-modal");
INGREDIENTS.forEach(ingredient => {
   ingredient.addEventListener("click", (event) => {
      event.stopPropagation();
      event.preventDefault();

      let ingredientTitleValue = ingredient.querySelector(".ingredient_title").innerText;
      let ingredientValues = ingredient.querySelector("input[type='hidden']").value;
      let oldValues = ingredientValues.split('/');

      let id = oldValues[0];
      let amount = oldValues[2];
      let unitId = oldValues[3];

      console.log(ingredientValues);

      let modalTitle = INGREDIENT_MODAL.querySelector("h2");
      modalTitle.innerHTML = "Editar<br>"+ingredientTitleValue;
      INGREDIENT_MODAL.showModal();

      INGREDIENT_MODAL.querySelector(".amount-wrapper").ariaHidden = "false";

      let ingredientTitle = INGREDIENT_MODAL.querySelector("#txtIngredient");
      ingredientTitle.value = ingredientTitleValue;

      let ingredientAmount = INGREDIENT_MODAL.querySelector("#txtIngredientAmount");
      ingredientAmount.value = amount;

      let unitSelectorOptions = INGREDIENT_MODAL.querySelectorAll("#slcUnit > option");
      unitSelectorOptions.forEach(option => {
         if(option.value == unitId)
         {
            option.selected = true;
         }
      });

      let modalController = INGREDIENT_MODAL.querySelector("#add_ingredient_modal_controller");
      modalController.innerText = "Alterar";
      modalController.dataset.currentAction = "edit";

      let newValues;
      modalController.addEventListener("click", () => {
         let ingredientVals = ingredient.querySelector("input[type='hidden']");

         unitSelectorOptions.forEach(option => {
            if(option.selected)
            {
               newValues = id + "/" + ingredientTitle.value.toLowerCase() + "/" + ingredientAmount.value + "/" + option.value;

               ingredientVals.value = newValues;
               INGREDIENT_MODAL.close();

            }
         });

         if(ingredientValues.localeCompare(newValues) != 0)
         {
            console.log(ingredientValues);
            console.log(newValues);
            setTimeout(() => {
               notifyPage("Ingrediente alterado com sucesso!");
            }, 250);
         }
      });
   });
});

function notifyPage(msg)
{
   window.alert(msg);
}