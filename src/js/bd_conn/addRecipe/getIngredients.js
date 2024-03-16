const params = {"teste":"testesr"};

const requestOptions = {
   method: "POST",
   body: JSON.stringify(params),
   Headers: {
      "Content-type": "application/json"
   }
};

fetch("http://192.168.0.13/tg/app/bd-conn-controller/pages/misc/getContent/getIngredients.php", requestOptions)
.then(response => response.json())
.then(data => console.log(data));