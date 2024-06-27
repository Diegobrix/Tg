const SEARCHBAR = document.querySelectorAll('.searchbar');

SEARCHBAR.forEach(bar => {
   bar.addEventListener('keydown', function(event){
      if(event.key == 'Enter')
      {
         event.preventDefault();
         let searchedTerm = bar.value;

         bar.value = '';
         window.location.href = "./app/pages/user/searchResult.php?searchedTerm="+searchedTerm;
      }
   });
});