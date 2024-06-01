export function recipesDefinition(recipes, categories, authors, conditions)
{
   if(recipes != null)
   {
      localStorage.setItem('recipes', JSON.stringify(recipes));
      localStorage.setItem('categories', JSON.stringify(categories));
      localStorage.setItem('authors', JSON.stringify(authors));
      localStorage.setItem('condition', JSON.stringify(conditions));
   }
}

export function setFilter(type, value)
{
   let originalRecipes = localStorage.getItem('recipes');
   let recipes = JSON.parse(originalRecipes);

   let types = ['category', 'author'];

   let filteredRecipes = recipes.filter((recipe) => recipe[types[type]] == value);
   console.log(filteredRecipes);
}

setFilter(0, 'Ao mosso');