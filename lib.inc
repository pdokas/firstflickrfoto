<?php

	function sign($url, $params, $method = 'GET') {
		global $app_secret, $token_secret;
		
		$key         = "{$app_secret}&{$token_secret}";
		$base_string = $method . '&' . rawurlencode($url) . '&' . rawurlencode($params);
		
		return base64_encode(hash_hmac('sha1', $base_string, $key, TRUE));
	}
	
	function formatParams($params = array()) {
		global $defaults;
		$ret = '';
		
		# Always recalc these
		$params['oauth_timestamp'] = time();
		$params['oauth_nonce']     = uniqid();
		
		$params = array_merge($defaults, $params);
		ksort($params);
		
		$i = 0;
		foreach ($params as $key => $val) {
			if ($i > 0) { $ret .= '&'; }
			
			$ret .= "{$key}=" . rawurlencode($val);
			$i++;
		}
		
		return $ret;
	}
	
	function explodeResponse($resp) {
		$ret = array();
		
		$keyVals = explode('&', $resp);
		
		for ($i = 0, $keyCount = count($keyVals); $i < $keyCount; $i++) {
		    $keyVal = explode('=', $keyVals[$i]);
		
			$ret[urldecode($keyVal[0])] = urldecode($keyVal[1]);
		}
		
		return $ret;
	}

?>