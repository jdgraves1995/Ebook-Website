function processPage() {

    var title2 = document.getElementById("title").innerHTML;
   
    if (document.cookie.length == 0) {
        window.location.href = "store_index.html";
    }
    else {
        var temp2 = 0;
        var cookieArray = document.cookie.split(";");
        for (var i = 0; i < cookieArray.length; i++) {

            if (i == 0) {
                var newrow1 = document.getElementById("table").insertRow(0);

                var newtd0a = newrow1.insertCell(-1);
                newtd0a.align = "center";
                newtd0a.width = 100;
                var newtd1a = newrow1.insertCell(-1);
                newtd1a.align = "center";
                var newtd2a = newrow1.insertCell(-1);
                newtd2a.align = "center";
                var newtd3a = newrow1.insertCell(-1);
                newtd3a.align = "center";
                var newtd4a = newrow1.insertCell(-1);
                newtd4a.align = "center";

                newtd0a.innerHTML = "<b>Catalog#</b>";
                newtd1a.innerHTML = "<b>Item</b>";
                newtd2a.innerHTML = "<b>Price</b>";
                newtd3a.innerHTML = "<b>Quantity</b>";
                newtd4a.innerHTML = "<b>Total Price</b>";
            }
            let temp = cookieArray[i].split("=");
            let t2 = temp[1].split(",");
            let image = t2[2];
            let catalog = t2[3];
            let title = temp[0];
            let quantity = parseFloat(t2[0]);
            let price = parseFloat(t2[1]);



            var newrow2 = document.getElementById("table").insertRow(-1);

            var catalogCell = newrow2.insertCell(-1);
            catalogCell.align = "center";
            catalogCell.innerHTML = "<p>" + catalog + "</p>";

            var itemCell = newrow2.insertCell(-1);
            itemCell.align = "center";
            itemCell.innerHTML = "<h1 id='header'>" + title + "</h1></br><img src=" + image + "></img>" + "</br>";
            if (title2 == "Shopping Cart") {
                itemCell.innerHTML += "<input type='button' value='Remove' onclick='removeItem()'></input>";
            }


            var priceCell = newrow2.insertCell(-1);
            priceCell.align = "center";
            priceCell.innerHTML = "<p>" + price + "</p>";

            var quantityCell = newrow2.insertCell(-1);
            quantityCell.align = "center";
            quantityCell.innerHTML = "<p>" + quantity + "</p>";

            var total = quantity * price;
            var totalCell = newrow2.insertCell(-1);
            totalCell.align = "center";
            totalCell.innerHTML = "<p>" + total + "</p>"
            temp2 += total;

            if (i + 1 == cookieArray.length) {
                var newrow3 = document.getElementById("table").insertRow(-1)
                var overallTotal = newrow3.insertCell(-1);
                overallTotal.align = "center";
                overallTotal.innerHTML = "<p>TOTAL</p>";

                var overallAddition = newrow3.insertCell(1);
                newrow3.width = "50%";
                overallAddition.setAttribute("colspan", "4");
                overallAddition.align = "right";
                overallAddition.innerHTML = "<p>" + temp2 + "</p>";
            }
        }
    }
    
}

function removeItem() {
    var header = document.getElementById("header").innerHTML;

    var r = confirm("Remove " + header + " from the cart?")
    {
        if (r == true) {
            document.cookie = header + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
            window.location.reload();
            return true;
        }

        else {
            return false;
        }
    }
}

function conformation() {
    var title = document.getElementById("title").innerHTML;
   

    var r = confirm("Add " + title + " to the cart?");
    if (r == true) {
        setCookie();
        window.location.href = "checkout.html";
        return true;
    }
    else {
        window.location.reload();
        return false;
    }

}

function setCookie() {
    var catalog = document.getElementById("catalog").innerHTML;
    var title = document.getElementById("title").innerHTML;
    var quantity = document.getElementById("quant").value;
    var image = document.getElementById("image").getAttribute("src");
    var price = document.getElementById("price").innerText.split(":")[1].replace(/[$]/g, "");

        document.cookie = title + "=" + quantity + "," + price + "," + image + "," + catalog + ";path=/";
}


function getInfo() {
    conformation();
   
}

function redirect() {

    if (document.cookie.length == 0) {
        alert("Empty Cart-Please Buy Something First");
        window.location.href = "store_index.html";
    }
    else {
        window.location.href = "cart.html";
    }
}

function redirect2() {
    window.location.href = "checkout.html";
}

function validation() {
    var number = document.getElementById("number").value;
    var sum = 0;
    for (var i = 0; i < number.length; i++) {

        let n = parseInt(number[i]) % 2 == 0 ? parseInt(number[i]) * 2 : parseInt(number[i]);
        sum += n;
    }
        
        if (!(sum % 10 == 0)) {
            alert("Invalid Credit Card Number");
        }
    
}

var pics = new Array(10);
pics[0] = "images/0.png";
pics[1] = "images/1.png";
pics[2] = "images/2.png";
pics[3] = "images/3.png";
pics[4] = "images/4.png";
pics[5] = "images/5.png";
pics[6] = "images/6.png";
pics[7] = "images/7.png";
pics[8] = "images/8.png";
pics[9] = "images/9.png";

var captions = new Array("Weights", "Balance-Living Lifestyle Change", "Elliptical Trainer", "Download our App from the App Store ",
    "Our Weight Room", "Read our Health Blogs!", "Meet our Trainers!", "Our Wide Assortment of Free-Weights", "Enjoy our Outdoor Yoga Class!",
    "Balance-Living is Healthy Living!");


var fadeOut_opacity = 1;
var fadeIn_opacity = 0;
var delta = 0.01;
var nextPic;
var nextLabel;
var loop = 1;

function effects() {
    
    nextPic = pics[loop];
    nextLabel = captions[loop];
        fadeOut();
    
}

function fadeOut() {
    //Set the initial opacity
    document.getElementById("pic1").style.opacity = fadeOut_opacity;
    document.getElementById("javaLabel").style.opacity = fadeOut_opacity;

    //Decrement by .01
    fadeOut_opacity -= delta;

    if (fadeOut_opacity <= 0) {
        //Fade in the desired image
        loop++
        fadeOut_opacity = 1;
        if(loop == 9)
        {
            loop = 0;
        }
        fadeIn();
        return;
    }

    //Set time out
    timer = setTimeout("fadeOut()", 25);
}

function subtract(i) {
    var num = document.getElementById("quant").value;
    var title = document.getElementById("title").innerHTML;
    var inventory = i;
    if (num > inventory) {
        window.alert("Only" + inventory + " " + title + " left in stock!");
    }

}



function fadeIn() {

    //Set the initial opacity
    document.getElementById("pic1").src = nextPic;
    document.getElementById("pic1").style.opacity = fadeIn_opacity;
    document.getElementById("javaLabel").innerHTML = "<p id='javaLabel' align='center'>" + nextLabel + "</p>";
    document.getElementById("javaLabel").style.opacity = fadeIn_opacity;

    //Increment by .001
    fadeIn_opacity += delta;

    if (fadeIn_opacity >= 1) {
        fadeIn_opacity = 0;
        effects();
        return;
    }

    //Set time out
    timer = setTimeout("fadeIn()", 25);
}
