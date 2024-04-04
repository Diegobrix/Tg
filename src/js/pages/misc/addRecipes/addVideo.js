const FORM = document.getElementById("form");
const VIDEO_MODAL = document.getElementById("video_modal");
const CANCEL_VIDEO = VIDEO_MODAL.querySelectorAll(".btn_video_cancel");
const VIDEO_INPUT = document.getElementById("flVideo");
const VIDEO_MODAL_STEPS = document.querySelectorAll(".video_modal-step");
const MODAL_STEPS_DISPLAYS = VIDEO_MODAL.querySelectorAll(".step_display");

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

CANCEL_VIDEO.forEach(btn => {
   btn.addEventListener("click", () => {
      VIDEO_MODAL.close();
      FORM.submit();
   });
});

function handlerSteps()
{
   VIDEO_MODAL_STEPS.forEach(step => {
      step.dataset.current = "false";
   });

   MODAL_STEPS_DISPLAYS.forEach(step => {
      step.dataset.current = "false";
   });
}

function goNextStep(currentStep)
{
   handlerSteps();
   VIDEO_MODAL_STEPS[currentStep + 1].dataset.current = "true";
   MODAL_STEPS_DISPLAYS[currentStep + 1].dataset.current = "true";
}