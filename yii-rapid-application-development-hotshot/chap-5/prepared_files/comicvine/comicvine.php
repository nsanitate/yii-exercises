<?php

class CbdbComicVine {
	private $apiKey;
	private $baseUrl;

	public function __construct($apiKey, $baseUrl = 'http://api.comicvine.com/') {
		$this->setApiKey($apiKey);
		$this->setBaseUrl($baseUrl);
	}
	
	public function setAPiKey($apiKey) {
		$this->apiKey = $apiKey;
	}

	public function setBaseUrl($baseUrl) {
		$this->baseUrl = $baseUrl;
	}

	public static function buildQueryString($paramArray) {
		$paramString = http_build_query($paramArray);
		if ($paramString) {
			$paramString = '?' . $paramString;
		}
		return $paramString;
	}

	public static function makeRequest($url, $paramArray) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url . CbdbComicVine::buildQueryString($paramArray));
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		$response = curl_exec($curl);
		$status = curl_getinfo($curl);
		if ($status['http_code'] == 200) {
			$responseObject = json_decode($response);
			if (is_object($responseObject) && ($responseObject->status_code == 1)) {
				return array('error' => 0, 'content' => $responseObject);
			}
			return array('error' => 1, 'error_type' => 'site', 'content' => $responseObject);
		}
		return array('error' => 1, 'error_type' => 'transfer', 'content' => $status);
	}

	private function setInitParams(&$params) {
		$params['api_key'] = $this->apiKey;
		$params['format'] = 'json';
		return $params;
	}

	public function getNewParamsArray() {
		$params = array();
		return $this->setInitParams($params);
	}

	public function baseRequest($resource, $addlParams) {
		$params = $this->getNewParamsArray();
		$params = array_merge($params, $addlParams);
		return $this->makeRequest($this->baseUrl . $resource . '/', $params);
	}

	public function detailRequest($resource, $id, $addlParams) {
		$params = $this->getNewParamsArray();
		$params = array_merge($params, $addlParams);
		return $this->makeRequest($this->baseUrl . $resource . '/' . $id . '/', $params);
	}

	public function volumeSearch($query, $params = array(), $offset = 0, $limit = 20) {
		$params['query'] = $query;
		$params['resources'] = 'volume';
		$params['offset'] = $offset;
		$params['limit'] = $limit;
		
		return $this->baseRequest('search', $params);
	}

	public function volume($id, $params = array()) {
		return $this->detailRequest('volume', $id, $params);
	}

	public function issue($id, $params = array()) {
		return $this->detailRequest('issue', $id, $params);
	}

	public function issuesForVolume($volumeId, $params = array()) {
		$params['field_list'] = 'issues';
		return $this->detailRequest('volume', $volumeId, $params);
	}
}

