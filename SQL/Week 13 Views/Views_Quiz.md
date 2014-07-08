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
* A view "StudioPres" containing the license number, name, address, of all executives who are studio presidents. 
(Although views with more than one table in their top-level FROM clause are not updatable, we can write this view using one table in the top-level FROM clause and a subquery on a different table in the WHERE clause. Also, although net worth is omitted from the view, it is permitted to be NULL.)

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
