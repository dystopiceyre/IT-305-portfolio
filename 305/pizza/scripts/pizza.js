document.getElementById("pizza-form").onsubmit = validate;

function validate() {

    var isValid = true;

    //Clear all error messages
    var errors = document.getElementsByClassName("err");
    for (var i=0; i<errors.length; i++) {
        errors[i].style.visibility = "hidden";
    }

    //Check first name
    var first = document.getElementById("firstName").value;
    if (first == "") {
        var errFirst = document.getElementById("err-fname");
        errFirst.style.visibility = "block";
        isValid = false;
    }

    //Check last name
    var last = document.getElementById("lastName").value;
    if (last == "") {
        var errLast = document.getElementById("err-lname");
        errLast.style.visibility = "block";
        isValid = false;
    }

    //Check size
    var size =
        document.getElementById("size").value;
    if (size == "none") {
        var errSize = document.getElementById("err-size");
        errSize.style.visibility = "block";
        isValid = false;
    }

    //Validate pickup or delivery
    var method = document.getElementsByName("method");
    var methodValue = "";
    for (i=0; i < method.length; i++) {
        if (method[i].checked) {
            methodValue = method[i].value;
        }
    }
    if (methodValue == "") {
        var errMethod = document.getElementById("err-method");
        errMethod.style.visibility = "block";
        isValid = false;
    }

    //Require address when "delivery" is selected
    var address =
        document.getElementById("address").value;
    if (address == "" && methodValue == "delivery") {
        var errAddress = document.getElementById("err-address");
        errAddress.style.visibility = "block";
        isValid = false;
    }

    //Require at least one topping (*** Not real world! ***)
    var toppings = document.getElementsByName("toppings[]");
    var numToppings = 0;
    for (i=0; i < toppings.length; i++) {
        if (toppings[i].checked) {
            numToppings++;
        }
    }
    if (numToppings == 0) {
        var errToppings =
            document.getElementById("err-toppings");
        errToppings.style.visibility = "block";
        isValid = false;
    }

    return isValid;
}