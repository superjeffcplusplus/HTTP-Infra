const os = require("os");

const express = require("express");
const app = express();

app.listen(80, function() {
    console.log("Waiting for clients on port 80 ");
})

app.get("/", function(req, res){
    console.log("Incomming request...");
    let returnedObj = {};

    returnedObj.serverName = os.hostname();

    returnedObj.ipAddress = os.networkInterfaces()["eth0"][0].address;
    
    res.send(returnedObj);
})

