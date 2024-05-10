const SEARCHBAR = document.getElementById("searchbar");

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
   //Envia para o arquivo searchApi os dados necessários
});