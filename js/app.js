function search_movie() { 
    let input = document.getElementById('searchbar').value 
    input=input.toLowerCase(); 
    let x = document.getElementsByClassName('names'); 
    let searchingDiv = document.getElementsByClassName('searching')[0];

    if (input !== "") {
        searchingDiv.style.display = "block";
    } else {
        searchingDiv.style.display = "none";
    }

    for (i = 0; i < x.length; i++) {  
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
        } 
        else { 
            x[i].style.display="flex";                  
        } 
    } 

}

function passwordVisibility() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

