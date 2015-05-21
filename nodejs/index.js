var express = require('express'),
	app = express(),
	highligher = require('node-syntaxhighlighter');
	
app.get('/', function(req, res){
	console.log('received a get call');
	console.log(req.query.code);
	if(req.query && req.query.code){
		res.send(highligher.highlight(req.query.code, highligher.getLanguage(req.query.language.toLowerCase())));
	}else{
		res.send('Hoi');
	}
});	

	
app.listen(3000);
console.log('The server is listening at port 3000');
