var express = require('express'),
	app = express(),
	highligher = require('node-syntaxhighlighter'),
	nodemailer = require('nodemailer');
	
app.get('/', function(req, res){
	if(req.query && req.query.code){
		res.send(highligher.highlight(req.query.code, highligher.getLanguage(req.query.language.toLowerCase()))); 
	}else{
		res.send(false);
	}
});

// create reusable transport method (opens pool of SMTP connections)
var smtpTransport = nodemailer.createTransport("SMTP",{
    service: "Gmail",
    auth: {
        user: "codesnippet.stenden@gmail.com",
        pass: "DaLeRoHe"
    }
});

// setup e-mail data with unicode symbols
var mailOptions = {
    from: "Code Snippet <codesnippet.stenden@gmail.com>", // sender address
    to: "dannyvanderjagt@gmail.com", // list of receivers
    subject: "Welcome to Code Snippet! ", // Subject line
    text: "Welcome, ", // plaintext body
    html: "<b>Welcome,</b>" // html body
};

app.get('/mail', function(req, res){
 var username = req.query.username || "";
var email = req.query.email;

if(!email){
	return false;
}

mailOptions.to = email;
mailOptions.html = "<h1> Welcome "+username+", <br/> ";

// send mail with defined transport object
smtpTransport.sendMail(mailOptions, function(error, response){
    if(error){
        console.log(error);
	res.sendStatus(200);
    }else{
	res.sendStatus(200);
        console.log("Message sent: " + response.message);
    }

    // if you don't want to use this transport object anymore, uncomment following line
    //smtpTransport.close(); // shut down the connection pool, no more messages
});
 
});



	
app.listen(3000);
console.log('The server is listening at port 3000');
