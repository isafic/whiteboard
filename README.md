# WHITEBOARD

##### A web-app for managing projects and ideas, built for both teams and individuals.

##### Available in English and Hungarian.

The software is web-based so you will need an Apache server as well as access to a MySQL Database. 

Currently, there is no user-registration/account system to anyone accessing the website will be seeing the same data. Unforuntately I don't have a web server so I cannot demo it for you.

### Explanation of features:

* Add new tasks to the *Incoming* section by clicking the '+' button and filling out the form. 
* Existing entries can be edited using the yellow edit button and viewed using the blue eye button.
* All text has HTML markup support
* Clicking the red X button delete the entry from the database.
* The green checkmark button will move the entry into the next category (i.e. *Waiting* -> *Ongoing*)

### Prerequisites
* Apache 2
* MySQL Database

### Installation
1. Copy files onto your Apache server
2. In your browser, navigate to `/install/`.
3. Enter your MySQL login information into the form on the page.
4. Click "Login" and check the output on the right side of the page to ensure that everything was done correctly.
5. Delete the `/install/` folder if you wish.

**Important Note:** If you ever change your MySQL login information, you will need to re-do the installation. 

### To-do:
* ~~Create a more streamlined installation process~~
* ~~Give entries an "owner" property~~
* ~~Work out some localisation system that isn't just an entirely seperate copy of the program in a different language~~
* ~~Add a settings page where you can change the language easily~~
* Markdown support
* Add functionality for multiple "whiteboards" in the same database
* Make whiteboards accessable by name and password (user accounts)
* Image support
* Modal simplification (less modals written)
