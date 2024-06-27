import {clearHeadSteps, headerChangeStep} from "./header_step.js";
import {clearFormSteps, formChangeStep} from "./form_step.js";
import {verifyIngredients, addVideo} from "./addVideo.js";
import {desktopChangeStep} from "./desktop_step.js";

const FORM_STEPS = document.querySelectorAll(".form_step");
const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS_AMOUNT = FORM_STEPS.length;

STEP_HANDLER.forEach(handler => {
   handler.addEventListener('click', (event) => {
      let action = handler.dataset.action;
      if(action != 'finish')
      {
         let currentStep = parseInt(getCurrentStep());
         return stepHandler(action, event, currentStep);
      }

      return verifyIngredientsStep();
   });
});

function stepHandler(action, trigger, currentStep)
{
   if(action == 'next')
   {
      let actionVerifyResult = actionVerify(currentStep);
      if(actionVerifyResult == true)
      {
         return nextStep(currentStep);
      }

      return actionVerifyResult!=null?window.alert(actionVerifyResult):'';
   }
}

//#region Step Actions
function nextStep(currentStep)
{
   if(currentStep < (STEPS_AMOUNT - 1))
   {
      clearSteps();
      currentStep += 1;
   }

   updateStep(currentStep);
}

function prevStep(currentStep)
{
   if(currentStep > 0)
   {
      clearSteps();
      currentStep -= 1;
   }
   
   updateStep(currentStep);
}
//#endregion
//#region Step Controller
function clearSteps()
{
   clearHeadSteps();
   clearFormSteps();
}

function updateStep(currentStep)
{
   formChangeStep(currentStep);
   headerChangeStep(currentStep);
   desktopChangeStep(currentStep);
}

function getCurrentStep()
{
   let current;
   FORM_STEPS.forEach((step) => {
      if(step.dataset.current == "true")
      {
         current = step.dataset.step;
      }
   });

   return current;
}
//#endregion

function actionVerify(currentStep)
{
   let current = currentStep.toString();
   let verifies = {0:verifyWayToDoStep, 1:verifyStep, 2:verifyCategoryStep};
   return Object.keys(verifies).includes(current)?verifies[current](current):null;
}

//#region Step Verify
function verifyWayToDoStep(currentStep)
{
   if(checkStepFields(currentStep))
   {
      let wayToDoContainer = document.querySelector('.ways_to_do-container'); 

      if((wayToDoContainer.childElementCount - 1) > 0)
      {
         return true;
      }

      return 'O modo de preparo da receita DEVE possuir ao menos 1 etapa!';
   }

   return null;
}

function verifyCategoryStep(currentStep)
{
   if(verifyStep(currentStep))
   {
      let categoryOptions = document.querySelectorAll('#categoryOptionsContainer .category');
      let isSelected = false;

      for (var i = 0; i < categoryOptions.length; i++) {
         if (categoryOptions[i].checked) {
            isSelected = true;
            break;
         }
      }

      if(!isSelected)
      {
         return 'Por favor, selecione uma categoria.';
      }

      return true;
   }

   return null;
}

function verifyIngredientsStep()
{
   let ingredients = document.querySelectorAll(".ingredients .ingredient");
   if(verifyIngredients(ingredients))
   {
      return addVideo();
   }

   return 'Pelo menos 1 ingrediente DEVE ser selecionado.';
}

function verifyStep(currentStep)
{
   return checkStepFields(currentStep)?true:null;
}

function checkStepFields(currentStep)
{
   let groups = [...FORM_STEPS[currentStep].querySelectorAll(".input-group *:required")];
   let inputsValid = groups.every(input => input.reportValidity());

   return inputsValid?true:false;
}
//#endregion