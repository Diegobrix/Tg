import sendData from "../../../bd_conn/addRecipe/sendData.js";
import { addIngredientElement } from "./addIngredientDialog_controller.js";

const SEARCHBAR_CONTAINER = document.querySelector(".search_bar");
const INGREDIENT_SEARCH_BAR = document.getElementById("txtSearchIngredient");
const SUGGESTIONS_TEMPLATE = document.querySelector("[data-template]");
const SUGGESTIONS_CONTAINER = document.querySelector(".ingredient_suggestions-container");
const INGREDIENT_MODAL = document.getElementById("ingredient-modal");

INGREDIENT_SEARCH_BAR.addEventListener("click", () => {
   showSuggestions();
});

document.addEventListener("click", function(event) {
   const clickedElement = event.target;
   if (!SEARCHBAR_CONTAINER.contains(clickedElement) && !SEARCHBAR_CONTAINER.contains(clickedElement)) {
      hideSuggestions();
   }
});

INGREDIENT_SEARCH_BAR.addEventListener("input", (key) => {
   const SEARCHBAR_CONTENT = key.target.value.toLowerCase();

   ingredients.forEach(ingredient => {
      const isVisible = ingredient.ingredient.toLowerCase().includes(SEARCHBAR_CONTENT);
      ingredient.suggestion.classList.toggle("hide", !isVisible);

      if((SEARCHBAR_CONTENT.length <= 0) && (!ingredient.suggestion.classList.contains("hide")))
      {
         ingredient.suggestion.classList.add("hide");
      }
   });
});

let ingredients = [];

sendData("http://127.0.0.1/tg/app/bd-conn-controller/pages/misc/getContent/getIngredients.php")
.then(data => {
   console.log(data.ingredient);
   try
   {
      ingredients = data.ingredient.map(ingredient => {
         const suggestionWrapper = SUGGESTIONS_TEMPLATE.content.cloneNode(true).children[0];
         const suggestion = suggestionWrapper.querySelector(".ingredient");

         suggestion.textContent = ingredient.ingredient;
         suggestion.id = ingredient.id;

         SUGGESTIONS_CONTAINER.append(suggestionWrapper);
         
         return {"id": ingredient.id, "ingredient": ingredient.ingredient, "suggestion": suggestionWrapper};
      });
   }
   catch(e)  
   {
      console.log(e);
   }

   const INGREDIENT_SUGGESTIONS = document.querySelectorAll(".suggestion");
   INGREDIENT_SUGGESTIONS.forEach(suggestion => {
       suggestion.addEventListener("click", (event) => {
         event.preventDefault();
         event.stopPropagation();

         let vals = suggestion.querySelector(".ingredient");
         setIngredientModal(vals.id, vals.textContent);         
         hideSuggestions();
      });
   });
});

function showSuggestions() {
   SEARCHBAR_CONTAINER.ariaHidden = "false";
}

function hideSuggestions() {
   SEARCHBAR_CONTAINER.ariaHidden = "true";
}

const INGREDIENT_ID = INGREDIENT_MODAL.querySelector("#ingredient_id");
const INGREDIENT_TITLE = INGREDIENT_MODAL.querySelector("#txtIngredient");
const MODAL_CONTROLLER = INGREDIENT_MODAL.querySelector("#add_ingredient_modal_controller");
const MODAL_INGREDIENT_AMOUNT = INGREDIENT_MODAL.querySelector("#txtIngredientAmount");
const UNIT_SELECTOR = INGREDIENT_MODAL.querySelector("#slcUnit");

function setIngredientModal(id, title)
{
   console.log("Id: " + id);
   console.log("Title: " + title);

   INGREDIENT_MODAL.showModal();

   const MODAL_TITLE = INGREDIENT_MODAL.querySelector("h2");
   MODAL_TITLE.innerHTML = "Adicionar <br>ingrediente";

   INGREDIENT_ID.value = id;
   INGREDIENT_TITLE.value = title;

   MODAL_CONTROLLER.dataset.currentAction = "select";
   MODAL_CONTROLLER.textContent = "Adicionar";

   const FIELDS = INGREDIENT_MODAL.querySelector(".amount-wrapper");
   FIELDS.ariaHidden = "false";

   MODAL_CONTROLLER.addEventListener("click", () => {
      let pattern = /\d/g;
      if((MODAL_INGREDIENT_AMOUNT.value.length > 0) && (MODAL_INGREDIENT_AMOUNT.value.match(pattern)))
      {
         let data = {"id": INGREDIENT_ID.value,"ingredient": INGREDIENT_TITLE.value,"amount": MODAL_INGREDIENT_AMOUNT.value, "unit": UNIT_SELECTOR.value};
         addIngredientElement(data);

         INGREDIENT_MODAL.close();
         INGREDIENT_SEARCH_BAR.value = "";
         console.log(data);

         clearModal("select");
      }
   });
}

export function clearModal(action)
{
   INGREDIENT_ID.value = "";
   INGREDIENT_TITLE.value = "";

   MODAL_CONTROLLER.dataset.currentAction = action;
   MODAL_INGREDIENT_AMOUNT.value = "";

   UNIT_SELECTOR.selectedIndex = 0;
}