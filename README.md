# PHP module final exam solution

- Web programming using PHP
- 5 August 2018
- FMA DEVELOPMENT LOG

Nicola D&#39;Aniello

## Introduction

This is my solution to the PHP module final exam for my CS degree.
The exam consisted in creating a secure intranet home page in PHP and HTML for the unversity department of CS.

The requirements can be found in the _requirements.pdf_ file.

The final project is available online at:
[http://titan.dcs.bbk.ac.uk/~ndanie03/p1fma/index.php](http://titan.dcs.bbk.ac.uk/~ndanie03/p1fma/index.php)

### Files Structure

Public access files:

- .root/public_www/p1fma/index.php
- .root/public_www/p1fma/admin.php
- .root/public_www/p1fma/login.php
- .root/public_www/p1fma/logout.php
- .root/public_www/p1fma/secured/index.php
- .root/public_www/p1fma/secured/DTresults.php
- .root/public_www/p1fma/secured/P1results.php
- .root/public_www/p1fma/secured/PfPresults.php

Include functions files:

- .root/public_www/p1fma/include/functions.php
- .root/public_www/p1fma/include/validate-functions.php
- .root/public_www/p1fma/include/user-functions.php
- .root/public_www/p1fma/include/db-functions.php

Other include files:

- .root/public_www/p1fma/include/header.php
- .root/public_www/p1fma/include/footer.php
- .root/public_www/p1fma/include/login-form.php
- .root/public_www/p1fma/include/register-form.php

Private files:

- .root/php
- .root/php
- .root/private/users-db.txt

### Site Map

- .index.php
- .admin.php
- .login.php
- .logout.php
- ./secured/index.php
- ./secured/DTresults.php
- ./secured/P1results.php
- ./secured/PfPresults.php

# Documentation

## Sprints

The work has been divided in the following way:

1. Create each page required in the specifications;
2. Create common Header and Footer for each page;
3. Create Login and Registration forms;

4. Implement Sessions and Login;
5. Implement Authentication and restrict access to secured pages;
6. Implement Authorisation and restrict access to admin page;

7. Create Database to store users (user-db.txt);
8. Implement Database functions (db-functions.php);
9. Refractor Login to use database functions;
10. Implement User Registration with database functions;

11. Implement forms and inputs Validation;
12. Refractor User related functions in its own file (user-functions.php);
13. Refractor Validation functions in its own file (validate-functions.php);

14. Test on Server;
15. Implement settings file to easier debugging on localhost or server (settings.php);
16. Refractor common initialisation functions in its own file (bootstrap.php);

17. Refractor folder structure: implement public and private access folders to improve security;

## Problems Encountered

Database Issues

In order to store users without using existing database services I created a simple file structure that would store each user by line, and each user field separated by a comma. The structure used is the following:

&#39;title&#39;, &#39;first_name&#39;, &#39;surname&#39;, &#39;email&#39;, &#39;username&#39;, &#39;password&#39;, &#39;is_admin&#39;

In order for the script to work the user-db file has to exist and have only one line containing the admin user data.

To prevent the database from being corrupted (e.g. having commas or new lines in the inputs from the user) two functions have been implemented to serialise and deserialise data moved in and out of the database.

Another risk was having two users with the same username, as the script would only find the first user in the file with such a name. To solve this issue the script assess that newly created users have a unique username.

One more security issue is having the data in the database not encrypted, especially user passwords. Since the requirements didn&#39;t specify, the data is stored in clear text inside the database.

Code Standards

To keep a more clean and consistent code, and to solve the issue of having to send any header (e.g. for redirects) before content, all files are divided in two sections: on the top the logic of the page and on the bottom all the printing functions.

Always to keep a clean code standard, most of the comments in the files are placed on top of the block of code they are describing. This was done while trying to implement an easy-to-read and and self-describing code, as it seemed a better way rather then placing comments on each line.

Exception Handling

Some functions implement exception handling to present errors to the user, rather then using nested if-else blocks. This is to keep a more clean and consistent code.

validate-functions.php

if (\$value ===&#39;&#39;)

        thrownewException(&#39;Title is required and cannot be empty.&#39;);

login.php

catch(Exception \$e) {

    $errors[] = $e-\&gt;getMessage();

One problem with this approach is that the catch blocks will get any error including PHP internal errors that use the common _Exception_ class or its subclasses.

To solve this issue would have been enough to create and catch specific subclasses of _Exception_ (e.g. replace Exception with _TitleMissingException_ for the example above). This solution tough has not been implemented as it seemed to me to go behind the scope and requirements for this exam.

File Structure

To improve on security the _settings.php_, _bootstrap.php_ and the user database _user-db.txt_ files have been placed outside the /_public_www/_ directory. This required changing the chmod of the files in order to be included in the scripts in the /_public_www/_ directory.

The script will work both on local (tested on MAMP) and on server side by simply changing two lines in the _settings.php_ file.

The addressor dcs titan is:

[http://titan.dcs.bbk.ac.uk/~ndanie03/p1fma/index.php](http://titan.dcs.bbk.ac.uk/~ndanie03/p1fma/index.php)

Final Note

The script will not work with cookies disabled. I tried to implement SID url propagation for users with disabled cookies, by writing each link with the SID constant:

\&lt;ahref=&quot;\&lt;?phpecho\_\_BASEURL\_\_.&#39;?&#39;.SID?\&gt;index.php&quot;\&gt;home\&lt;/a\&gt;

and by implementing the redirect() function with using the SID.

header(&#39;location: &#39;.\_\_BASEURL\_\_.&#39;?&#39;.SID.\$url);

The issue was that the constant was always empty, both in local or server, even after changing the php.ini settings.

One last try was to change settings right into the bootstrap.php file:

ini_set(&quot;session.use_cookies&quot;,false);

ini_set(&quot;session.use\_\_only_cookies&quot;,false);

ini_set(&quot;session.use_trans_sid&quot;,true);

but the SID constant would keep returning an empty string.

Since I didn&#39;t solve the issue, the solution has not been implemented.
