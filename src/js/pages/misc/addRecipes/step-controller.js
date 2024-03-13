const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS_AMOUNT = FORM_STEPS.length;

STEP_HANDLER.forEach(handler => {
   handler.addEventListener("click", (event) => {
      let action = handler.dataset.action;
      if(action != "finish")
      {
         event.preventDefault();
         stepHandler(action);
      }
   });
});

function stepHandler(trigger)
{
   let currentStep = parseInt(getCurrentStep());
   if(checkFields(currentStep))
   {
      if(trigger == "next")
      {
         return nextStep(currentStep); 
      }
   
      return previousStep(currentStep);
   }
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
   let isValid = true;
   let groups = FORM_STEPS[currentStep].querySelectorAll(".input-group");

   groups.forEach(group => {
      let invalidFields = group.querySelectorAll("*:invalid");

      if(invalidFields.length > 0)
      {
         isValid = false;
      }
   });

   return isValid;
}