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
     http://orep.manyu.in/changerep?siteid=<siteid>&sitekey=<apikey>&usid=<usid>&tag="string"&points=<"integer as string">
returns
{"Result":"Y"} or {"Result":"N","error":""}


There are two types of tags, ORep_ tags which are fixed, and for stuff like spamming, selfpromotion,ettiquette etc.

 


Getting point 
=============
just a call to 
     http://orep.manyu.in/changerep?siteid=<siteid>&sitekey=<apikey>&usid=<usid>&tag="string1,string2,string3,string4"
{"Result":"Y", 
 "Global":<Global Rep>,
 "Sum":Sumofstringreps,
 "Rep" : [
 "string1" : S1Rep,
 "string2" : S2Rep,

...

]}
  








http://demo.manyu.in/orepreg.php?ssid=0skjo8yohjp8pjjpousoiuy9kjdfho8o8dsgdfg4tb

