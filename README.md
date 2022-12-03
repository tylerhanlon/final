COMPUTER SCIENCE STUDENT DATABASE CSC 436 FINAL
==============================================

If you have any questions ask me cause I ran into every possible problem when setting it up

Also this video tutorial was helpful, if you go to the guy's channel he has a playlist called "HTML Form with MySQL" The videos are a little out of order on the playlist but he walks thorugh everything.
https://www.youtube.com/watch?v=2HVKizgcfjo&list=PLtYTVIzWW8XE_f0yoaLwDNQ0MY3JNfPrj


XAMPP
=
In order to run the site, use XAMPP. It is a web stack package that allows you to connect front end to backend services. It installs Apache which lets you locally host a PHP web server. It also comes with its own version of mySql, which can be managed using myPHPADMIN. The download link is:

https://www.apachefriends.org/download.html

Any should work, just make sure you aren’t downloading one that says ‘VM’ or else it won’t let you edit the configurations for the services we need to use. 

This is pretty simple, but I had some issues with blocked ports when configuring it. To change the ports they are listening on, you need to change the configuration files for each service. This sounds complicated but I just looked up how to fix it and it didn't take that long.


SERVICES / RUNNING HTML ON LOCALHOST
=

Once you install it, you want to start the services mySQL and Apache. If it says the ports may be blocked, you can change the port they listen on in their respective configuration files. (I had to look it up to fix it).

In order to run the program on a localhost, create a folder inside the htdocs folder inside the xamppfiles folder (should be in C drive in windows or applications in Mac by default) or clone the GitHub repository into it so that it contains the html files and the php files. Call this folder anything. When all the services are running, you can open your browser and type in localhost/<foldername> and it should run the html.

I cloned this repository into Applications>XAMPP>htdocs when github desktop asked where I wanted to put it. To run the program, I just have to start Apache and MySQL from the XAMPP app and then type 'localhost/final' into my browser and it loads.


DATABASE CONNECTION
=

I made the code automatically configure databases when you register for the first time. It will create them on myPHP admin. This can be accessed by going to localhost/phpmyadmin in your browser. It allows you to do a lot of database management that a youtube video explains pretty quickly. Mainly its useful because we can just delete our database and the code will automatically recreate it.


GITHUB
=

I recommend using GitHub desktop and just cloning the repo from there, and putting the cloned repo into the htdocs file in the XAMPP directory.

When working make sure you use your own branch so we don't accidentally break anything in Master. Anything big we merge we should have eachother look at.

If you have anything you want to add/needs to be done, make an issue for it in the github. I think we should just use them as a "hey we need to make sure we fix this" and any of us can work on them to fix it aside from whatever we want to work on individually.

