const DESKTOP_STEP = document.querySelectorAll(".steps-wrapper > .step");

export function desktopChangeStep(currentStep)
{
   clearSteps();

   DESKTOP_STEP[currentStep].dataset.current = "true";
   DESKTOP_STEP.forEach(step => {
      if(Number(step.dataset.step) < currentStep)
      {
         step.dataset.already = "true";
      }
   });
}

function clearSteps()
{
   DESKTOP_STEP.forEach(step => {
      step.dataset.current = "false";
      step.dataset.already = "false";
   });
}