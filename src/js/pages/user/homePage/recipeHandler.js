import sendData from "../../../bd_conn/sendData.js";

const CATEGORY_HANDLERS = document.querySelectorAll('.category');

CATEGORY_HANDLERS.forEach(handler => {
   handler.addEventListener('click', () => {
      let categoryId = handler.dataset.id;

      const BODY = {
         'category': categoryId
      };
      let response = sendData('http://127.0.0.1/tg/app/bd-conn-controller/pages/user/getRecipesByCategory.php', BODY)
      .then(resp => {
         if(resp.status == 'success')
         {
            console.log(resp);
         }
      });
   });
});