const Chance = require("chance");
const chance = new Chance();

const express = require("express");
const app = express();


const today = new Date();

let lastRequest = null;
let bowlsNb;

app.get("/", function(req, res){
    let returnedObj = {};
    returnedObj.date = today.getDate() + "." + (today.getMonth()+1) + "." + today.getFullYear();

    bowlsNb = Math.ceil(Math.random() * 3);

    returnedObj.iceCreamBowls = [];

    for (let i = 0; i < bowlsNb; ++i){
        returnedObj.iceCreamBowls.push(iceCreamTruck());
    }
    

    if (lastRequest !== null){
        returnedObj["time after previous request"] = ((Date.now() - lastRequest)/1000) + " seconds";
    }
    res.send(returnedObj);
    lastRequest = Date.now();
})

app.listen(3000, function() {
    console.log("Waiting for clients on port 3000 ");
})

function iceCreamTruck(){
    var tastes = ["chocolate", "vanilla", "strawberry", "lemon"];
    return chance.pickone(tastes);
}
