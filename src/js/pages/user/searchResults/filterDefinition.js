export function recipesDefinition(categories, authors, conditions)
{
   localStorage.setItem('categories', JSON.stringify(categories));
   localStorage.setItem('authors', JSON.stringify(authors));
   localStorage.setItem('condition', JSON.stringify(conditions));
}