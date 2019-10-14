document.getElementById("pizza-form").onsubmit = validate;

function validate() {
    var isValid = true;

    //Clear all error messages
    var errors = document.getElementsByClassName("err");
    for (var i = 0; i <errors.length; i++) {
        errors[i].style.display = "none";
    }

    //Check first name
    var first = document.getElementById("firstName").value;
    if (first == "") {
        var errFirst = document.getElementById("err-fname");
        errFirst.style.display = "block";
        isValid = false;
    }

    //Check last name
    var last = document.getElementById("lastName").value;
    if (last == "") {
        var errLast = document.getElementById("err-lname");
        errFirst.style.display = "block";
        isValid =  false;
    }

    //Check pizza size
    var size = document.getElementById("size").value;
    if (size == "none") {
        var errSize = document.getElementById("errSize");
        errSize .style.display = "block";
        isValid =  false;
    }

    return isValid;
}

