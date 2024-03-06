const STEP_HANDLER = document.querySelectorAll(".step-handler");
const STEPS = document.querySelectorAll(".step");

STEP_HANDLER.forEach(handler => {
   handler.addEventListener("click", () => {
      handleSteps(handler.dataset.action);
   });
});

function handleSteps(trigger)
{
   let currentStep = getCurrentStep();

   if(trigger == "next")
   {
      goNextStep(STEPS, currentStep);
   }
}

function getCurrentStep()
{
   let current;

   STEPS.forEach(step => {
      if(step.dataset.current == "true")
      {
         current = step.dataset.step;
      }
   });

   return current;
}

function goNextStep(steps, currentStep)
{
   let nextStep = Number(currentStep) + 1;
   
   if(nextStep < steps.length)
   {
      steps[currentStep].dataset.current = "false";
      steps[nextStep].dataset.current = "true";
   }
}

function goPrevStep(steps, currentStep)
{
   let prevStep = Number(currentStep) - 1;
   
   if(prevStep > 0)
   {
      steps[currentStep].dataset.current = "false";
      steps[prevStep].dataset.current = "true";
   }
}