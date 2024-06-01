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

         selectRecipes(this.id);
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
         
         selectRecipes(this.id);
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
   let filterAdjusted = filter.join(' ');

   if(filterAdjusted != 'all')
   {
      displayFilter(filterType, filterAdjusted);
   }

   return filterTypes[filterType](filterAdjusted);
}
//#endregion

//#region Applied Filter Display
const FILTERS_CONTAINER = document.querySelector('.filters');
const FILTER_TEMPLATE = document.getElementById('filter-template');
function displayFilter(type, filter)
{
   let filtersAppliedCount = FILTERS_CONTAINER.childElementCount;
   
   if(filtersAppliedCount == 0)
   {
      return addFilterButton(type, filter);
   }

   let filtersApplied = FILTERS_CONTAINER.childNodes;
   let alreadyExists = false;
   let currentFilter = null;

   filtersApplied.forEach(applied => {
      if(applied.dataset.type == type)
      {
         alreadyExists = true;
         currentFilter = applied;
      }
   });

   if(alreadyExists == false)
   {
      return addFilterButton(type, filter);
   }

   return updateFilterButton(currentFilter, [type, filter]);
} 

function addFilterButton(type, filter)
{
   const FILTER = FILTER_TEMPLATE.content.cloneNode(true).children[0];
   const FILTER_LABEL = FILTER.querySelector('.filter-label');

   let label = filter;
   if(type == 'category')
   {
      let categories = JSON.parse(localStorage.getItem('categories'));
      categories.forEach(category => {
         if(category.toLowerCase() == filter)
         {
            label = category;
         }
      });
   }
      
   FILTER.dataset.type = type;
   FILTER_LABEL.innerHTML = label;
   FILTERS_CONTAINER.appendChild(FILTER);
}

function updateFilterButton(currentFilter, newValues)
{
   let filter = currentFilter.querySelector('.filter-label');
   
   let label;
   if((newValues[0] == 'category') || (newValues[0] == 'health'))
   {
      label = newValues[1];
   }
   else
   {
      label = 'Possui ' + newValues[1];
   }

   filter.innerHTML = label;
}

function removeFilterButton(filter)
{
   console.log('Deleting in 3, 2, 1...');
}

//#endregion
