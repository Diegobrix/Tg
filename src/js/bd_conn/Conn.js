export default class Conn
{
   constructor(url)
   {
      this.url = url;
   }

   async fetchData(endpoint, data, method = "POST")
   {
      const url = new URL(endpoint, this.url);

      if((data) && (method === "POST"))
      {
         Object.keys(data).forEach(key => {
            url.searchParams.append(key, params[key]);
         });
      }

      const requestOptions = {
         method: method,
         headers: {
            'Content-Type': 'application/json'
         }
      };

      if(method !== "POST")
      {
         requestOptions.body = JSON.stringify(data);
      }

      try
      {
         const response = await fetch(url, requestOptions);
         if(!response.ok)
         {
            throw new Error('Falha ao buscar os dados');
         }
         
         return await response.json();
      }
      catch(e)
      {
         console.log(e);
         throw e;
      }
   }
}