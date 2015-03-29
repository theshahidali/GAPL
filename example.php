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

// Include the app.php file 
require("app.php");

// Create an array with keys 'app_id','app_secret'
$config = array(
	'app_id' => '',		//provide your app id
	'app_secret' => ''	//provide your app secret key
);

// Initialize app by providing configurations
// Pass the @param config array
$app = new App($config);

// Create an array with key 'fields' values separated by commas
$param = array(
	'fields' => 'id,first_name,last_name,name,gender,picture.width(200)'
);

// Pass the created array $param along with 'username' to 'getUser()'
// Catch the result of getUser()
// NOTE: getUser() accepts a third parameter also. This parameter should 
// be an array with key named 'access_token'
$result = $app->getUser("shahid.sid",$param);

// print_r($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Example</title>
</head>
<body>
	<section style="text-align:center">

		<img src="<?php echo $result->picture->data->url; ?>">

		<h2><?php echo $result->first_name." ".$result->last_name; ?></h2>

		<h5>ID: <?php echo $result->id;?></h5>

		<h4>Gender: <?php echo $result->gender;?></h4>

		<a href="http://www.facebook.com/<?php echo $result->id;?>"><?php echo $result->name;?></a>
	
	</section>
</body>
</html>


