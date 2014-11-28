Database applications
============

Repository for database applications

###Change Couinting Game:
A PHP/MySQL project in collaboration with Cynthia Wilkinson of the New Morning School in Plymouth, MI, to design an interactive change counting game for her 4th grade students. The students will log in and choose an easy, medium or hard scenario. In each scenario, the students have $20 and must purchase one object from 4 categories of magical objects (exlixirs, eggs, sands and portions). Once the students have selected the item they want to purchase, the cave hermit will ask them for the exact change they are owed after the purchase. Students must input the correct amount, or be asked to try again if they enter the wrong amount. HTML, CSS and Javascript was used for the front-end development, whereas PHP and MySQL was used for the backend support. 

After logging in, the student picks an easy, medium, or hard scenario. In each scenario, the student has $20 dollars and must purchase one object from four categories of magical objects: elixirs, eggs, sands, and potions: 
![store-front.png](https://github.com/shngli/Database-apps/blob/master/Change%20Counting%20Game/store-front.png)

The student selects the item they want to buy, which brings up the cave hermit who needs to give back change for their purchase. His math skills are fuzzy, and he needs help determining the right amount:
![purchase.png](https://github.com/shngli/Database-apps/blob/master/Change%20Counting%20Game/store-front.png)

The student must input the correct change they are owed after purchasing the item. If the wrong amount is entered, they are asked to try again, and if it becomes too challenging, they can simply put the item back. These items are from the “easy” setting, which uses whole dollar amounts. In medium and hard difficulties, the prices go to tens of cents and then to exact penny amounts.

The main chunks that needed to be coded to build the game were:

1. The cave interface, featuring a background, shelves, items, and a hermit.
2. A database to hold user information and another for game objects.
3. A form for the user to input change.

Everyone was involved in coding the PHP portions of the game, while also handling more specific roles: I was in charge of the backend database of the game (changegame.sql) using MySQL, which involved storing user login information and game values for the game's calculations to be functional.

Contributors: Chisheng Li, Greg Cunningham, Michelle Brennan

###MySQL-and-PHP:
Php and Mysql codes to build a CRUD application.

###Querying XML:
Basic XQuery codes to query XML documents.

###SQL:
Lecture notes, SQL codes and quizzes on the basics of database applications.

###References:
1. **Learning PHP, MySQL, JavaScript, and CSS: A Step-by-Step Guide to Creating Dynamic Websites (Second Edition)** by Robin Nixon. 
2. **A First Course in Database Systems (3rd edition)** by Ullman and Widom
3. **Database Management Systems (3rd edition)** by Ramakrishnan and Gehrke
4. **Fundamentals of Database Systems (6th edition)** by Elmasri and Navathe
5. **Database System Concepts (6th edition)** by Silberschatz, Korth, and Sudarshan
