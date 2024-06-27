const THUMB_FIGURE = document.querySelector(".img_thumb");
const THUMB = document.getElementById("thumb_preview");
const THUMB_INPUT = document.getElementById("recipeThumb");

THUMB_INPUT.addEventListener("change", (event) => {
   let selected = event.target.files[0];
   let selectedToUrl = URL.createObjectURL(selected);

   if(!selectedToUrl)
   {
     THUMB.src = "";
     return;
   }

   THUMB_FIGURE.dataset.empty = "false";
   THUMB.src = selectedToUrl;
});