var hl = require('node-syntaxhighlighter');
var dnode = require('dnode');

var server = dnode({
	highlight: function(n, cb){ 
		console.log(n);
		cb(hl.highlight(n.code, hl.getLanguage(n.language))); 
	}
});

server.listen(7070);