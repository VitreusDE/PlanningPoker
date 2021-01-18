var played = false;
document.querySelectorAll('.card-btn').forEach(item => {
  item.addEventListener('click', event => {
    if (item.classList.contains("btn-warning") && played==false){
        item.classList.remove("btn-warning");
        item.classList.add("btn-success");
        played=true;
    }
    else if (played == true) {
      alert("You played your card already!");
    }
  })
})
