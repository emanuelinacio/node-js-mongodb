<html>
	<head>
		<script>
			function request_ajax( url, source, div_response )
			{
				var request = new XMLHttpRequest();
				request.open("GET", url, true);
				request.onreadystatechange = function () {
				if (request.readyState != 4 || request.status != 200) return;
					var json = $.extend({}, JSON.parse( request.responseText ) );
					generate_handler( source, json, div_response );
				};
				request.send();
			}

			function ajax_update( url, div_response )
			{				
				var request = new XMLHttpRequest();
				request.open("GET", url, true);
				request.onreadystatechange = function () {
				if (request.readyState != 4 || request.status != 200) return;
					var json = $.extend({}, JSON.parse( request.responseText ) );
					if ( json.status == "ok" ){
						var response = 'alert-success';
					}else{
						var response = 'alert-dange';						
					}
					$( div_response ).addClass( response ).html( json.message );
					
				};
				request.send();
			}

			function get_all()
			{
				request_ajax( "http://127.0.0.1:4242/product/json/", 'entry-template', 'div_all' );
			}

			function get_by_id()
			{
				var id = document.getElementById( 'id_product' ).value;
				request_ajax( "http://127.0.0.1:4242/product/json/" + id, 'entry-template-single', 'div_single' );
			}

			function update_by_id()
			{
				var url = "http://127.0.0.1:4242/product/update/" + 
				document.getElementById( 'id_product' ).value + "&" +
				encodeURIComponent( document.getElementById( 'product_name' ).value ) + "&" +
				encodeURIComponent( document.getElementById( 'description' ).value ) + "&" +
				encodeURIComponent( document.getElementById( 'stock' ).value ) + "&" +
				encodeURIComponent( document.getElementById( 'unitary' ).value );

				ajax_update( url , '#return_message' );				

			}

			function generate_handler( source, context, div_response )
			{
				if ( div_response == 'div_all' ) {
					var context = { data : context }
				}
				var generate_source = jQuery( '#' + source ).html();
				var template = Handlebars.compile( generate_source );
				$( '#' + div_response ).html( template( context ) );
			}

		</script>
	</head>
		<script type="text/javascript" src="public/js/jquery.min.js"></script>
		<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="public/js/handlebars.js"></script>
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<body>
		<div class="tabbable">
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab1" data-toggle="tab">List Products</a></li>
		    <li><a href="#tab2" data-toggle="tab">Select Product</a></li>
		  </ul>
		  <div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<button class="btn" onclick="get_all()">Get All Products</button>
				<div id="div_all"></div>
				<script id="entry-template" type="text/x-handlebars-template">					
					<table class="table table-striped">
						<thead>
							<tr>
								<th> Name </th>
								<th> Description </th>
								<th> Stock </th>
								<th> Unitary </th>
								<th> Id </th>
							</tr>
							<tbody>
								{{#each data}}
									<tr>
										<td> {{ p_name }} </td>
										<td> {{ discription }} </td>
										<td> {{ stock }} </td>
										<td> {{ unitary }} </td>
										<td> {{ _id }} </td>																									
									</tr>
								{{/each}}
							</tbody>
						</thead>
					</table>
				</script>
			</div>
			<div class="tab-pane" id="tab2">
				<div class="navbar"> 
					<div class="navbar-inner">
						<div class="alert" role="alert" id="return_message"></div>
						<label for="id_product"> Id Product </label>
						<input class="span2" type="text" id="id_product" name="id_product"></input>					
						<button class="btn" onclick="get_by_id()">Get Products by Id</button>	
						<div id="div_single"></div>									
						<script id="entry-template-single" type="text/x-handlebars-template">
							<label> Product Id </label>
							<input id="product_id" type="text" name="product_id" placeholder="Product Id" value="{{_id}}" ></input>
							<label> Product Name </label>
							<input id="product_name" type="text" name="product_id" placeholder="Product Name" value="{{p_name}}" ></input>
							<label> Product Discription </label>
							<input id="description" type="text" name="description" placeholder="Product Description" value="{{discription}}" ></input>
							<label> Product Stock </label>
							<input id="stock" type="number" name="stock" placeholder="Product Stock" value="{{stock}}" ></input>
							<label> Product Unitary </label>
							<input id="unitary" type="text" name="unitary" placeholder="Product Unitary" value="{{unitary}}" ></input>
						</script>
						<button class="btn" onclick="update_by_id()">Update</button>	
						<button class="btn" onclick="delete_by_id()">Delete</button>						
					</div>
				</div>
			</div>
		  </div>
		</div>
	</body>

</html>