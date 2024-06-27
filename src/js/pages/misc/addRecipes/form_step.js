const FORM_STEPS = document.querySelectorAll(".form_step");

export function clearFormSteps()
{
   FORM_STEPS.forEach(step => {
      step.dataset.current = "false";
   });
}

export function formChangeStep(currentStep)
{
   FORM_STEPS[currentStep].dataset.current = "true";
}