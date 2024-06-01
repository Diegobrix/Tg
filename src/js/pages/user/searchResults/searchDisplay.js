import sendData from "../../../bd_conn/sendData.js";
import { recipesDefinition } from "./filterDefinition.js";
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
      let recipes = [];
      let categories = [];
      let authors = [];
      let conditions = [];
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
         
         recipes.push(searchedRecipes[i]);
         categories.push(searchedRecipes[i].category);
         authors.push(searchedRecipes[i].author);
         conditions.push(searchedRecipes[i].condition);
      }

      console.log(RESULTS_FRAGMENT);
      RESULTS_CONTAINER.append(RESULTS_FRAGMENT);

      recipesDefinition(recipes, categories, authors, conditions);
      generateCategoriesFilter();
   }
   else
   {
      const NO_RESULTS_TEMPLATE = document.getElementById('no_results-template');
      RESULTS_CONTAINER.append(NO_RESULTS_TEMPLATE.content.children[0]);
   }
}

//#region Filter Configurations
const CATEGORY_FILTER_TEMPLATE = document.getElementById('categories-template');
const CATEGORIES_FILTER_FRAGMENT = document.createDocumentFragment();
const CATEGORIES_FILTER_SETTING_CONTAINER = document.querySelector('.categories_option-container');
function generateCategoriesFilter()
{
   let categories = JSON.parse(localStorage.getItem('categories'));
   for(let i = 0; i < categories.length; i++)
   {
      const CATEGORY_FILTER = CATEGORY_FILTER_TEMPLATE.content.cloneNode(true).children[0];
      const INPUT = CATEGORY_FILTER.querySelector('input[type="checkbox"]');
      INPUT.id = 'category_'+categories[i].toLowerCase().split(' ').join('_');

      CATEGORY_FILTER.append(categories[i]);
      CATEGORIES_FILTER_FRAGMENT.appendChild(CATEGORY_FILTER);
   }

   let children = CATEGORIES_FILTER_SETTING_CONTAINER.querySelector('label');
   CATEGORIES_FILTER_SETTING_CONTAINER.insertBefore(CATEGORIES_FILTER_FRAGMENT, children);

   uniqueFilter();
}
//#endregion

//#region Recipe Configurations
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
//#endregion

function uniqueFilter()
{
   const CATEGORIES_OPTIONS = document.querySelectorAll('input[name="category_option"]');

   CATEGORIES_OPTIONS.forEach(categoryOptions => {
      categoryOptions.addEventListener('change', function(){
         if(this.checked)
         {
            CATEGORIES_OPTIONS.forEach(checkbox => {
               if(checkbox !== this)
               {
                  checkbox.checked = false;
               }
            });
            
            selectRecipes(this.id);
         }
      });
   });
}