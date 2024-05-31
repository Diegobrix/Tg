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

const FILTERS_SETTINGS_THUMBS = document.querySelectorAll('.filters_setting-container .setting-thumb');

FILTERS_SETTINGS_THUMBS.forEach(thumb => {
   thumb.addEventListener('click', () => {
      let parent = thumb.parentNode;
      let filterContainer = parent.querySelector('.options-container');
      let chevron = parent.querySelector('.chevron');

      if(chevron.classList.contains('close'))
      {
         chevron.classList.replace('close', 'open');
      }
      else
      {
         chevron.classList.replace('open', 'close');
      }

      let currentState = filterContainer.ariaExpanded;
      return filterContainer.ariaExpanded = currentState == 'false'?'true':'false';
   });
});

//#region Applying Filters
function selectRecipesByCategory(category)
{
   return category!='all'?category:JSON.parse(localStorage.getItem('categories'));
}

function selectRecipesByAuthor(author)
{
   return author;
}

function selectRecipesByVideo(video)
{
   return video;
}

function selectRecipesByCondition(condition)
{
   return condition;
}

function selectRecipes(type)
{
   let filter = type.split('_');
   let filterTypes = {'category': selectRecipesByCategory, 'video': selectRecipesByVideo, 'health': selectRecipesByCondition};
   let filterType = filter[0];

   filter.shift();
   return filterTypes[filterType](filter.join(' '));
}
//#endregion