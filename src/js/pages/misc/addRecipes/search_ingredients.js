const INGREDIENT_SEARCH_BAR = document.getElementById("txtSearchIngredient");

INGREDIENT_SEARCH_BAR.addEventListener("keypress", (event) => {
   if(event.key === "Enter")
   {
      event.preventDefault();

      const SEARCHBAR_CONTENT = INGREDIENT_SEARCH_BAR.value;
      let response = getIngredients(SEARCHBAR_CONTENT);

      console.log(response);
   }
});

function getIngredients(param)
{
   const endpoint = "app/bd-conn-controller/pages/misc/getContent/getIngredients.php";
   const data = {"ingredient":param};

   xhr.post(endpoint, data, (error, response) => {
    if (error) {
        console.error(error);
    } else {
        console.log(response);
    }
});
}