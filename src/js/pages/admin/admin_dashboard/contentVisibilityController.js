const SEARCH_INPUT = document.getElementById("txtSearchRecipe");
const CONTENT_WRAPPER = document.querySelectorAll(".content");

let titles = [];
CONTENT_WRAPPER.forEach(content => {
   const TITLE = content.querySelector(".content_title").innerHTML;
   titles.push(TITLE);
});

console.log(titles);

SEARCH_INPUT.addEventListener("input", () => {
   let inputVal = SEARCH_INPUT.value;
   for(let i = 0; i < titles.length; i++)
   {
      let isVisible = titles[i].toLowerCase().includes(inputVal.toLowerCase());
      CONTENT_WRAPPER[i].ariaHidden = isVisible?'false':'true';
   }
})