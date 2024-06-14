const VIDEO_MODAL = document.getElementById('video_modal');
const VIDEOS = document.querySelectorAll('.video');

VIDEOS.forEach(video => {
   video.addEventListener('click', function(){
      VIDEO_MODAL.showModal();
      generateModalData(this);
   });
});

const FRAMES = document.querySelectorAll('iframe');
FRAMES.forEach(frm => {
   var frmDocument = frm.contentDocument || frm.contentWindow.document;
   var conteudo = frmDocument.body;

   var video = conteudo.querySelector('video');
   if(video != null)
   {
      video.removeAttribute('controls');
      video.removeAttribute('autoplay');
   }
});

function generateModalData(video)
{
   let id = video.dataset.id;
   let title = video.dataset.title;
   let description = video.dataset.description;
   let url = video.dataset.url;
   
   if(video.dataset.recipe != undefined)
   {
      let recipe = video.dataset.recipe;
   }
   
   const VIDEO_TITLE = VIDEO_MODAL.querySelector('.video_title');
   VIDEO_TITLE.innerHTML = title;
}