let student_pets;
let staff_pets;
let pets;

function openwebpage(url){
  window.open(url, "_self");
}

window.addEventListener("load", function(){
  document.getElementById("staff_or_student").addEventListener("change", change_sors);
  document.getElementById("paw").onclick = function(){openwebpage("../../index.php")};

})


$.getJSON("../json/students.json", function(json) {
  student_pets = json;
});

$.getJSON("../json/staffpets.json", function(json) {
  staff_pets = json;
});


function change_sors(){
  let sors = document.getElementById("staff_or_student").value;
  if(sors == "student"){
    pets = student_pets;
  }
  else{
    pets = staff_pets;
  }
  change_pets();
}

// This function here changes the PET TEMPLATE
function cellbutton(id) {
  rows = document.getElementsByClassName('pet_text');
  for (let text of rows) {
    if (text.id != "") {
      for (let atr of Object.keys(pets[id])) {
        if (text.id == atr) {
          if (text.id != "pet_image") {
            text.innerHTML = pets[id][atr];
          } else {
            let img = document.getElementById("p_image");
            img.src = "../images/" + pets[id][atr];
          }
        }
      }
    }
  }

}

function change_pets(){
  let table = document.getElementById("owners_table").getElementsByTagName('tbody')[0];
  cellbutton(0);

  table.replaceChildren();
  pets.forEach(p => {
    let row = table.insertRow();
    for (let i = 0; i < 3; i++) {
      let cell = row.insertCell();
      let text;
      switch (i) {
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
      cell.onclick = function() {
        cellbutton(cell.id);
        if(document.getElementsByClassName("selected")[0] != undefined){
           document.getElementsByClassName("selected")[0].classList.remove("selected");
        }
        row.classList.add("selected");
      };
      cell.appendChild(text);
    }
  });

  table.rows[0].classList.add("selected");

}


let setup = function() {



  if (student_pets != undefined && staff_pets != undefined) {
    let href = window.location.hash.split("#")[1];
    if(href == "students"){
      pets = student_pets;
    }
    else{
      document.getElementById("staff_or_student").value = "staff";
      pets = staff_pets;
    }
    change_pets();
  } else {
    setTimeout(() => {
      setup();
    }, 2)
  }

}


setup();
