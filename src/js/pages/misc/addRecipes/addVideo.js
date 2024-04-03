const FORM = document.getElementById("form");
const VIDEO_MODAL = document.getElementById("video_modal");
const CANCEL_VIDEO = document.getElementById("btn_video_cancel");
const VIDEO_INPUT = document.getElementById("flVideo");
const VIDEO_MODAL_STEPS = document.querySelectorAll(".video_modal-step");

export function verifyIngredients(ingredients)
{
   return ingredients.length > 0?true:false;
}

export function addVideo()
{
   VIDEO_MODAL.showModal();
   VIDEO_INPUT.addEventListener("change", () => { 
      goNextStep(0);
   });
}

CANCEL_VIDEO.addEventListener("click", () => {
   VIDEO_MODAL.close();
});

function handlerSteps()
{
   VIDEO_MODAL_STEPS.forEach(step => {
      step.dataset.current = "false";
   });
}

function goNextStep(currentStep)
{
   handlerSteps();
   VIDEO_MODAL_STEPS[currentStep + 1].dataset.current = "true";
}

function goPrevStep(currentStep)
{
   handlerSteps();
   VIDEO_MODAL_STEPS[currentStep - 1].dataset.current = "true";
}