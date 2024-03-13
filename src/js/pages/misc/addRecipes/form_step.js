const FORM_STEPS = document.querySelectorAll(".form_step");

function clearFormSteps()
{
   FORM_STEPS.forEach(step => {
      step.dataset.current = "false";
   });
}

function formChangeStep(currentStep)
{
   FORM_STEPS[currentStep].dataset.current = "true";
}