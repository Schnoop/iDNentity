# IDNentity

IDNentity is a tool that identifies the used CMS/Framework etc. while executed in an application webroot. All collected informations will be returned as JSON (if executed via browser) or an array (if executed via CLI).

## Build

Checkout code and install all necessary build tools via: 

``
vagrant@homestead:~/code/iDNentity$ composer install
``

The build tool will merge all single PHP classes into a single file in folder "build/". This file can easily be deployed to all servers.

``
vagrant@homestead:~/code/iDNentity$ php bin/build.php
``

## Usage

### CLI

Navigate to the document root of the application you would like to determinate and execute the file:

``
vagrant@homestead:~/code/iDNentity$ idnentity.php
``

Sample output: 

<pre>
Array
(
    [ip_address] => homestead // Note: Hostname used instead of the server ip.
    [php_version] => 7.1.20 // Note: PHP version will be taken from used PHP CLI. Not necessary the version that is used from the web server.
    [type] => Laravel
    [version] => 5.7.14
    [extensions] => Array
        (
        )
)
</pre>


### Webserver

Copy the idnentity.php file to your document root and point the browser to the file. e.g. http://foo.bar/idnentity.php

Result will be same as on CLI, but instead of array the result will be JSON.

### Testing

In the tests directory you find some CMS/Frameworks "installed" in their typical setup.
Enter the document root and execute the located idnentity.php file to test the behaviour.
