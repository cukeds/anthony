function setup() {
  document.getElementById("paw").onclick = function(){openwebpage("index.php")};

  };
// player stats button takes you to team stats webpage
  document.getElementById("submit").onclick = function(){
    openwebpage("./assets/HTML/form.php");
  };
 // team stats button takes you to team stats webpage
 let seasons = document.getElementsByClassName("pets");
 [].forEach.call(seasons, function(season) {
 season.onclick = function(){
   openwebpage("./assets/HTML/pets.php#" + season.id);
 }
 });

// opens url in the same tab
function openwebpage(url){
  window.open(url, "_self");
}



setup();
