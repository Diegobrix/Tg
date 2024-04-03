import {clearHeadSteps, headerChangeStep} from "./header_step.js";
import {clearFormSteps, formChangeStep} from "./form_step.js";
import {verifyIngredients, addVideo} from "./addVideo.js";

const FORM_STEPS = document.querySelectorAll(".form_step");
const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS_AMOUNT = FORM_STEPS.length;

addVideo();

STEP_HANDLER.forEach(handler => {
   handler.addEventListener("click", (event) => {
      let action = handler.dataset.action;
      if(action != "finish")
      {
         stepHandler(action, event);
         event.preventDefault();
      }
      else
      {
         event.preventDefault();
         event.stopPropagation();

         let ingredients = document.querySelectorAll(".ingredients .ingredient");
         
         if(verifyIngredients(ingredients))
         {
            return addVideo();
         }

         return alert('Pelo menos 1 ingrediente DEVE ser selecionado .');
      }
   });
});

function stepHandler(trigger, event)
{
   let currentStep = parseInt(getCurrentStep());
   if(trigger == "next")
   {
      if(currentStep > 0)
      {
         let categoryOptions = document.querySelectorAll('#categoryOptionsContainer .category');
         let isSelected = false;

         for (var i = 0; i < categoryOptions.length; i++) {
            if (categoryOptions[i].checked) {
               isSelected = true;
               break;
            }
         }

         if (!isSelected) {
            event.preventDefault();
            alert('Por favor, selecione uma categoria.');
            return;
         }
      }
      
      if(checkFields(currentStep))
      {
         return nextStep(currentStep);
      }
      return;
   }   
   

   return previousStep(currentStep);
}

function nextStep(currentStep)
{
   if(currentStep < (STEPS_AMOUNT - 1))
   {
      clearSteps();
      currentStep += 1;
   }

   formChangeStep(currentStep);
   headerChangeStep(currentStep);
}

function previousStep(currentStep)
{
   if(currentStep > 0)
   {
      clearSteps();
      currentStep -= 1;
   }

   formChangeStep(currentStep);
   headerChangeStep(currentStep);
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

function clearSteps()
{
   clearHeadSteps();
   clearFormSteps();
}

function checkFields(currentStep)
{
   let groups = [...FORM_STEPS[currentStep].querySelectorAll(".input-group *:required")];
   let inputsValid = groups.every(input => input.reportValidity());

   return inputsValid?true:false;
}