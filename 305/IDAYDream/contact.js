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

    //Check email
    var email = document.getElementById("email").value;
    if (email == "") {
        var errEmail = document.getElementById("err-email");
        errEmail .style.display = "block";
        isValid =  false;
    }

    //Check phone
    var phone = document.getElementById("phone").value;
    if (phone == "") {
        var errPhone = document.getElementById("err-phone");
        errPhone .style.display = "block";
        isValid =  false;
    }

    //Check address
    var street = document.getElementById("street1").value;
    if (street == "") {
        var errStreet = document.getElementById("err-street");
        errStreet .style.display = "block";
        isValid =  false;
    }

    //Check city
    var city = document.getElementById("city").value;
    if (city == "") {
        var errCity = document.getElementById("err-city");
        errCity .style.display = "block";
        isValid =  false;
    }

    //Check state
    var state = document.getElementById("state").value;
    if (city == "select") {
        var errState = document.getElementById("err-state");
        errState .style.display = "block";
        isValid =  false;
    }

    //Check ZIP code
    var zip = document.getElementById("zip").value;
    if (city == "") {
        var errZip = document.getElementById("err-zip");
        errZip .style.display = "block";
        isValid =  false;
    }

    return isValid;
}
