var collection_products = require( "./conn_mongo" );

exports.findById = function( req, res ) {
	collection_products.findById( req, res, 'products', 'single-product', 'product' , 'null');
};

exports.listproducts = function( req, res ) {
	collection_products.findAll( req, res, 'products', 'index', 'item', 'null' );
};

exports.jsonfindById = function( req, res ) {
	collection_products.findById( req, res, 'products', 'single-product', 'product', 'json' );
};

exports.jsonlistproducts = function( req, res ) {
	collection_products.findAll( req, res, 'products', 'index', 'item', 'json' );
};