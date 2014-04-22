var	mongo = require( 'mongodb' );

var	Server = mongo.Server,
	Db = mongo.Db,
	BSON = mongo.BSONPure;

server = new Server( 'localhost', 27017, { auto_reconnect : true } );

db = new Db( 'products', server );

db.open( function( err, db ) {
	if ( ! err ) {
		console.log( "Connected to 'products' database" );
		db.collection( 'products', { strict:true }, function( err, collection ) {
			if ( err ) {
				console.log( "The 'products' collection doesn't exist" );
				populate_collection();
			}
		});
	}
});

function populate_collection() {

	var model_product = [{
		p_name      : 'Product Name',
		discription : 'Product Discription',
		stock       : 10,
		unitary     : 10.20
	},
	{
		p_name      : 'Product Name 01',
		discription : 'Product Discription 01',
		stock       : 20,
		unitary     : 20.20
	}];

	db.collection( 'products', function( err, collection ) {
		collection.insert( model_product, { safe : true }, function( err, result ) {} );
	});
}

exports.findById = function( req, res, products, layout, layout_obj, type ) {
	var id = req.params.id;
	console.log( 'Retrieving : ' + id );
	db.collection( products, function( err, collection ) {
		collection.findOne( { '_id':new BSON.ObjectID( id ) }, function( err, item ) {
			if ( item != null ) {

				if ( type == 'json' ) {
					res.send( item );
				}else {
					res.render( 'single-product', { product: item } );
				}
			}
		});
	});
};

exports.findAll = function( req, res, products, layout, layout_obj, type ) {

	db.collection( products, function( err, collection ) {
		collection.find().toArray( function( err, items ) {
			if ( type == 'json' ) {
				res.send( items );
			}else{

				res.render( 'index' , { 'item': items } );
			}
		});
	});
};
