const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS_AMOUNT = FORM_STEPS.length;

STEP_HANDLER.forEach(handler => {
   handler.addEventListener("click", (event) => {
      let action = handler.dataset.action;
      if(action != "finish")
      {
         stepHandler(action);
         event.preventDefault();
      }
   });
});

function stepHandler(trigger)
{
   let currentStep = parseInt(getCurrentStep());
   if(trigger == "next")
   {
      if(checkFields(currentStep))
      {
         return nextStep(currentStep);
      } 
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
   HEADER_STEPS.forEach((step) => {
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