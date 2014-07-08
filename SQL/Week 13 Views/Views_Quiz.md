Views Quiz
===========================

Question 1
---------------------
Consider the following base tables. Capitalized attributes are primary keys. All non-key attributes are permitted to be NULL. 
```SQL
   MovieStar(NAME, address, gender, birthdate)
   MovieExecutive(LICENSE#, name, address, netWorth)
   Studio(NAME, address, presidentLicense#)
```
Each of the choices describes, in English, a view that could be created with a query on these tables. Which one can be written as a SQL view that is updatable according to the SQL standard? 

**Answer:** 
* A view "StudioPres" containing the license number, name, address, of all executives who are studio presidents. (Although views with more than one table in their top-level FROM clause are not updatable, we can write this view using one table in the top-level FROM clause and a subquery on a different table in the WHERE clause. Also, although net worth is omitted from the view, it is permitted to be NULL.)
* A view "NewYorkStudios" containing the names and addresses of all studios with addresses containing "New York".

**Explanation:** 
In order to be updatable according to the SQL standard, a view must: 

1.	Have only one table T in its top-level FROM clause 
2.	Not use SELECT DISTINCT in its top-level FROM clause 
3.	Include all attributes from T that do not permit NULLs 
4.	Not refer to T in subqueries 
5.	Not use GROUP BY or aggregation 

Eg.
* `A view "ExecutiveStar" containing the name, gender, and executive license number of all individuals who are both stars and executives.` This view requires more than more one table in its top-level FROM clause, making it not updatable.
* `A view "StudioPresInfo" containing the studio name, executive name, and license number for all executives who are studio presidents.` This view requires more than more one table in its top-level FROM clause, making it not updatable.
* `A view "GenderBalance" containing the number of male and number of female movie stars.` Views involving aggregation are not updatable.
* `A view "RichExecInfo" containing the name, address, and net worth of all executives with a net worth of at least $10,000,000.` License number is a primary key for MovieExecutive; its value cannot be NULL, and thus it must be included in any view over MovieExecutive.
* `A view "NewYorkWealth" containing the average net worth of movie executives whose address contains "New York".` Views involving aggregation are not updatable.
* `A view "SameBirthday" containing pairs of movie star names where the movie stars have the same birthdate.` This view requires two instances of MovieStar in its top-level FROM clause, making it not updatable.
* `A view "Birthdays" containing a list of birthdates (no duplicates) belonging to at least one movie star.` Name is a primary key for MovieStar; its value cannot be NULL, and thus it must be included in any view over MovieStar. Furthermore, the view requires SELECT DISTINCT.

Question 2
--------------------
Consider the following schema: 
```SQL
  Book(ISBN, title, year) // ISBN and title cannot be NULL
  Author(ISBN, name) // ISBN and name cannot be NULL
```  
and the following view definition over this schema: 
```SQL
  Create View V as
    Select Book.ISBN, count(*)
    From Book, Author
    Where Book.ISBN = Author.ISBN
    And Author.name Like 'A%'
    And Book.year > 2000
    Group By Book.ISBN
```
This view is not updatable according to the SQL standard, for a number of reasons. Which of the following is a valid reason for the view being non-updatable according to the standard? 

**Answer:** 
* Use of aggregate function COUNT. (Updatable views cannot include GROUP BY or aggregation.)
* Use of GROUP BY. (Updatable views cannot include GROUP BY or aggregation.)
* NULL values are not permitted in Book.title. (Attributes not permitted to have NULLs must be retained in updatable views.)
* Two tables in FROM clause. (Updatable views must have only one table in their top-level FROM clause.)

**Explanation:** 
In order to be updatable according to the SQL standard, a view must: 

1.	Have only one table T in its top-level FROM clause 
2.	Not use SELECT DISTINCT in its top-level FROM clause 
3.	Include all attributes from T that do not permit NULLs 
4.	Not refer to T in subqueries 
5.	Not use GROUP BY or aggregation 

Question 3
--------------------
Suppose a table T(A,B,C) has the following tuples: (1,1,3), (1,2,3), (2,1,4), (2,3,5), (2,4,1), (3,2,4), and (3,3,6). Consider the following view definition: 
```SQL
   Create View V as
     Select A+B as D, C
     From T
```
Consider the following query over view V: 
```SQL
   Select D, sum(C)
   From V
   Group By D
   Having Count(*) <> 1
```
Which of the following tuples is in the query result? 

**Answer:** 
* (3,7)
* (5,9)
* (6,7)

**Explanation:** 
First compute the tuples in V(D,C) based on the tuples in T. V contains: {(2,3), (3,3), (3,4), (5,5), (6,1), (5,4), (6,6)}. In the query over V there are grops for D = 2, 3, 5, and 6. All groups pass the Having clause except D=2. Sum the C attributes in each of the remaining groups to get the final result: {(3,7), (5,9), (6,7)}.

