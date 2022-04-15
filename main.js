function setup() {

  };
// player stats button takes you to team stats webpage
  document.getElementById("submit").onclick = function(){
    openwebpage("./assets/HTML/form.html");
  };
 // team stats button takes you to team stats webpage
 let seasons = document.getElementsByClassName("pets");
 [].forEach.call(seasons, function(season) {
 season.onclick = function(){
   openwebpage("./assets/HTML/pets.html#" + season.id);
 }
 });

// opens url in the same tab
function openwebpage(url){
  window.open(url, "_self");
}

setup();
