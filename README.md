# GAPL
Graph API PHP Library is a simple library to access graph api easily.

Contents
========
- Graph API PHP Library [GAPL]
- Features
- Functions
	- makeLoginUrl()
	- getUser()
	- apiPost()
	- getPageToken()
	- getAllPages()
	- makeLongToken()
	- getPermissions()
- Installation
- Usage
	- Example 1
	- Example 2
- Contribute
- Support

Graph API PHP Library [GAPL]
============================

This library is written to make the basic use of Graph API easy. An official PHP SDK is already available for the Graph API, But that is too complex for beginners. This simple library helps beginners to understand Graph API more easily and quickly and helps develop applications quickly.

Features
--------

- Easy integration
- Simple Structured functions
- Quickly understandable
- Easy modification
- Includes necessary functionality

Functions
---------

1. makeLoginUrl()

	- This function takes one argument of type array and returns a complete login URL as string,which further you can use in your application. The argument array should contain following three keys:

		- 'redirect_uri'
		- 'response_type'
		- 'scope'

2. getUser()

	- By using this function you can get user's data. It takes three arguments, two of them are optional. First argument is compulsory and this should be of type string,It could be a user id or 'me' but 'me' could only be used with access_token. Second and third arguments are optional and should be of type array. These optional arrays should contain following keys:

		- Optional array one
			- 'fields'
		- Optional array two
			- 'access_token'
3. apiPost()

	- You can post anything on profile/page/group by using this simple function. This function takes following three arguments:

		- profile_id | page_id | group_id	[STRING]
		- Access_Token	[STRING]
		- Message	[ARRAY]

4. getPageToken()

	- For posting or getting data from a particular page you need that particular page's access_token. This function makes it easy to get any page's access_token by providing page_id and user_access_token. This function takes one argument of type array with the following keys:

		- 'page_id'
		- 'access_token'

5. getAllPages()

	- This function could be used to get all the pages of the user by using the user_access_token.
	This function will return an array with all page's details. It takes one argument of type string. This argument should be the user_access_token.

6. makeLongToken()

	- At the time of login by using makeLoginUrl function an temporary user_access token is giving you can make that token long lasting by using this function. It takes one argument of type string which should be the user_access_token, And returns the long lasting access_token.

7. getPermissions()

	- You can use this function to check if all the asked permissions are granted if not it re-asks the user. As well as you can use this function to get all the granted permissions of the user in an array. This function will return an array/False/redirects if you provided an redirect URI. It takes the following arguments:

		- Access_token [STRING]
		- Redirect_URI [STRING] [OPTIONAL]

	- If you pass the second argument 'Redirect_URI' the function will only check the user's permission, If one or more permissions are not granted it will re-ask the user. Otherwise it will return true.
	- If you only pass the access_token then the function will return an array listing all the user permissions (granted/not granted) in detail.

Installation
------------

1. Download the zip file
2. Extract the zip file
3. Open the GAPL folder
4. Copy all the files
5. Paste these files in your project directory
6. Include the app.php file in your coding file by PHP's require() function.

Usage
-----

When you have installed the library in your project you can initiate the library by passing your app_id and app_secret in an array:

	Example 1: $myApp = new App(array('app_id'=>'yourAppID','app_secret'=>'yourAppSecret'));

After initiating the application and creating new object you can access all of its methods:

	Example 2: $myApp->makeLoginUrl();

Contribute
----------
- Issue Tracker: https://github.com/theshahidali/GAPL/issues
- Source Code: https://github.com/theshahidali/GAPL
Support
-------

If you have any issues, Let me know on my following email address. I will reply you ASAP.

>shahidali.1@hotmail.com
