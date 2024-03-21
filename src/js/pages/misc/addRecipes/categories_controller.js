const CATEGORIES_SELECT_HANDLER = document.getElementById("categorySelectHandler");
const OPTIONS_CONTAINER = document.getElementById("categoryOptionsContainer");
const SELECT_DISPLAYER = document.getElementById("selectedCategory");
const CATEGORIES = document.querySelectorAll(".category");
const ADD_CATEGORY_MODAL_HANDLER = document.querySelector(".btn_add_category");
const ADD_CATEGORY_MODAL = document.getElementById("add_category-modal");

CATEGORIES_SELECT_HANDLER.addEventListener("change", () => {
   showCategories(CATEGORIES_SELECT_HANDLER.checked);
});

CATEGORIES.forEach(category => {
   category.addEventListener("change", () => {
      if(category.checked)
      {
         SELECT_DISPLAYER.innerText = "";
         SELECT_DISPLAYER.innerText = category.dataset.label; 

         showCategories(false);
      }
   });
});

function showCategories(state)
{
   state?OPTIONS_CONTAINER.ariaHidden = false:OPTIONS_CONTAINER.ariaHidden = true;
   CATEGORIES_SELECT_HANDLER.checked = state;
   return !state;
}

ADD_CATEGORY_MODAL_HANDLER.addEventListener("click", () => {
   ADD_CATEGORY_MODAL.showModal();
});