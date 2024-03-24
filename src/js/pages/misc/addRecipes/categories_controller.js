import sendData from "../../../bd_conn/addRecipe/sendData.js";

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

const ADD_CATEGORY_SENDER = document.getElementById("add_category_sender");
const ADD_CATEGORY_INPUT = document.getElementById("add_category_input");

ADD_CATEGORY_SENDER.addEventListener("click", () => {
   let val = ADD_CATEGORY_INPUT.value;
   let pattern = /\S/g;
   
   if(val.match(pattern))
   {
      insertItem(val);
   }
});

function insertItem(data)
{
   let category = {"category_title":data};
   let response = sendData("http://127.0.0.1/tg/app/bd-conn-controller/pages/misc/addContent/addCategoryDB.php", category)
   .then(resp => {
      addOption(resp);
   });

   closeAddModal();
}

function closeAddModal()
{
   ADD_CATEGORY_INPUT.value = "";
   ADD_CATEGORY_MODAL.close();
}

const OPTION_TEMPLATE = document.querySelector(".category_template");
function addOption(serverResponse)
{
   let data = serverResponse.data;
   let id = "category-"+ data.id;
   const CATEGORY_WRAPPER = OPTION_TEMPLATE.content.cloneNode(true).children[0];

   const CATEGORY_INPUT = CATEGORY_WRAPPER.querySelector(".category");
   CATEGORY_INPUT.value = data.id;
   CATEGORY_INPUT.id = id;
   CATEGORY_INPUT.dataset.label = data.category;
   CATEGORY_INPUT.checked = true;

   SELECT_DISPLAYER.innerText = data.category;

   const CATEGORY_LABEL = CATEGORY_WRAPPER.querySelector("label");
   CATEGORY_LABEL.setAttribute("for", id);
   CATEGORY_LABEL.textContent = data.category;

   OPTIONS_CONTAINER.append(CATEGORY_WRAPPER);
}