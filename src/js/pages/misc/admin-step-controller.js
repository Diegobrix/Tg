const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS_DIPLAY_HEADER = document.querySelectorAll(".step_display");

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
   let stepsAmount = STEPS_DIPLAY_HEADER.length;
   if(currentStep < (stepsAmount - 1))
   {
      clearSteps();
      currentStep += 1;
   }

   STEPS_DIPLAY_HEADER[currentStep].dataset.current = "true";
}

function getCurrentStep()
{
   let current;
   STEPS_DIPLAY_HEADER.forEach((step) => {
      if(step.dataset.current == "true")
      {
         current = step.dataset.step;
      }
   });

   return current;
}

function clearSteps()
{
   STEPS_DIPLAY_HEADER.forEach(step => {
      step.dataset.current = "false";
   });
}