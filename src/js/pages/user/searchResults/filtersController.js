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
const HEALTH_CONDITION_OPTIONS = document.querySelectorAll('input[name="health_condition_option"]');

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

const RESULTS_CONTAINER = document.querySelector('.results_display-container');

window.addEventListener('DOMContentLoaded', () => {
   setTimeout(function() {
      getRecipes();
   }, 100);
});

function getRecipes()
{
   let recipes = getResults();
   localStorage.setItem('recipes', recipes);
   return;
}

function applyFilter(type, typeValue)
{
   let childrenRaw = [];
   JSON.parse(localStorage.getItem('recipes')).forEach(result => {
      let element = document.getElementById(result);
      childrenRaw.push(element);
   });

   let children = [];

   childrenRaw.forEach(result => {
      //console.log(type);
      if(type == 'category')
      {
         if(result.dataset.category.toLowerCase() == typeValue)
         {
            console.log(result.dataset.category);
            children.push(result);
         }
      }
      else if(type == 'condition')
      {
         if(result.dataset.condition.toLowerCase() == typeValue)
         {
            children.push(result);
         }
      }
   });

   console.log(children);
}

function selectRecipesByCategory(category)
{
   applyFilter('category', category);
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
   applyFilter('condition', condition);
}

function selectRecipes(type)
{
   let filter = type.split('_');
   let filterTypes = {'category': selectRecipesByCategory, 'video': selectRecipesByVideo, 'health': selectRecipesByCondition};
   let filterType = filter[0];

   filter.shift();
   let filterAdjusted = filter.join(' ');
   displayFilter(filterType, filterAdjusted);

   return filterTypes[filterType](filterAdjusted);
}

function getResults()
{
   let childrenRaw = RESULTS_CONTAINER.childNodes;
   let children = [];
   childrenRaw.forEach(child => {
      if(child.className == 'result')
      {
         let result = child.id;
         children.push(result);
      }
   });
   
   if(children.length > 0)
   {
      return JSON.stringify(children);
   }

   return null;
}
//#endregion

//#region Applied Filter Display
const FILTERS_CONTAINER = document.querySelector('.filters');
const FILTER_TEMPLATE = document.getElementById('filter-template');
function displayFilter(type, filter)
{
   let filtersAppliedCount = FILTERS_CONTAINER.childElementCount;
   if((filtersAppliedCount == 0) && (filter != 'all'))
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
      if(filter != 'all')
      {
         return addFilterButton(type, filter);
      }
      return;
   }

   if(filter != 'all')
   {
      return updateFilterButton(currentFilter, [type, filter])
   }

   return removeFilterButton(currentFilter, [type, filter]);
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
   else
   {
      if(type == 'video')
      {
         label = filter=='no'?'Sem vídeo':'Possui vídeo';
      }
      else if(type == 'health')
      {
         label = filter == 'pre'?'Pré-diabetes':'Diabetes';
      }
   }
      
   FILTER.dataset.type = type;
   FILTER_LABEL.innerHTML = label;
   FILTERS_CONTAINER.appendChild(FILTER);

   FILTER.addEventListener('click', function(){
      removeFilterButton(this, [type, filter]);
   });
}

function updateFilterButton(currentFilter, newValues)
{
   let filter = currentFilter.querySelector('.filter-label');
   
   let label;
   if(newValues[0] == 'category')
   {
      label = newValues[1];
   }
   else
   {
      if(newValues[0] == 'video')
      {
         label = newValues[1]=='no'?'Sem Vídeo':'Possui vídeo';
      }
      else if(newValues[0] == 'health')
      {
         label = newValues[1]=='pre'?'Pré-diabetes':'Diabetes';
      }
   }

   filter.innerHTML = label;
}

function removeFilterButton(filter, values)
{
   if(filter != null)
   {
      let type = filter.dataset.type;
      const DEFAULT_CHECKBOX = document.getElementById(type+'_all');

      let checkedCheckbox = values.join('_').split(' ').join('_');
      const CHECKED_CHECKBOX = document.getElementById(checkedCheckbox);

      CHECKED_CHECKBOX.checked = false;
      DEFAULT_CHECKBOX.checked = true;
      filter.remove();
   }
}

//#endregion
