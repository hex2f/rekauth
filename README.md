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
