var express = require( "express" );	
var products = require( "./routes/r_products" );
var path = require( "path" );
var app = express();

app.set( 'view engine', 'jade' );
app.set( 'view options', 'true' );
app.set( 'views', path.join( __dirname + '/views' ) );
app.use( express.static( path.join( __dirname, 'public' ) ) );

app.all('*', function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "X-Requested-With");
  next();
 });


app.get( '/product/json/', products.jsonlistproducts );

app.get( '/product/json/:id?', products.jsonfindById );

app.get( '/product/update/:id&:name&:description&:stock&:unitary?', products.update_product );

app.get( '/product', products.listproducts );

app.get( '/product/:id?', products.findById );

// Launch server 
app.listen( 4242 );
console.log( 'Run dog' );