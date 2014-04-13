var collection_products = require( "./conn_mongo" );

exports.findById = function( req, res ) {
	collection_products.findById( req, res, 'products', 'single-product', 'product' );
};

exports.listproducts = function( req, res ) {
	collection_products.findAll( req, res, 'products', 'index', 'item' );
	//console.log( collection_products.findAll( req, res, 'products', 'index', 'item' ) );
	//res.send( "index", { item : items } );
};