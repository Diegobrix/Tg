const HEADER_STEPS = document.querySelectorAll(".step_display");

export function clearHeadSteps()
{
   HEADER_STEPS.forEach(step => {
      step.dataset.current = "false";
   });
}

export function headerChangeStep(currentStep)
{
   HEADER_STEPS[currentStep].dataset.current = "true";
   HEADER_STEPS[currentStep + 3].dataset.current = "true";
}