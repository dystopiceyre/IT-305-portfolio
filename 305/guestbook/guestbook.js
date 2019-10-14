document.getElementById("meet").onclick = ifOther;

function ifOther() {
    var meet = document.getElementById("meet").value;

    if (meet == "other") {
        var otherSpan = document.getElementById("otherSpan");
        otherSpan.style.display = "block";
    }

}
