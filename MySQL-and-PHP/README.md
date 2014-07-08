MySQL and PHP setup instructions
================================

MAMP Setup for Mac
----------------------
1. Install [TextWrangler] (http://www.barebones.com/products/TextWrangler/download.html)
2. Install [MAMP] (http://mamp.info) on an administrator account.
3. Start the control panel at **/Applications/MAMP/MAMP** and click **Launch MAMP**
4. MAMP should start the Apache Server and MySQL Server automatically (see the green indicator under Status), and click **Open start page**
5. The start page is located at **http://localhost:8888/MAMP/**
6. Write your first PHP with TextWrangler `<h1>[Your name]'s homepage</h1>`
, create a folder **howdy** under the **htdocs** folder and save the file as **/Applications/MAMP/htdocs/howdy/index.php**
7. Navigate your browser to http://localhost:8888/howdy/index.php
8. Edit the index.php file with `<h1>[Your name]'s homepage</h1><p><?php echo "Hi there.\n"; $answer = 6 * 7; echo "The answer is $answer, what was the question again?\n"; ?></p><p>Yes another paragraph.</p>`
9. Save the file and refresh your browser.


**Note**: Watch Dr Chuck's [screencast] (https://www.youtube.com/watch?v=FC0DydeeTTk) for the walkthrough


XAMPP Setup for Mac (alternative to MAMP)
---------------------
1. Install [TextWrangler] (http://www.barebones.com/products/TextWrangler/download.html)
2. Install [XAMPP] (http://www.apachefriends.org/en/xampp.html)
3. Start the control panel at **/Applications/XAMPP/XAMPP Control Panel** and click **Start** for Apache and MySQL (see the green indicator). Click **OK"** if you did not set up the administrator password.
4. Navigate your web browser to http://localhost/
5. Navigate to **/Applications/XAMPP/htdocs**, and choose File -> Get Info in the Finder. Scroll to **Sharing & Permissions**, press the lock icon and change the permission for **admin** to "Read & Write". Re-lock ther dialog.
6. Write your first PHP with TextWrangler `<h1>[Your name]'s homepage</h1>`
, create a folder **howdy** under the **htdocs** folder and save the file as **/Applications/XAMPP/htdocs/howdy/index.php**
7. Navigate your browser to http://localhost:8888/howdy/index.php
8. Edit the index.php file with `<h1>[Your name]'s homepage</h1><p><?php echo "Hi there.\n"; $answer = 6 * 7; echo "The answer is $answer, what was the question again?\n"; ?></p><p>Yes another paragraph.</p>`
9. Save the file and refresh your browser.

**Note**: Watch Dr Chuck's [screencast] (https://www.youtube.com/watch?v=mzlvRFMNtHo) for the walkthrough. For Windows users, watch this [screencast] (https://www.youtube.com/watch?v=msF-XcJk3Bc).


Building a CRUD Application
-----------------------------
1. Create a MySQL table, MySQL user (i.e. using GRANT), and create a PHP application that performs a create, read, update and delete operation. 
2. The data model is about contact information for your friends in a table named "contacts" . You have an auto increment field named "id", a name, email address, phone number, and zip code. All the fields should be strings.
3. When you are adding or editing a contact, all fields are required. If any of the fields are empty or blank, you should issue an error message and redirect to the index.php file where the error message is to be shown in red above the list of contacts.
4. When you successfully complete the INSERT, DELETE, or UPDATE operation, you should redirect to the main mage with an appropriate success message that is to be shown in green above the list of contacts.
