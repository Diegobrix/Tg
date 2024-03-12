const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS_AMOUNT = FORM_STEPS.length;

STEP_HANDLER.forEach(handler => {
   handler.addEventListener("click", () => {
      changeStep(handler.dataset.action);
   });
});

function changeStep(trigger)
{
   let currentStep = parseInt(getCurrentStep());
   if(trigger == "next")
   {
      return nextStep(currentStep); 
   }
}

function nextStep(currentStep)
{
   if(currentStep < (STEPS_AMOUNT - 1))
   {
      clearSteps();
      currentStep += 1;
   }

   nextHeadStep(currentStep);
   nextFormStep(currentStep);
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