function setup() {
  document.getElementById("paw").onclick = function(){openwebpage("index.php")};

  let auth = document.getElementsByClassName("header-button");
  [].forEach.call(auth, function(btn){
    if(btn.id != "logout"){
      btn.onclick = function(){openwebpage("./assets/HTML/" + btn.id + ".php")}
    }
    else{
      btn.onclick = logout;
    }
  });
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


function logout(){
  eraseCookie("owner_id");
  document.location.reload();

}

setup();
