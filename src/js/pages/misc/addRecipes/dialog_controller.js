const MODAL = document.getElementById("add_ingredient-modal");
const MODAL_HANDLER = document.querySelector(".add_ingredient");
const MODAL_CONTENT_CONTROLLER = document.getElementById("add_ingredient_modal_controller");
const MODAL_CONTENT = MODAL.querySelector(".amount-wrapper");
const INGREDIENT_TITLE_INPUT = MODAL.querySelector("#txtIngredient");
const INGREDIENT_AMOUNT_INPUT = MODAL_CONTENT.querySelector("#txtIngredientAmount"); 
const UNIT_SELECTOR = document.getElementById("slcUnit");

MODAL_HANDLER.addEventListener("click", () => {
   setTimeout(() => {
   }, 10);
});

MODAL.showModal();

window.addEventListener("click", (event) => {
   let modalState = MODAL.getAttribute("open");

   if(modalState != null)
   {
      if((event.target !== MODAL) && (!MODAL.contains(event.target)))
      {
         setTimeout(() => {
            MODAL.removeAttribute("open");
         }, 5);
      }
   }
});

MODAL_CONTENT_CONTROLLER.addEventListener("click", () => {
   let pattern = /\S/g;
   if((INGREDIENT_TITLE_INPUT.value.length > 0) && (INGREDIENT_TITLE_INPUT.value.match(pattern)))
   {
      let currentAction = MODAL_CONTENT_CONTROLLER.dataset.currentAction;
      console.log(currentAction);
      
      return modalContentStateHandler(currentAction);
   }

   showMessage("O campo deve ser preenchido antes de continuar");
   return;
});

function modalContentStateHandler(currentAction)
{
   if(currentAction == "next")
   {
      openHiddenFields();
   }
   else 
   {
      let pattern = /[0-9]+/g;      

      console.log(INGREDIENT_AMOUNT_INPUT.value);
      if((INGREDIENT_AMOUNT_INPUT.value.length > 0) && (INGREDIENT_AMOUNT_INPUT.value.match(pattern)))
      {
         finishRegistration();
      }
      else
      {
         showMessage("O campo quantidade, deve possuir um valor inteiro");
      }
   }
}

function openHiddenFields()
{
   MODAL_CONTENT_CONTROLLER.dataset.currentAction = "finish";
   MODAL_CONTENT.ariaHidden = !MODAL_CONTENT.ariaHidden;
}

function finishRegistration()
{
   MODAL_CONTENT_CONTROLLER.dataset.currentAction = "next";

   const ingredientRequestBody = {
      "ingredient_title": INGREDIENT_TITLE_INPUT.value.toLowerCase(),
      "ingredient_amount": INGREDIENT_AMOUNT_INPUT.value,
      "amount_unit": UNIT_SELECTOR.value
   };

   let response = sendData(ingredientRequestBody)
   .then(r => {
      console.log(r);
      /*
      if(r.status == "failed")
      {
         window.alert("Erro");
      }
      else
      {
         window.alert("Deu bom meu nobre");
      }*/
   });
}

function showMessage(msg)
{
   window.alert(msg);
}

async function sendData(data)
{
   let requestOptions = {
      method: "POST",
      Headers: {
         "Content-type": "application/json"
      },
      body: JSON.stringify(data)
   };

   try
   {
      const response = await fetch("http://127.0.0.1/tg/app/bd-conn-controller/pages/misc/addIngredientDB.php", requestOptions);
      return await response.json();
   }
   catch(e)
   {
      console.log(e);
   }
}