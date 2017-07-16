<?php

$endpoints = array();
registerEndpoint('GET', 'jumpers', 'GET_jumpers');
registerEndpoint('POST', 'jumpers', 'POST_jumpers');

// this function checks for request method, registered function to go along with it and parses the data
processRequest();

/* Put in your functions here, por favor */

function POST_jumpers($request) {

	$jumperspath = dirname(__FILE__) . "/../data/jumpers.json";

	$vars = $request['vars'];
	$func = array_shift($vars);

	$body = json_decode($request['vars']['body']);

	$newJumper = array(
		'id'	=> md5(date('c') . $body->name),
		'date' 	=> date('Y/m/d', strtotime($body->date)),
		'title' => sanitize($body->name),
		'desc'	=> sanitize($body->notes),
		'role'	=> (in_array($body->role, array('pilot','licensed','student')) ? $body->role : '')
		);

	if( $newJumper['role'] == '' || strtotime($newJumper['date']) < time() )
		return array('status' => 400, 'data' => array('Bad data'));


	$jumpersRaw = file_get_contents($jumperspath);
	$jumpers 	= json_decode($jumpersRaw);

	array_push($jumpers, $newJumper);

	file_put_contents($jumperspath, json_encode($jumpers));

	return array('status' => 200, 'data' => array('ok') );
}

function GET_jumpers($request) {

	$jumpersPath = dirname(__FILE__) . "/../data/jumpers.json";

	$vars = $request['vars'];
	$func = array_shift($vars);

	$data = array();

	switch($func):

		default:
		case '':
		case 'all':
			$jumpersRaw = file_get_contents($jumpersPath);
			$data 	= json_decode($jumpersRaw);

			break;

		case 'id':

			break;
	endswitch;

	return array('status' => 200, 'data' => $data);
}

/* no touching beneath this */
function processRequest() {

	global $endpoints;

	$method = (in_array($_SERVER['REQUEST_METHOD'], array('GET','POST','PUT','DELETE')) ? $_SERVER['REQUEST_METHOD'] : false );
	if( $method == false )
		die("no good");

	$body 	= file_get_contents('php://input');

	$path 	= explode("/", $_SERVER['REQUEST_URI']);
	$base	= array_search('api', $path);

	$request = array('method' => $method, 'func' => $path[$base+1], 'vars' => array() );
	$request['vars']['body'] = $body;
	for( $x = ($base+2); $x < count($path); $x++ ) {
		array_push($request['vars'], $path[$x]);
	}
	
	// defaults to bad route, eg. not found
	$result = array('status' => 404, 'data' => array() );

	// lets see if desired endpoint is registered
	if( !empty($endpoints[$method][$request['func']]) && function_exists($endpoints[$method][$request['func']]) ) {
		
		$functionname 	= $endpoints[$method][$request['func']];
		$result 		= call_user_func($functionname, $request);
	}

	// always return status code + data in json format
	http_response_code($result['status']);
	echo json_encode($result['data']);
	die();
}

function registerEndpoint($method, $endpoint, $funcName) {

	global $endpoints;
	$endpoints[$method][$endpoint] = $funcName;
}

function sanitize($string) {

	$result = strip_tags($string);
#	$result = htmlspecialchars($string);
	return $result;
}

?>