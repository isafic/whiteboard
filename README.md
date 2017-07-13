# WHITEBOARD

##### A web-app for managing projects and ideas, built for both teams and individuals.

The software is web-based so you will need an Apache server as well as access to a MySQL Database. 

Currently, there is no user-registration/account system to anyone accessing the website will be seeing the same data. 

### Explanation of features:

* Add new tasks to the *Incoming* section by clicking the '+' button and filling out the form. 
* Existing entries can be edited using the yellow edit button and viewed using the blue eye button.
* Clicking the red X button delete the entry from the database.
* The green checkmark button will move the entry into the next category (i.e. *Waiting* -> *Ongoing*)

### Prerequisites
* Apache 2
* MySQL Database

### Installation
1. Copy files onto your Apache server
2. Create a MySQL database. Make sure to update the variables `$host`, `$user`, `$pass` and `$dbname` in `functions\panels.php` and `form-handling.php`.
3. Create a table called `whiteboard_data`. If you want a different name, make sure to change `functions\panels.php` and `form-handling.php`.
4. Done!

### Explanation of different files:
* `index.php` is the main webpage
* `form-handling.php` is the backend file. this file handles all of the forms in `index.php` and is also the file that queries the database
* `functions\addIncoming.php` contains HTML code used when the user adds new entries to the database
* `functions\interactWithDatabase.js` contains all of the Javascript functions used by `index.php`.
* `functions\panels.php` contains all of the PHP functions used by `index.php`

### To-do:
* Create a more streamlined installation process
* Give entries an "owner" property
* Add functionality for multiple "whiteboards" in the same database
* Make whiteboards accessable by name and password