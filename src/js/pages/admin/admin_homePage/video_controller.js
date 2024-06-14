
const ADD_VIDEO_HANDLER = document.getElementById('add_video-handler');
const VIDEO_MODAL = document.getElementById('video_modal');

VIDEO_MODAL.showModal();

ADD_VIDEO_HANDLER.addEventListener('click', () => {
   VIDEO_MODAL.showModal();
});

const VIDEO_INPUT = document.getElementById('flVideo');
VIDEO_INPUT.addEventListener('change', () => {
   const MODAL_STEPS = document.querySelectorAll('.video_modal-step');
   const STEPS_DECORATORS = document.querySelectorAll('.step_display');
   MODAL_STEPS[0].dataset.current = "false";
   MODAL_STEPS[1].dataset.current = "true";
   STEPS_DECORATORS[0].dataset.current = "false";
   STEPS_DECORATORS[1].dataset.current = "true";
});

const RECIPE_INPUT = document.querySelectorAll(".recipe input[type='checkbox']");
RECIPE_INPUT.forEach(recipe => {
   recipe.addEventListener('change', function(){
      if(this.checked)
      {
         RECIPE_INPUT.forEach(checkbox => {
            if(checkbox !== this)
            {
               checkbox.checked = false;
            }
         });
      }
   });
});

const BTN_SAVE_CHOICE = document.getElementById('btn_save');
BTN_SAVE_CHOICE.addEventListener('click', () => {
   let choosedId = null;
   let choosedLabel = null;
   RECIPE_INPUT.forEach(input => {
      if(input.checked)
      {
         choosedId = input.value;
         choosedLabel = input.dataset.label;
      }
   });

   saveChoice(choosedId, choosedLabel);
});

function saveChoice(choice, label = null)
{
   const RECIPE_INDICATOR_TEMPLATE = document.getElementById('recipe_indicator-template');  
   const RECIPE_INDICATOR_CONTAINER = document.querySelector('.recipe_indicator_container');
   let containerNodes = RECIPE_INDICATOR_CONTAINER.childNodes;
  
   containerNodes.forEach(node => {
      if((node.classList != undefined) && (node.classList.contains('choosed_recipe')))
      {
         node.remove();
      }
   });

   if(choice != null)
   {
      let indicator = RECIPE_INDICATOR_TEMPLATE.content.cloneNode(true).children[0];
      let input = indicator.querySelector('input');
      let textLabel = indicator.querySelector('span');

      input.value = choice;
      textLabel.innerHTML = label;

      indicator.addEventListener('click', function(){
         this.remove();
      });

      RECIPE_INDICATOR_CONTAINER.append(indicator);
   }
}

const SEND_VIDEO_HANDLER = document.getElementById('btn_send_video');
SEND_VIDEO_HANDLER.addEventListener('click', () => {
   sendVideo();
});

function sendVideo()
{
   
}