<?php

$endpoints = array();
registerEndpoint('GET', 'jumpers', 'GET_jumpers');

// this function checks for request method, registered function to go along with it and parses the data
processRequest();

/* Pass your functions here, por favor */


function GET_jumpers($request) {

	$vars = $request['vars'];
	$func = array_shift($vars);

	switch($func):

		case '':
		default:

			break;
	endswitch;

	return array('status' => 200, 'data' => $vars);
}

/* no touching beneath this */
function processRequest() {

	global $endpoints;

	$method = (in_array($_SERVER['REQUEST_METHOD'], array('GET','POST','PUT','DELETE')) ? $_SERVER['REQUEST_METHOD'] : false );
	if( $method == false )
		die("no good");

	$path 	= explode("/", $_SERVER['REQUEST_URI']);
	$base	= array_search('api', $path);

	$request = array('method' => $method, 'func' => $path[$base+1], 'vars' => array() );
	for( $x = ($base+2); $x < count($path); $x++ ) {
		array_push($request['vars'], $path[$x]);
	}
	
	$result = array('status' => 404, 'data' => array() );

	// lets see if desired endpoint is registered
	if( !empty($endpoints[$method][$request['func']]) && function_exists($endpoints[$method][$request['func']]) ) {
		
		$functionname 	= $endpoints[$method][$request['func']];
		$result 		= call_user_func($functionname, $request);
	}

	http_response_code($result['status']);
	echo json_encode($result['data']);
	die();

}

function registerEndpoint($method, $endpoint, $funcName) {

	global $endpoints;
	$endpoints[$method][$endpoint] = $funcName;
}

?>