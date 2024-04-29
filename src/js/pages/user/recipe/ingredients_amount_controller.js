const INGREDIENTS_AMOUNT_HANDLER = document.querySelectorAll(".amount-handler");

INGREDIENTS_AMOUNT_HANDLER.forEach((handler) => {
   handler.addEventListener('click', () => {
      let targetAction = handler.dataset.action;
      handleAction(targetAction);
   });

});

let target = 1;
function handleAction(action)
{
   if(action == "plus")
   {
      if(target < 1)
      {
         target = 0;
      }

      target += 1;
      return multiplyIngedients(target);
   }

   let amountToSub = 1;
   if(target == 1)
   {
      amountToSub = .5;
   }

   target -= amountToSub;
   return reduceIngedients(target);
}

function multiplyIngedients(amount)
{
   changeIngredientsAmount(amount);
   changeDisplay(amount);
}

function reduceIngedients(amount)
{
   changeIngredientsAmount(amount);
   changeDisplay(amount);
}

const INGREDIENTS_AMOUNT_DISPLAY = document.querySelector(".amount-display");
function changeDisplay(amount)
{
   return INGREDIENTS_AMOUNT_DISPLAY.dataset.amount = amount;
}

const INGREDIENTS_AMOUNT = document.querySelectorAll(".ingredient-amount");

let originalIngredientsAmount = [];
INGREDIENTS_AMOUNT.forEach((ingredient) => {
   let amount = Number.parseFloat(ingredient.querySelector(".amount").innerHTML);
   originalIngredientsAmount.push(amount);
});

function changeIngredientsAmount(newAmount)
{
   for(let i = 0; i < INGREDIENTS_AMOUNT.length; i++)
   {
      let ingredientAmount = INGREDIENTS_AMOUNT[i].querySelector('.amount');
      ingredientAmount.innerText = (originalIngredientsAmount[i] * newAmount);
   }
}