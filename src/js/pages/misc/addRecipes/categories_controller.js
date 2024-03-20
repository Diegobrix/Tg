const CATEGORIES_SELECT_HANDLER = document.getElementById("categorySelectHandler");
const OPTIONS_CONTAINER = document.getElementById("categoryOptionsContainer");

var state = true;
CATEGORIES_SELECT_HANDLER.addEventListener("change", () => {
   OPTIONS_CONTAINER.ariaHidden = !state;
   state = !state;
});