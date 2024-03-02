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

