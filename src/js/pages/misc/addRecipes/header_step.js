const HEADER_STEPS = document.querySelectorAll(".step_display");

function clearHeadSteps()
{
   HEADER_STEPS.forEach(step => {
      step.dataset.current = "false";
   });
}

function nextHeadStep(currentStep)
{
   HEADER_STEPS[currentStep].dataset.current = "true";
}