const STATUS_DISPLAY_CONTAINER = document.querySelector(".status_msg-container");
const STATUS_DISPLAY = document.querySelector(".status-displayer");
const BTN_SIGNUP_SUBMIT = document.getElementById("signup_form_submit");
const SIGNUP_FORM = document.getElementById("signup");

BTN_SIGNUP_SUBMIT.addEventListener("click", () => {
   let passInputs = SIGNUP_FORM.querySelectorAll("input[type='password']");
   
   if(passInputs[0].value == passInputs[1].value)
   {
      SIGNUP_FORM.submit();
   }
   else
   {
      STATUS_DISPLAY_CONTAINER.ariaHidden = 'false';
      STATUS_DISPLAY.innerHTML = "As senhas devem coincidir";
   }
});