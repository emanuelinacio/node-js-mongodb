
exports.findbyname = function( req, res, next )
{
	var name = new Object();
	name = {
		p_name      : req.params.name,
		discription : 'teste discription',
		stock       : 20,
		unitary     : 10.20,
	};

	switch ( name.p_name ? name.p_name.toLowerCase() : '' ) {
		case 'larry' :
		case 'curly' :
		case 'moe' :
			res.render( 'single-product', { product: name } );
		break;

		default :
			next();
	}
}

exports.listproducts = function( req, res )
{
	
	res.render( 'index' );	
}