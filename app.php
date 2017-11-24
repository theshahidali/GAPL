<?php
/*
    Graph API PHP Library[GAPL] could be used to access Graph API easily
    Copyright (C) 2015  Shahid Ali

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class App{

	//@var appId string
	//@var appSecret string
	protected $appId;
	protected $appSecret;
	protected $node = "https://graph.facebook.com/v2.11/";

	/**********************************************************************
	* Requires @param config
	* @param config array
	* @param config should contain two keys named 'app_id','app_secret'
	*/
	public function __construct($config=array()){

		$this->appId = $config['app_id'];
		$this->appSecret = $config['app_secret'];	
	}

	/**********************************************************************
	* Requires @param config
	*
	* @param $config array
	*
	* Returns string
	*
	* NOTE:- @param config should contain three keys named 'redirect_uri','scope','response_type'
	* NOTE:- @param config key named 'scope' values should be separated by commas
	*/
	public function makeLoginUrl($config=array()){

		$responseType = $config['response_type'];
		$redirectUrl = $config['redirect_uri'];
		$scope = $config['scope'];
		$clientId = $this->appId;

		return $url = "http://www.facebook.com/dialog/oauth?client_id=$clientId&redirect_uri=$redirectUrl&response_type=$responseType&scope=$scope";
	}

	/**********************************************************************
	* Requires @param user
	* Optional @param fields,key
	*
	* @param user string
	* @param fields array
	* @param key array
	*
	* Returns array on success
	* Retruns FALSE on fail
	*
	* NOTE:- @param field should contain key named 'fields' and values separated by commas
	* NOTE:- @param key should contain key named 'access_token'
	* NOTE:- keyword 'me' is only valid in @param user if @param key is set
	*/
	public function getUser($user,$fields=array("fields"=>""),$key=array("access_token"=>"")){

		$url=$this->node."$user?fields=".$fields['fields']."&access_token=".$key['access_token'];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// Disabling SSL 
		// Only enable on local server if SSL verification error occur
		// DO NOT ENABLE THESE ON LIVE SERVER (security issues)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$result = curl_exec($ch);

		if($result === FALSE){
			return FALSE;
		}else{

			$result = json_decode($result);

			if(isset($result->error)){
				return FALSE;
			}else{
				return $result;
			}
		}

		curl_close($ch);	
	}

	/**********************************************************************
	* Requires @param location, @param token, @param Message
	* @param location string
	* @param token string
	* @param message array
	*
	* Returns array on success
	* Returns FALSE on fail
	*/
	public function apiPost($location,$token,$message=array()){

		$message['access_token']="$token";
		$url=$this->node."$location/feed";

		$ch = curl_init();
 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

		// Disabling SSL 
		// Only enable on local server if SSL verification error occur
		// DO NOT ENABLE THESE ON LIVE SERVER (security issues)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		 
		$result = curl_exec($ch);
		 
		if($result === FALSE){
			return FALSE;
		}else{
			$result = json_decode($result);

			if(isset($result->error)){
				return FALSE;
			}else{
				return $result;
			}
		}

		curl_close($ch);
	}

	/**********************************************************************
	* Requires @param config
	*
	* @param config array
	* @param config should contain two keys 'page_id','access_token'
	*
	* Returns string on success
	* Returns FALSE on fail
	*/
	public function getPageToken($config=array()){

		$pageId=$config['page_id'];
		$token=$config['access_token'];
		$url = $this->node."$pageId?fields=access_token&access_token=$token";
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// Disabling SSL 
		// Only enable on local server if SSL verification error occur
		// DO NOT ENABLE THESE ON LIVE SERVER (security issues)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$result = curl_exec($ch);

		if($result === FALSE){
			return FALSE;
		}else{

			$result = json_decode($result);

			if(isset($result->error)){
				return FALSE;
			}else{
				return $result->access_token;
			}
		}

		curl_close($ch);
	}

	/**********************************************************************
	* Requires @param token
	*
	* @param token string
	*
	* Returns array on success
	* Returns FALSE on fail
	*/
	public function getAllPages($token){

		$url= $this->node."me/accounts?fields=id,name,category&limit=100&access_token=$token";
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// Disabling SSL 
		// Only enable on local server if SSL verification error occur
		// DO NOT ENABLE THESE ON LIVE SERVER (security issues)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$result = curl_exec($ch);

		if($result === FALSE){
			return FALSE;
		}else{

			$result = json_decode($result);

			if(isset($result->error)){
				return FALSE;
			}else{
				return $result->data;
			}
		}
		curl_close($ch);
	}

	/**********************************************************************
	* Requires @param token
	* 
	* @param token string
	*
	* Returns string on success
	* Returns FALSE on fail
	*/
	public function makeLongToken($token){

		$clientId = $this->appId;
		$secret = $this->appSecret;
		$url=$this->node."oauth/access_token?grant_type=fb_exchange_token&client_id=$clientId&client_secret=$secret&fb_exchange_token=$token";
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// Disabling SSL 
		// Only enable on local server if SSL verification error occur
		// DO NOT ENABLE THESE ON LIVE SERVER (security issues)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$result = curl_exec($ch);

		if($result === FALSE){
			return FALSE;
		}else{

			$r = json_decode($result);

			if(isset($r->error)){
				return FALSE;
			}else{
				$result=explode("=", $result);
				return $result[1];
			}
		}
		curl_close($ch);
	}

	/**********************************************************************
	* Requires @param token
	* Optional @param check,redirect
	* 
	* @param token string
	* @param check string
	* @param redirect string
	*
	* Returns array/TRUE on success
	* Returns FALSE on fail
	*/
	function getPermissions($token,$redirect=''){

		$url= $this->node."me/permissions?access_token=$token";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// Disabling SSL 
		// Only enable on local server if SSL verification error occur
		// DO NOT ENABLE THESE ON LIVE SERVER (security issues)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$result = curl_exec($ch);

		curl_close($ch);

		if($result === FALSE){ //If request is not executed correctly

			return FALSE;
		}
		else{

			$result = json_decode($result);

			if(isset($result->error)){ //If an error is returned back from api

				return FALSE;
			}
			elseif(empty($result)){ //If nothing is returned back from api

				return FALSE;
			}
			else{
					
				if(!empty($redirect)){ //If passed along with redirect uri and token

					$scope="";

					foreach($result->data as $row){

						if($row->status != "granted"){

							$scope .=$row->permission.",";
						}
					}

					if(empty($scope)){

						return TRUE;
					}
					else{

						$id=$this->appId;
						$url="https://www.facebook.com/dialog/oauth?client_id=$id&redirect_uri=$redirect&auth_type=rerequest&scope=$scope";
						redirect($url);
					}
				}
				else{ //If only token passed ,simply returns array

					return $result;
				}
			}
		}
	}
}


