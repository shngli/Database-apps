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
•	Have only one table T in its top-level FROM clause 
•	Not use SELECT DISTINCT in its top-level FROM clause 
•	Include all attributes from T that do not permit NULLs 
•	Not refer to T in subqueries 
•	Not use GROUP BY or aggregation 
