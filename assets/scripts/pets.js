let pets;

$.getJSON("https://cukeds.github.io/anthony/assets/json/pet.json", function(json) {
  pets = json;
});

let cellbutton = function(id){
  rows = document.getElementsByClassName('pet_text');
  for (let text of rows){

    if (text.id != ""){
      for(let atr of Object.keys(pets[id])){
        if (text.id == atr) {
          if(text.id != "pet_image"){
            text.innerHTML = pets[id][atr];
          }
          else{
            let img = document.getElementById("p_image");
            img.src = "../images/" + pets[id][atr];
          }
        }
      }
    }
  }
}

let setup = function(){


  let table = document.getElementById("owners_table").getElementsByTagName('tbody')[0];
  if(pets != undefined){
    cellbutton(0);




    pets.forEach(p =>{
      let row = table.insertRow();
      for (let i = 0; i < 3; i++){
        let cell = row.insertCell();
        let text;
        switch(i){
          case 0:
            text = document.createTextNode(p.pet_owner);
            break;
          case 1:
            text = document.createTextNode(p.pet_name);
            break;
          case 2:
            text = document.createTextNode(p.pet_type);
            break;
        }
        cell.setAttribute('id', p.id);
        cell.onclick = function() {cellbutton(cell.id);};
        cell.appendChild(text);
      }
    });
  }
  else{
    setTimeout(() => {setup();}, 2)
  }

}


setup();
