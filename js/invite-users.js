var invited = document.querySelector('#invited');

document.querySelectorAll('.user-btn').forEach(item => {
  item.addEventListener('click', event => {
    event.preventDefault();
    if (item.classList.contains("btn-warning")){
        item.classList.remove("btn-warning");
        item.classList.add("btn-danger");

        var id = item.dataset.value;
        if (invited.value.length >= 7){
          alert("You have invited maximum number of players");
        }
        else{
          invited.value = invited.value + "," + id;
        }

        //alert(invited.value);

    }
    else{
      item.classList.remove("btn-danger");
      item.classList.add("btn-warning");
      var id = item.dataset.value;
      invited.value = invited.value.replace( ","+id, "");
    }
  })
})
