const INGREDIENT_SEARCH_BAR = document.getElementById("txtSearchIngredient");

INGREDIENT_SEARCH_BAR.addEventListener("input", () => {
    const SEARCHBAR_CONTENT = INGREDIENT_SEARCH_BAR.value;
});

const requestOptions = {
   method: "POST",
   Headers: {
      "Content-type": "application/json"
   }
};

fetch("http://192.168.0.13/tg/app/bd-conn-controller/pages/misc/getContent/getIngredients.php", requestOptions)
.then(response => response.json())
.then(data => console.log(data));