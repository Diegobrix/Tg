import sendData from "../../../bd_conn/sendData.js";

const CATEGORY_HANDLERS = document.querySelectorAll('.category');

CATEGORY_HANDLERS.forEach(handler => {
   handler.addEventListener('click', () => {
      let categoryId = handler.dataset.id;
      
      CATEGORY_HANDLERS.forEach(h => {
         if(h.dataset.current == "true")
         {
            h.dataset.current = "false";
         }
      });
      handler.dataset.current = "true";

      const BODY = {
         'category': categoryId
      };
      let response = sendData('http://127.0.0.1/tg/app/bd-conn-controller/pages/user/getRecipesByCategory.php', BODY)
      .then(resp => {
         if(resp.status == 'success')
         {
            if(resp.data.length > 0)
            {
               generateContent(resp.data);
            }
         }
      });
   });
});

const RECIPE_BY_CATEGORY_TEMPLATE = document.getElementById('recipe_by_category-template');
const RECIPES_BY_CATEGORY_FRAGMENT = document.createDocumentFragment();
const RECIPES_BY_CATEGORY_CONTAINER = document.querySelector('.results-container');

function generateContent(content, i = 0)
{
   if(i < content.length)
   {
      const RESULT = RECIPE_BY_CATEGORY_TEMPLATE.content.cloneNode(true).children[0];
      let link = RESULT.querySelector('a');
      let recipeThumb = RESULT.querySelector('img');
      let recipeTitle = RESULT.querySelector('.recipe-title');
      let recipeBenefits = RESULT.querySelector('.recipe-benefits');
      
      let recipePath = `./app/pages/user/recipe.php?id=${content[i].id}`;
      let thumbPath = `./assets/images/recipes/${content[i].thumb}`;

      link.href = recipePath;
      recipeThumb.src = thumbPath;
      recipeTitle.innerHTML = content[i].title;
      recipeBenefits.innerHTML = content[i].benefits;

      RECIPES_BY_CATEGORY_FRAGMENT.append(RESULT);
      i += 1;
      return generateContent(content, i);
   }
      
   clearContainer();
   RECIPES_BY_CATEGORY_CONTAINER.append(RECIPES_BY_CATEGORY_FRAGMENT);
   return; 
}

function clearContainer()
{
   let containerChildren = RECIPES_BY_CATEGORY_CONTAINER.childNodes;
   let currentRecipes = [];
   containerChildren.forEach(recipe => {
      if((recipe.classList != undefined) && (recipe.classList.contains('recipe')))
      {
         currentRecipes.push(recipe);
      }
   });

   if(currentRecipes.length > 0)
   {
      currentRecipes.forEach(recipe => {
         recipe.remove();
      });
   }
}