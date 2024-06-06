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

function getRecipes()
{
   console.log();
   let recipes = getResults();
   localStorage.setItem('recipes', recipes);
   return;
}

function applyFilter(type, typeValue) {
   getRecipes();
   let childrenOriginal = [];
   // if(localStorage.getItem('filteredRecipes') != null)
   // {
   //    JSON.parse(localStorage.getItem('filteredRecipes')).forEach(result => {
   //       let element = document.getElementById(result);
   //       childrenOriginal.push(element);
   //    });   
   // }
   // else
   // {
   //    JSON.parse(localStorage.getItem('recipes')).forEach(result => {
   //       let element = document.getElementById(result);
   //       childrenOriginal.push(element);
   //    });
   // }
   localStorage.removeItem('filteredRecipes');
   localStorage.removeItem('hideRecipes');

   let currentChildren = [];
   RESULTS_CONTAINER.childNodes.forEach(result => {
      if (result.classList != undefined && result.classList.contains('result')) {
         currentChildren.push(result);
      }
   });

   let filteredRecipes = localStorage.getItem('filteredRecipes') ? localStorage.getItem('filteredRecipes').split(',') : [];
   let hideRecipes = localStorage.getItem('hideRecipes') ? localStorage.getItem('hideRecipes').split(',') : [];

   if (type === 'category') {
      hideRecipes = hideRecipes.filter(id => !filteredRecipes.includes(id));
      filteredRecipes = [];
   } else if (type === 'condition') {
      hideRecipes = hideRecipes.filter(id => !filteredRecipes.includes(id));
      filteredRecipes = [];
   }

   currentChildren.forEach(recipe => {
      if (type === 'category' && recipe.dataset.category.toLowerCase() === typeValue) {
         if (!filteredRecipes.includes(recipe.id)) {
            filteredRecipes.push(recipe.id);
         }
      } else if (type === 'condition' && recipe.dataset.condition.toLowerCase() === typeValue) {
         if (!filteredRecipes.includes(recipe.id)) {
            filteredRecipes.push(recipe.id);
         }
      } else {
         hideRecipes.push(recipe.id);
      }
   });

   currentChildren.forEach(recipe => {
      if(typeValue === 'all')
      {
         if(type === 'category')
         {
            if(!filteredRecipes.includes(recipe.id))
            {
               filteredRecipes.push(recipe.id);
            }
         }
         else if(type === 'condition')
         {
            if(!filteredRecipes.includes(recipe.id))
            {
               filteredRecipes.push(recipe.id);
            }
         }
      }
   });

   console.log(filteredRecipes);
   filteredRecipes.forEach(filtered => {
      let recipe = document.getElementById(filtered);
      console.log(recipe);

      if(recipe.classList.contains('hide'))
      {
         recipe.classList.remove('hide');
      }
   });

   let hides = hideRecipes.filter(hide => !filteredRecipes.includes(hide));
   hides.forEach(hide => {
      let recipe = document.getElementById(hide);
      recipe.classList.add('hide');
   });

   localStorage.setItem('filteredRecipes', filteredRecipes.join(','));
   localStorage.setItem('hideRecipes', hideRecipes.join(','));
   // console.log('Receitas Visíveis');
   // console.log(filteredRecipes);
   // console.log('===============');
   // console.log('Receitas Escondidas');
   // console.log(hides);
   // console.log('===============');
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
