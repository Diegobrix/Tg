const VIDEO_MODAL = document.getElementById('video_modal');
const VIDEOS = document.querySelectorAll('.video');

VIDEOS.forEach(video => {
   console.log(video.dataset.recipe);
   video.addEventListener('click', function(){
      VIDEO_MODAL.showModal();
      generateModalData(this);
   });
});

const FRAMES = document.querySelectorAll('iframe');
FRAMES.forEach(frm => {
   removeVideoAttributes(frm);
});

function generateModalData(video)
{
   console.log(video.dataset.recipe);
   let id = video.dataset.id;
   let title = video.dataset.title;
   let description = video.dataset.description;
   let url = video.dataset.url;
   
   let recipe = null;
   if(video.dataset.recipe != undefined)
   {
      recipe = video.dataset.recipe;
   }

   VIDEO_MODAL.childNodes.forEach(child => {
      if((child.classList != undefined) && (child.classList.contains('link')))
      {
         child.remove();
      }
   });
   
   const VIDEO_TITLE = VIDEO_MODAL.querySelector('.video_title');
   const VIDEO_DISPLAYER = VIDEO_MODAL.querySelector('.video_display');
   const VIDEO_DESCRIPTION = VIDEO_MODAL.querySelector('.video_description');

   if(recipe != null)
   {
      const RECIPE_LINK = document.createElement('a');
      RECIPE_LINK.classList.add('link');
      RECIPE_LINK.href = './app/pages/user/recipe.php?id='+recipe;
      RECIPE_LINK.innerText = 'Veja a Receita Completa aqui!';

      VIDEO_MODAL.append(RECIPE_LINK);
   }
   
   VIDEO_TITLE.innerHTML = title;
   VIDEO_DISPLAYER.src = './assets/videos/'+url;
   VIDEO_DESCRIPTION.innerHTML = description;
}

function removeVideoAttributes(frame, controls = false, autoplay = false)
{
   var frmDocument = frame.contentDocument || frame.contentWindow.document;
   var conteudo = frmDocument.body;

   var video = conteudo.querySelector('video');
   if(video != null)
   {
      if(controls == false)
      {
         video.removeAttribute('controls');
      }
      if(autoplay == false)
      {
         video.removeAttribute('autoplay');
      }
   }
}