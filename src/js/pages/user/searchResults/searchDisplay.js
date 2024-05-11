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
            window.location.href = "./searchResult.php?searchedTerm=" + searchedTerm;
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
   searchedRecipes.sort(sortRecipes);

   if(searchedRecipes.length > 0)
   {
      for(let i = 0; i < searchedRecipes.length; i++)
      {
         const RESULT = SEARCH_ELEMENT_TEMPLATE.content.cloneNode(true).children[0];
      
         let RESULT_THUMB = RESULT.querySelector('.recipe-thumb');
         RESULT_THUMB.src = "../../../assets/images/recipes/" + searchedRecipes[i].thumb;
         
         let RESULT_TITLE = RESULT.querySelector('.result-title');
         RESULT_TITLE.innerHTML = searchedRecipes[i].title;
         
         let RESULT_DESCRIPTION = RESULT.querySelector('.result-description');
         RESULT_DESCRIPTION.innerHTML = searchedRecipes[i].description;

         let RESULT_LINK = RESULT.querySelector('.recipe-link');
         RESULT_LINK.href = './recipe.php?id=' + searchedRecipes[i].id;
      
         RESULTS_FRAGMENT.append(RESULT);
      }

      console.log(RESULTS_FRAGMENT);
      RESULTS_CONTAINER.append(RESULTS_FRAGMENT);
   }
   else
   {
      const NO_RESULTS_TEMPLATE = document.getElementById('no_results-template');
      RESULTS_CONTAINER.append(NO_RESULTS_TEMPLATE.content.children[0]);
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

function sortRecipes(x, y)
{
   if(x.similarity < y.similarity)
   {
      return -1;
   }
   if(x.similarity > y.similarity)
   {
      return 1;
   }

   return 0;
}