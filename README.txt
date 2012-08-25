===ORep===
An open user reputation platform on the lines of OAuth


Registering
===========

Connect will hyperling to the 
http://demo.manyu.in/orepreg.php


This php file  will call
    http://orep.manyu.in/getsessionkey.php?siteid=<siteid>&sitekey=<apikey>


The return is just a simple JSON
{"Result":"Y","ssid":"<ssid>"}
or
{"Result":"N"}

If return is successfull it just gives a simple php redirect to 
     http://orep.manyu.in/registeruser.php?ssid=<ssid>
if the user is not logged in then it asks for username and password, and logs him in , and also connects him. 
if the user is logged in then it asks if the user needs to connect it. 

The site will redirect back to 
     http://demo.manyu.in/orepreg.php?done=1&ssid=<ssid>
which calls 
     http://orep.manyu.in/getuserkey.php?ssid=<ssid>
The return is just a simple JSON
{"Result":"Y","usid":"<usid>"}
or
{"Result":"N"}

Changing Point
==============

just a call to 
     http://orep.manyu.in/changerep.php?siteid=<siteid>&sitekey=<apikey>&usid=<usid>&tag="string"&points=<"integer as string">
returns
{"result":"Y"} or {"result":"N","error":""}




Getting point 
=============
just a call to 
     http://orep.manyu.in/changerep.php?siteid=<siteid>&sitekey=<apikey>&usid=<usid>&tag="string1,string2,string3,string4"&mysiteonly=1


{"result":"Y", 
 "global":<Global Rep>,
 "mySite":<Site Rep>,   
 "sum":Sumofstringreps,   // Sum of global tag is mysiteonly=0, else specific to the site tags
 "rep" : [
 "tag1" : S1Rep,
 "tag2" : S2Rep,

...

]}
