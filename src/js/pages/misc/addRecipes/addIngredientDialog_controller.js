import sendData from "../../../bd_conn/addRecipe/sendData.js";
import { clearModal } from "./search_ingredients.js";

const MODAL = document.getElementById("ingredient-modal");
const MODAL_HANDLER = document.querySelector(".add_ingredient");
const MODAL_CONTENT_CONTROLLER = document.getElementById("add_ingredient_modal_controller");
const MODAL_CONTENT = MODAL.querySelector(".amount-wrapper");
const INGREDIENT_TITLE_INPUT = MODAL.querySelector("#txtIngredient");
const INGREDIENT_AMOUNT_INPUT = MODAL_CONTENT.querySelector("#txtIngredientAmount"); 
const UNIT_SELECTOR = document.getElementById("slcUnit");

MODAL_HANDLER.addEventListener("click", () => {
   setTimeout(() => {
      MODAL.showModal();
   }, 10);
});


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
   else if(currentAction == "finish")
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

   const body = {
      "ingredient_title": INGREDIENT_TITLE_INPUT.value.toLowerCase(),
      "ingredient_amount": INGREDIENT_AMOUNT_INPUT.value,
      "unit_id": UNIT_SELECTOR.value
   };

   let response = sendData("http://127.0.0.1/tg/app/bd-conn-controller/pages/misc/addContent/addIngredientDB.php", body)
   .then(resp => {
      if(resp.status == "success")
      {
         addIngredientElement(resp.ingredient);
         closeIngredientModal();

         clearModal("next");
      }
   });
}

function showMessage(msg)
{
   window.alert(msg);
}

function closeIngredientModal()
{
   MODAL.close();
}

const INGREDIENTS_CONTAINER = document.querySelector(".ingredients");
const INGREDIENTS_TEMPLATE = INGREDIENTS_CONTAINER.querySelector("#ingredient_template");
export function addIngredientElement(data)
{
   const INGREDIENT = INGREDIENTS_TEMPLATE.content.cloneNode(true).children[0];
   INGREDIENT.id = "ingredient-" + data.id;
   
   let ingredientTitle = INGREDIENT.querySelector(".ingredient_title");
   ingredientTitle.innerText = data.ingredient;

   let ingredientData = INGREDIENT.querySelector("input[name='ingredient']");
   ingredientData.value = data.id+"/"+data.ingredient.toLowerCase()+"/"+data.amount+"/"+data.unit;
   INGREDIENTS_CONTAINER.append(INGREDIENT);
}