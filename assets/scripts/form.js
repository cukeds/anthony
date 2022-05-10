function openwebpage(url){
  window.open(url, "_self");
}

function setup() {
    document.getElementById("paw").onclick = function(){openwebpage("../../index.php")};
}

setup();
