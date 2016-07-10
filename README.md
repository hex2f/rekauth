# rekauth

An open source token based authentication system for PHP

## Setup

####First you need to make a database for your rekauth table.

1. Create the new database to hold rekauth
> ```create database <Database Name Here>;```

2. Then switch to your new database
> ```use <Database Name Here>;```

3. Great! Now we need to make the tables that hold all of our data. At this point you need to decide how long your usernames can be. 

4. Done? Okay, Let's make the table! I want you to just copy and paste this into your database terminal and edit the value of userid's varchar (It's maked with a * where you need to edit). Okay?
> ```create table users (userid varchar(*), passhash varchar(255), mail varchar(255), lastseen timestamp, registered timestamp)```

5. Now add a ; and press enter. Now paste this into the console (and edit the * to the same value as the last one.)
> ```create table tokens (user varchar(*), expire timestamp, token varchar(265))```

6. Now, once again, add a ; and press enter. You're done! Hooray! (At least on the database side of things.)

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
####Login

**How do i implement rekauth/login**? Simple, You just have a form with two text fields and **POST** it to rekauth/login.php

######Post names
> Username = u

> Password = p

######Example
> ```<form action="rekauth/login.php" method="POST"> ```

>```  Username: <input name="n" type="text"/> ```

>```  Password: <input name="p" type="password"/> ```

>```  <input type="submit" value="login"/> ```

>``` </form> ```

If login is successful it will set a cookie with the access token (You use this to verify the user instead of username and password in you application). If failed it will return the error string you made in *rekauth/config.php*.
*(If you are using JS only in your app you can add 'echo $token' in the login system on line 62 and 67 then save the token with localStorage)*

####Register

**How do i implement rekauth/register?** Simple, You just have a form with two text fields and **POST** it to rekauth/login.php

######Post names
> Username = u

> Password = p

> Password Confirm = pc

> Mail = m

> Mail Confirm = mc


######Example
> ``` <form action="rekauth/register.php" method="POST"> ```

>```  Username: <input name="n" type="text"/> ```

>```  Password: <input name="p" type="password"/> ```

>```  Confirm Password: <input name="pc" type="password"/> ```

>```  Email: <input name="m" type="email"/> ```

>```  Confirm Email: <input name="mc" type="email"/> ```

>```  <input type="submit" value="login"/> ```

>``` </form> ```

If registration was successful it will save the [Password Hash](https://en.wikipedia.org/wiki/Cryptographic_hash_function) and all other user details to your database then redirect the user to the login page you set in *rekauth/config.php* where they can login to get their access token.

####Using tokens

If the user successfully compleats a login they will recive an access token (Default: Stored in a cookie by the name of 'token').
This should be used to authticate the user when preforming functions inside your application instead of username and password.

######Table Names
>'user': The username the token is assigned to.

>'expire': The timestamp the token will expire.

>'token': The access token.

######Example
Say you want to get the username the token is assigned to.

> ``` $dbquery = $conn->prepare("SELECT * FROM tokens WHERE token = :token"); ```

> ``` $dbquery->execute(array("token"=>$_COOKIE["token"])); ```

> ``` $result = $dbquery->fetchAll(); ```

> ``` $myusername = strtolower($result[0]["user"]); ```

Now you can use ```'$myusername'``` to access data in other tables from your database.

**THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.**

*© 2016 Hampus Lundqvist*
