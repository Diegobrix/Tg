const FORM = document.getElementById("form");
const VIDEO_MODAL = document.getElementById("video_modal");
const CANCEL_VIDEO = document.getElementById("btn_video_cancel");
const VIDEO_INPUT = document.getElementById("flVideo");

export function verifyIngredients(ingredients)
{
   return ingredients.length > 0?true:false;
}

export function addVideo()
{
   VIDEO_MODAL.showModal();
   VIDEO_INPUT.addEventListener("change", () => { 
      FORM.submit();
      VIDEO_MODAL.close();
   });
}

CANCEL_VIDEO.addEventListener("click", () => {
   VIDEO_MODAL.close();
});