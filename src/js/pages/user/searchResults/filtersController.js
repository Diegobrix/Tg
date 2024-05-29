//#region Handling Responsivity

window.addEventListener('DOMContentLoaded', () => {
   if(window.innerWidth < 1440)
   {
      return FILTER_SETTINGS_CONTAINER.dataset.mobile = 'true';
   }

   FILTER_SETTINGS_CONTAINER.dataset.mobile = 'false';
});

window.addEventListener('resize', () => {
   if(window.innerWidth < 1440)
      {
         return FILTER_SETTINGS_CONTAINER.dataset.mobile = 'true';
      }
   
      FILTER_SETTINGS_CONTAINER.dataset.mobile = 'false';
});
//#endregion

const FILTER_SETTINGS_HANDLER = document.querySelector('.filter_controller-handler');
const FILTER_SETTINGS_CONTAINER = document.querySelector('.filters_setting-container');

FILTER_SETTINGS_HANDLER.addEventListener('click', () => {
   let currentState = FILTER_SETTINGS_CONTAINER.ariaHidden; 
   FILTER_SETTINGS_CONTAINER.ariaHidden = currentState ==='true'?'false':'true';
});

//#region Unique Filter Settings
const HAS_VIDEO_OPTIONS = document.querySelectorAll('input[name="video_option"]');
const HEALTH_CONDITION_OPTIONS = document.querySelectorAll('input[name="heath_condition_option"]');

HAS_VIDEO_OPTIONS.forEach(videoOption => {
   videoOption.addEventListener('change', function(){
      if(this.checked)
      {
         HAS_VIDEO_OPTIONS.forEach(checkbox => {
            if(checkbox !== this)
            {
               checkbox.checked = false;
            }
         });
      }
   });
});

HEALTH_CONDITION_OPTIONS.forEach(healthOption => {
   healthOption.addEventListener('change', function(){
      if(this.checked)
      {
         HEALTH_CONDITION_OPTIONS.forEach(checkbox => {
            if(checkbox !== this)
            {
               checkbox.checked = false;
            }
         });
      }
   });
});
//#endregion