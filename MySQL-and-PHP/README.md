MySQL and PHP setup instructions
================================


MAMP Setup for Mac
----------------------
1. Install [TextWrangler] (http://www.barebones.com/products/TextWrangler/download.html)
2. Install [MAMP] (http://mamp.info) on an administrator account.
3. Start the control panel at **/Applications/MAMP/MAMP** and click **Launch MAMP**
4. MAMP should start the Apache Server and MySQL Server automatically (see the green indicator under Status), and click **Open start page**
5. The start page is located at **http://localhost:8888/MAMP/**
6. Write your first PHP with TextWrangler (see the raw markdown file for the exact HTML code)
<h1>[Your name]'s homepage</h1>
, create a folder **howdy** under the **htdocs** folder and save the file as **/Applications/MAMP/htdocs/howdy/index.php**
7. Navigate your browser to http://localhost:8888/howdy/index.php
8. Edit the index.php file with (see the raw markdown file for the HTML and PHP code):

<h1>[Your name]'s homepage</h1>
<p>
<?php
   echo "Hi there.\n";
   $answer = 6 * 7;
   echo "The answer is $answer, what was the question again?\n";
?>
</p>
<p>Yes another paragraph.</p>

9. Save the file and refresh your browser.

Note: Watch Dr Chuck's [screencast] (https://www.youtube.com/watch?v=FC0DydeeTTk) for the walkthrough


XAMPP Setup for Mac (alternative to MAMP)
---------------------
1. Install [TextWrangler] (http://www.barebones.com/products/TextWrangler/download.html)
2. Install [XAMPP] (http://www.apachefriends.org/en/xampp.html)
3. Start the control panel at **/Applications/XAMPP/XAMPP Control Panel** and click **Start** for Apache and MySQL (see the green indicator). Click **OK"** if you did not set up the administrator password.
4. Navigate your web browser to http://localhost/
5. Navigate to **/Applications/XAMPP/htdocs**, and choose File -> Get Info in the Finder. Scroll to **Sharing & Permissions**, press the lock icon and change the permission for **admin** to "Read & Write". Re-lock ther dialog.
6. Write your first PHP with TextWrangler (see the raw markdown file for the exact HTML code)
<h1>[Your name]'s homepage</h1>
, create a folder **howdy** under the **htdocs** folder and save the file as **/Applications/XAMPP/htdocs/howdy/index.php**
7. Navigate your browser to http://localhost:8888/howdy/index.php
8. Edit the index.php file with (see the raw markdown file for the HTML and PHP code):
<h1>[Your name]'s homepage</h1>
<p>
<?php
   echo "Hi there.\n";
   $answer = 6 * 7;
   echo "The answer is $answer, what was the question again?\n";
?>
</p>
<p>Yes another paragraph.</p>
9. Save the file and refresh your browser.

Note: Watch Dr Chuck's [screencast] (https://www.youtube.com/watch?v=mzlvRFMNtHo) for the walkthrough

(To be completed)
