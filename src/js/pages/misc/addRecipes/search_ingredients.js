import sendData from "../../../bd_conn/addRecipe/sendData.js";

const SEARCHBAR_CONTAINER = document.querySelector(".search_bar");
const INGREDIENT_SEARCH_BAR = document.getElementById("txtSearchIngredient");
const SUGGESTIONS_TEMPLATE = document.querySelector("[data-template]");
const SUGGESTIONS_CONTAINER = document.querySelector(".ingredient_suggestions-container");

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
       suggestion.addEventListener("click", () => {
         console.log(suggestion);
         
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