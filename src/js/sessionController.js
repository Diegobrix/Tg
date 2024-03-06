window.addEventListener("beforeunload", function(event) {
   var xhr = new XMLHttpRequest();
   xhr.open('GET', '../../../conf/logout.php');
   xhr.send();   
});