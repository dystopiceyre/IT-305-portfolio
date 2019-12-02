document.getElementById("guestbook").onsubmit = validate;

function validate() {
    var isValid = true;

    //Clears error messages
    var errors = document.getElementsByClassName("err");
    for (let i = 0; i < errors.length; i++) {
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
        errLast.style.display = "block";
        isValid = false;
    }


    // Check how we met
    document.getElementById("meet").addEventListener("change", function () {
        var howMet = document.getElementById("meet");
        var metOptions = document.getElementsByClassName("options");
        if (metOptions[howMet.selectedIndex].value == "pholder") {
            var errMeet = document.getElementById("err-meet");
            errMeet.style.display = "block";
            isValid = false;
        }

        else if (metOptions[howMet.selectedIndex].valuet == "other") {
            var otherSpan = document.getElementById("otherSpan");
            otherSpan.style.display = "block";
        }

        var other = document.getElementById("if-other").value;
        if (other == "") {
            var errSpecify = document.getElementById("err-specify");
            errSpecify.style.display = "block";
        }
    })

    //Validate email address
    var addMe = document.getElementById("add-me");
    var list = addMe.value;
    addMe.onclick = mailingList;
    var emailType = document.getElementById("add-email");
    if (list == "checked") {
        emailType.style.visibility = "block";
    }

    //validate LinkedIn URL
    var linkedIn = document.getElementById("linkedin").value;
    var url = linkedIn.search("https://www.linkedin.com/in/");
    if (url < 0) {
        var errLinkedIn = document.getElementById("err-linkedin");
        errLinkedIn.style.display = "block";
        isValid = false;
    }

    return isValid;
}


function mailingList() {
    var emailAddress = document.getElementById("email").value;
    var search = emailAddress.search("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}");
    if (search < 0) {
        var errEmail = document.getElementById("err-email");
        errEmail.style.display = "block";
        return false;
    }
}