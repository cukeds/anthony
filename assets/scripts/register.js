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

    document.getElementById("sors").addEventListener("change", function(){staff_change(document.getElementById("sors").value)})
    staff_change(document.getElementById("sors").value);
}

function staff_change(isstaff){
  if(isstaff == 0){
    document.getElementById("awork").classList.add("hidden");
    document.getElementById("syear").classList.remove("hidden");
  }else{
      document.getElementById("awork").classList.remove("hidden");
      document.getElementById("syear").classList.add("hidden");
  }
}



function logout(){
  eraseCookie("owner_id");
  document.location.reload();

}
setup();
