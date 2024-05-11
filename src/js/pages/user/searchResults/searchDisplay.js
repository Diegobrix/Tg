import sendData from "../../../bd_conn/sendData.js";
import recipesJson from "../../../../../app/pages/admin/data/datasets/recipes.json" with {"type":"json"};

const SEARCHBAR = document.getElementById("searchbar");
const RESULTS_CONTAINER = document.querySelector(".results_display-container");

SEARCHBAR.addEventListener("keydown", (event) => {
   if (event.key === 'Enter') {
      setTimeout(() => {
         const PATTERN = /\S/g;
         let searchedTerm = SEARCHBAR.value;

         if((searchedTerm.length > 0) && (searchedTerm.match(PATTERN)))
         {
            console.log("Redirecionando... para " + searchedTerm);
         }
      }, 0);
   }
});

document.addEventListener('DOMContentLoaded', () => {
   getSearchedRecipes(SEARCHBAR.getAttribute('placeholder'));
});

function getSearchedRecipes(term)
{
   const BODY = {
      'searchedTerm': term
   };

   let response = sendData('http://127.0.0.1/tg/app/bd-conn-controller/pages/recipeSearch/searchApi.php', BODY)
   .then(resp => {
      if(resp.status == 'success')
      {
         generateSearchElement(resp.data);
      }
   });
}

const SEARCH_ELEMENT_TEMPLATE = document.getElementById('result-template');
const RESULTS_FRAGMENT = document.createDocumentFragment();
function generateSearchElement(recipes)
{
   let searchedRecipes = getRecipes(recipes);
   console.log(searchedRecipes);

   if(searchedRecipes.length > 0)
   {
      for(let i = 0; i < searchedRecipes.length; i++)
      {
         const RESULT = SEARCH_ELEMENT_TEMPLATE.content.cloneNode(true).children[0];
      
         let RESULT_THUMB = RESULT.querySelector('.recipe-thumb');
         RESULT_THUMB.src = "../../../assets/images/recipes/" + searchedRecipes[i].thumb;
         
         let RESULT_TITLE = RESULT.querySelector('.result-title');
         RESULT_TITLE.innerText = searchedRecipes[i].title;
      
         RESULTS_FRAGMENT.append(RESULT);
      }

      console.log(RESULTS_FRAGMENT);
      RESULTS_CONTAINER.append(RESULTS_FRAGMENT);
   }
}

function getRecipes(recipes, current = 0, result = [])
{
   if(current < recipes.length)
   {
      const recipe = recipesJson.find((recipe) => recipe.id === recipes[current].id);
      if (recipe)
      {
         result.push(recipe);
      }

      current += 1;
      return getRecipes(recipes, current, result);
   }

   return result;
}