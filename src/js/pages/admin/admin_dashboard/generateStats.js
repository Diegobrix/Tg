const FILE_PATH = "../../../app/pages/admin/data/dashboard_data/datasets/";

const urls = [
  {"legend": "recipes" , "file": FILE_PATH + "recipes.json"}, 
  {"legend": "categories" , "file": FILE_PATH + "categories.json"}, 
  {"legend": "videos" , "file": FILE_PATH + "videos.json"}, 
  {"legend": "ingredients" , "file": FILE_PATH + "ingredients.json"}
];

const GET_JSON = async function(url){
   try {
      const response = await fetch(url);
  
      if (!response.ok || typeof response.json !== 'function') {
        throw new Error(`Erro ao carregar o arquivo JSON. Status: ${response ? response.status : 'desconhecido'}`);
      }
  
      return response.json();
    } catch (e) {
      console.error(`Erro ao carregar o arquivo JSON (${url}):`, e);
      throw e;
    }
};

async function describeJson(urls)
{
  let jsons = [];
  for(let i = 0; i < urls.length; i++)
  {
    let json = await GET_JSON(urls[i]['file']);

    if(json)
    {
      let jsonSize = Object.keys(json).length;

      jsons.push({'id':urls[i]['legend'],'amount':jsonSize});
    }
  }

  return jsons;
}

function getBigger(jsons, bigger, current)
{
  if(current < jsons.length)
  {
    if((bigger == null) || (bigger.amount < jsons[current].amount))
    {
      bigger = jsons[current];
      current += 1;

      return getBigger(jsons, bigger, current);
    }

    current += 1;
    return getBigger(jsons, bigger, current);
  }

  return bigger;
}

describeJson(urls)
  .then(response => {
    let jsons = [];
    for(let r of response)
    {
      jsons.push(r);
    }

    processJsons(jsons)
  });

function processJsons(jsons)
{
  const STAT_BARS = document.querySelectorAll(".stat_bar");
  let bigger = getBigger(jsons, null, 0);

  console.log(bigger);

  for(let json of jsons)
  {
    STAT_BARS.forEach(item => {
      let barId = item.dataset.legend;
      if(barId == json.id)
      {
        item.setAttribute("style", "--amount: "+json.amount +";");
      }
    });
  }
}