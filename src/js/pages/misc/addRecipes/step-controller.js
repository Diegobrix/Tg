const STEP_HANDLER = document.querySelectorAll(".step-handler");
const FORM_STEPS = document.querySelectorAll(".form_step");

const STEPS_AMOUNT = 0;

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
   if(currentStep < STEPS_AMOUNT)
   {
      clearSteps();
      currentStep += 1;
   }

   nextHeadStep(currentStep);
   //Mais
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
   //Mais
}