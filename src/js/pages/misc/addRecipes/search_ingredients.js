import Conn from "../../../bd_conn/Conn.js";

const INGREDIENT_SEARCH_BAR = document.getElementById("txtSearchIngredient");

INGREDIENT_SEARCH_BAR.addEventListener("keypress", (event) => {
   if(event.key === "Enter")
   {
      event.preventDefault();

      const SEARCHBAR_CONTENT = INGREDIENT_SEARCH_BAR.value;
      let response = getIngredients(SEARCHBAR_CONTENT);
   }
});

const conn = new Conn("http://127.0.0.1/tg/");
function getIngredients(data)
{
   const endpoint = "app/bd-conn-controller/pages/misc/getContent/getIngredients.php";
   const params = {};

   conn.fetchData(endpoint, params)
   .then(response => {
      console.log(response);
   })
   .catch(e => {
      console.log("Erro: " + e);
   });
}