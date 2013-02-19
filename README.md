This is a simple CRUD application developed while studying for Zend PHP Certification. 

* Please view erd.png in the root directory for the planned database structure. 

CURRENT FUNCTIONALITY - 

*Homepage*
-Creates 'agents' via 'Agents Sign up Here'.
-Uses MySQL COUNT to show quantity of Agents in the Database. 
-Displays each 'agents' name and date registered.

*Admin*
-Allows user to Edit, Delete and view information about each 'agent'.

*Change Agent Password*
-Allows password change.

*Login/Logout*
-Created functionality using SESSION.

*Contact Page*
- Created a simple contact form using the mail() function

*Improved Security Features*
-Added Security to the Login/Logout by storing HTTP_USER_AGENT in login.php and validating in loggedin.php.
- Added spam_scrubber() function to contact.php to eliminate common spamming techniques



*Common Functionality -
-Sortable Table of MySQL Database Query Results with Pagination.


- FUTURE PLANS - 

My study of Objective-C, JavaScript and Ruby has given me an appreciation for Object Oriented Programming. Currently, this PHP code is using Procedural programming but I am in the process of learning and updating to OOP.

-I will use a framework, ZEND Framework 2.0, to update the codebase.

*Buyers*
-The next step is for each 'agent' to create 'buyers' in the system. The index page will have a search module and results will paginate.

* Adding upload functionality for each agent to upload .pdf contracts for a buyer.



