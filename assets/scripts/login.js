function openwebpage(url){
  window.open(url, "_self");
}

function setup() {
    document.getElementById("paw").onclick = function(){openwebpage("../../index.php")};

    let auth = document.getElementsByClassName("header-button");
    [].forEach.call(auth, function(btn){
      if(btn.id != "logout"){
        btn.onclick = function(){openwebpage(btn.id + ".php")}
      }
      else{
        btn.onclick = logout;
      }
    });
}

function logout(){
  eraseCookie("owner_id");
  document.location.reload();

}

setup();
