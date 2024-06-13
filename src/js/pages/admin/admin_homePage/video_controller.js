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