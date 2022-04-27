let pets;

$.getJSON("https://cukeds.github.io/anthony/assets/json/pet.json", function(json) {
  pets = json;
});

let setup = function(){

  if(pets != undefined){
    console.log(pets);
  }else{
    setTimeout(() => {console.log(pets); }, 2000);
  }

}


setup();
