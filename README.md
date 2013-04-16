# Pakistan Constituency Information Platform

This platform provides an opertunity to gather data, in the form of tag value pairs, related to the constituency of Pakistan. 

## INSTALLATION

1. Creating Database
Create a mysql database 'pcip'. Import tables in the database using the schema from the following path 

  pcip/protected/data/pcip.sql

2. Configuring Database Connection
You can configure the database name, username, password in 

  pcip/protected/config/main.php

3. Deployment To Web Server
Host all files in the pcip folder to any web server.    

## REQUIREMENTS

Hosting site requires mysql database and php. Backend is based on the Yii 1.1.13 framework and its requirments can be checked by opening the following path

  http://hostname/yii/requirements/index.php

Client side requires a web browser with Flash Player 11.0 or greater.

## QUICK START

1. Creating Users
Use the following url to manage users, only admin user can access this url.     

  http://hostname/service.php/User

NOTE: In order to create a readonly user set its type to 'demo'.

2. Creating Layers and Tags   
Use the following url to manage layers and tags, only admin user can access this url.

  http://hostname/service.php/Layer

3. Adding Data
   
Use the following url to open the front end application to enter data against tags. 

  http://hostname/

* Goto File->Log In to login to the platform.
* Select Layer for which you want to add data.
* Select Seat from the map on right
* Select Tag
* Enter Value and press enter

## DEVELOPMENT GUIDE

Source of this project contains three folders map, pcip and pcipapp. 

'map' contains all intermediate images which i used to create a final map.svg. 
'Original.gif' is the source image which was used to create a vectorized map of 
pakistan contituencies. Final map has four layers. Layer1 contains map sketches of 
each province. Layer2 contains the  filled region. Layers 3 contains lables or text.
Layer4 contains the gray areas used to outline the zoomed constituencies. 'Inkscape' 
was used to create all the svg images.

'pcip' contains the complete server side code for hosting and managing database. 
It provides a jason response to queries generated from flash. It also contains 
the eclipse project so you can just import it in eclipse.

'pcipapp' is a flash builder project. Flex framework 4.5.0 was used to build the 
flash output. SVG images are not supported by default in flash. An as3 svg renderer
was used from the following link (https://github.com/LucasLorentz/AS3SVGRenderer)
Their licence can be found in 'pcipapp/src/libs'. 

## LICENSE

Licensed under the MIT License.  
http://opensource.org/licenses/mit-license.php
