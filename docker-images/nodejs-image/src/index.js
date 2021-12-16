var Chance = require("chance");
var chance = new Chance();

var express = require("express");
var app = express();

app.get("/", function(req, res){
    var html = "<html><h2>";
    html += "The food truck is comming...<br>";
    html += "You ordred : "
    html += iceCreamTruck();
    html += "ice cream<br>";
    html += "</h2></html>";
    res.send(html);
})

app.listen(3000, function() {
    console.log("Waiting for clients on port ");
})

function iceCreamTruck(){
    var tastes = ["chocolate", "vanilla", "strawberry", "lemon"];
    return chance.pickone(tastes);
}
