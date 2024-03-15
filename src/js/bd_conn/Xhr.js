export default class XHRConnection {
   constructor(url) {
      this.url = url;
      this.xhr = new XMLHttpRequest();
      this.method = "POST";
   }

   post(url, data, callback) {
      const endpoint = this.url  + url;

       this.xhr.open(this.method, endpoint, true);

       this.xhr.onload = function() {
           if (this.xhr.status >= 200 && this.xhr.status < 300) {
               callback(null, this.xhr.responseText);
           } else {
               callback('Erro ao devolver a resposta ao usuário', null);
           }
       }.bind(this);

       this.xhr.onerror = function() {
           callback('Falha na requisição', null);
       };

       this.xhr.send(JSON.stringify(data));
   }
}