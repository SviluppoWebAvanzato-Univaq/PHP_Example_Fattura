# PHP_Example_Fattura
> Example RESTful API "Fattura" (Invoice) developed with PHP7 and the Slim Framework

 This is the full implementation of the "Fattura" (invoice) RESTful API developed during the course lectures. It shows how to model the service in PHP using the minimal Slim framework.
 
## Usage

This is a *sample application* developed during the lectures of the  [**Sviluppo Web Avanzato course**](https://sviluppowebavanzato-univaq.github.io). The code is organized to best match the lecture topics and examples. It is not intended for production use and is not optimized in any way. 

*This example code will be shown and described approximately during the 10th lecture of the course, so wait to download it, since it may get updated in the meanwhile.*

## Installation

1. Install Composer (<https://getcomposer.org/>) 

2. Copy the project in a folder inside your web root

3. Execute the command "composer install". This will download and install all the dependencies in the vendor/ directory. Later you can use the "composer update" command to update them. 

4. The entry point (from which the urls specified by src/slim_routes.php are mapped) is \<project_directory\>/public/ 

Note: If you use a browser to test the urls, comment in Fattura_Server_Interface.php the lines that perform type checks 
(Accept header), otherwise none of the requests sent via the browser may be served.

## Forking a new application

1. Install Composer (<https://getcomposer.org/>) 

2. Create a directory for your project and enter the directory

3. Create the /log directory

4. Create the /public directory and, within it, create or copy the files index.php and .htaccess 

5. Create the /src directory and, within it, create or copy the files of the slim service and configuration logic 

6. Create the composer.json file with a configuration similar to this example. You can also use the "composer init" command to automatically create most of the file, taking care to specify the "slim/slim" and "monologue/monologue" packages as requirements.

Then proceed from step (3) of the installation procedure above.


---

![University of L'Aquila](https://www.disim.univaq.it/skins/aqua/img/logo2021-2.png) 
