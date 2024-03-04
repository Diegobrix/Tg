const CONTAINER = document.getElementById("result--wrapper");
const RESULT_FRAGMENT = document.createDocumentFragment();

let recipesAPI = fetch("../../../../tg/app/pages/admin/data/dashboard_data/datasets/recipes.json")
.then(response => response.json())
.then((json) => {
   displayRecipes(json);
});

let recipes;
function displayRecipes(recipe)
{
   recipes = recipe;

   if(recipes.length <= 0)
   {
      return;
   }

   generateList(recipes, 0);
}

function generateList(jsons, current)
{
   if(current < jsons.length)
   {
      RESULT_FRAGMENT.appendChild(createRecipe(jsons[current]));
      current += 1;
      return generateList(jsons, current);
   }

   CONTAINER.appendChild(RESULT_FRAGMENT);
}

function createRecipe(json)
{
   let itemContainer = document.createElement("div");
   let itemFigure = document.createElement("figure");
   let itemThumb = document.createElement("img");
   let itemTitle = document.createElement("h2");
   let itemCategory = document.createElement("span");
   let itemOptions = document.createElement("button");

   itemContainer.classList.add("result");
   itemTitle.classList.add("result-title");
   itemCategory.classList.add("result-category");
   itemOptions.classList.add("result_handler");

   itemTitle.innerHTML = json.tituloReceita;
   itemThumb.src = "../../../assets/images/recipes/" + json.fotoReceita;
   itemCategory.innerHTML = json.categoria;

   itemFigure.appendChild(itemThumb);
   itemContainer.appendChild(itemFigure);
   itemContainer.appendChild(itemTitle);
   itemContainer.appendChild(itemCategory);
   itemContainer.appendChild(itemOptions);

   RESULT_FRAGMENT.appendChild(itemContainer);

   return itemContainer;
}