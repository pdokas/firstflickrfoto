<?php

	require('../lib.inc');
	
	$data = array();
	
	if (ensure_login()) {
		$who = addslashes($_GET['nsid']);
		
		$photo = getFirstPhoto($who);
		
		if ($photo['stat'] === 'ok') {
			$data['status'] = 'ok';
			$data['data'] = $photo['photos']['photo'][0];
		}
		else {
			$data['status'] = 'fail';
			$data['msg'] = "Error {$photo['code']}: {$photo['message']}";
		}
	}
	else {
		$data['status'] = 'fail';
		$data['msg'] = 'not logged in';
	}
	
	echo json_encode($data);

?>