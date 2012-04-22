## ADres
the opensource information management tool

Goals:
-----------------------------
* An organization can easily manage their customer/clients information.
* An organization can create their own virtual database to store information.
* Provide developers to extend the plugin system to meet their needs.

Features:
------------------------------
* Extendable plugin feature
* Keyword searching
* Advance searching
* Saving searches
* History of modification
and many more

System Requirements:
-------------------------------
* PHP 5 or greater
* Database (prefered MySQL)
* Webserver

Tools Used:
------------------------------
* CakePHP 1.2.6
* SwiftMailer
* DebugKit

Installation:
-------------------------------
* Point the pubic_html to app/webroot
* Create a database and configure <b>app/config/database.php</b> with your database user and password
* Import the SQL script located on <b>sql<b> on to your database.

Plugin To This System
----------------------------
* Text Plugin
* Date Plugin
* Tick Plugin
* Number Plugin
* DropDown Plugin
* Email Plugin
* Encryption Plugin (php-openssl extension must be enabled to use this feature )

Creating your own plugin
-------------------------
Check the plugin.php file on model folder

Install SwiftMailer
------------------------
SwiftMailer is added to the system as git submodule so

	git submodule init
	git submodule update
this will install the proper library
