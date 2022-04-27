let pets;

$.getJSON("https://cukeds.github.io/anthony/assets/json/pet.json", function(json) {
  pets = json;
});

let setup = function(){



    console.log(pets);

}


setup();
