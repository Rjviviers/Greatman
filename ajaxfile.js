function email(name,contact,make,model,prys,km) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("update").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "email.php?q=" + name + "=" + contact + "=" + make + "=" + model + "=" + prys + "=" + km , true);
        xmlhttp.send();
}
function about() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("main").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "about.php?", true);
        xmlhttp.send();
        
}
function enkelrek(q) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("main").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "enkel.php?q=" + q, true);
        xmlhttp.send();
}

var myIndex = 0;
var j=0;
function next()
{
	myIndex++;
	var i;
	var x = document.getElementsByClassName("mySlides");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
    }
	if (myIndex > x.length) {myIndex = 1}
	if (myIndex < 0) {myIndex = x.length}
	var x = document.getElementsByClassName("mySlides");
	x[myIndex-1].style.display = "block";
}
function terug()
{
	myIndex--;
	var i;
	var x = document.getElementsByClassName("mySlides");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
    }
	if (myIndex > x.length) {myIndex = 1}
	if (myIndex <= 0) {myIndex = x.length}
	var x = document.getElementsByClassName("mySlides");
	x[myIndex-1].style.display = "block";	
}
function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
	if (myIndex < 0) {myIndex = x.length}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 8000);
}
function jkl(){
    document.getElementById('myModal').style.display="block";
}
function sp() {
    document.getElementById('myModal').style.display = "none";
}