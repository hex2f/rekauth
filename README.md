# rekauth

An open source token based authentication system for PHP

## Setup

####First you need to make a database for your rekauth table.

1. Create the new database to hold rekauth
> ```create database <Database Name Here>;```

2. Then switch to your new database
> ```use <Database Name Here>;```

3. Great! Now we neet to make the tables that hold all of our data. At this point you need to decide how long your usernames can be. 

4. Done? Okay, Let's make the table! I want you to just copy and paste this into your database terminal and edit the value of userid's varchar (It's maked with a * where you need to edit). Okay?
> ```create table users (userid varchar(*), passhash varchar(255), mail varchar(255), lastseen timestamp, registered timestamp)```

5. Now add a ; and press enter. Now paste this into the console (and edit the * to the same as the last one.)
> ```create table tokens (user varchar(*), expire timestamp, token varchar(265))```

6. Now, once again, add a ; and press enter. You're done! Horray! (At least on the database side of things.)

####Now we need to setup the authentication system in PHP.
*Note: Make sure your server is running at least PHP 5.*

1. Copy the rekauth folder to your project.

2. Open the config.php file (Inside the rekauth folder) in your favorite text editor.

3. First we need to edit the Database Settings.
> *$servername should be the ip to your database.*
*$username and $password needs to be the login to your database.*
*And $dbname has to be the same to the one we mede in out first command when setting up the database.*

4. Now just go through everything and change it to your needs. They should be named pretty logicaly, so i think you can figure it out. **Note: Do not chang the $password_encrypt_cost unless you know what you are doing.**

5. And after that, well, you're done! Now follow the steps bellow to see how to use rekauth.

##Using rekauth
*This section is not done yet*
