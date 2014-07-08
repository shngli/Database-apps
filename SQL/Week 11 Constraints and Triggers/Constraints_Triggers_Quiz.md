Constraints and Triggers Quiz 
===========================

Question 1
------------------
Consider the following SQL table declaration: 
```SQL
   CREATE TABLE R (a INT, b INT, c INT, CHECK( [fill-in] ));
```
Currently R contains the tuples (1,4,14), (2,3,15), and (3,3,16). Which of the following tuple-based CHECK constraints will cause the following insertion to be rejected? 
```SQL
   INSERT INTO R VALUES (4,4,9);
```
Note: When a tuple-based check is invoked for an insert and includes a subquery over the same table, the subquery is evaluated on the table including the inserted tuple. 

**Answer:** 
* c >= (SELECT SUM(b) FROM R)
* a < (SELECT MAX(b) FROM R)
* a < (SELECT COUNT(c) FROM R)

**Explanation:** 
The insertion is rejected when the CHECK condition is false. Note that an attribute mentioned outside of a subquery refers to the inserted tuple. Substititue the inserted tuple's values for those variables, and evaluate the expression over the table; make sure to include the inserted tuple in any subqueries. Thus, for example, SUM(b) currently has the value 14 (including the inserted tuple), COUNT(c) has the value 4, and the result of "SELECT b+c FROM R" is {18,18,19,13}.

Eg.
* `c <= ALL (SELECT b + c FROM R)` Check this condition substituting the inserted tuple value for c and evaluating the subquery on R including the inserted tuple.
* `b < (SELECT MIN(c) FROM R)` Check this condition substituting the inserted tuple value for b and evaluating the subquery on R including the inserted tuple.
* `b > (SELECT AVG(a) FROM R)` Check this condition substituting the inserted tuple value for b and evaluating the subquery on R including the inserted tuple.
* `c > ALL (SELECT a + b FROM R)` Check this condition substituting the inserted tuple value for c and evaluating the subquery on R including the inserted tuple.
* `a <= ALL (SELECT c - b FROM R)` Check this condition substituting the inserted tuple value for a and evaluating the subquery on R including the inserted tuple.

Question 2
---------------------
Consider the following trigger over a table R(a,b), specified using the trigger language of the SQL standard: 
```SQL
   CREATE TRIGGER Rins
   AFTER INSERT ON R
   REFERENCING NEW ROW AS new
   FOR EACH ROW
   INSERT INTO R(a,b)
     (SELECT DISTINCT R.a, new.b
      FROM R
      WHERE R.b = new.a)
     EXCEPT
     (SELECT DISTINCT a,b FROM R)
```
Suppose table R is empty initially. We issue three commands to insert tuples into R: first we insert (1,2), then we insert (2,3), then we insert (3,4). After some of these inserts, trigger Rins may insert further tuples into R, which may activate the trigger recursively. After all the inserts are done, which of these tuples is NOT in table R? 

**Answer:** 
* (3,1)
* (4,3)	
* (3,2)

**Explanation:**

The trigger looks for existing tuples with a b value equal to the a value of the newly inserted tuple. It inserts new tuples with a values from the matching existing tuples and the b value from the new tuple. The EXCEPT part ensures that tuples are not inserted when the same tuple is already present. 
Inserting (1,2) does not trigger the insertion of any other tuples. Inserting (2,3) triggers the insertion of (1,3), since the new a value of 2 matches the b value of the existing tuple (1,2). Inserting (1,3) does not (recursively) trigger the insertion of any other tuples. Inserting (3,4) triggers the insertion of (1,4) and (2,4), since the new a value of 3 matches the b value of the existing tuples (1,3) and (2,3). Inserting (1,4) does not (recursively) trigger the insertion of any other tuples. Inserting (2,4) (recursively) triggers the insertion of (1,4), since the new a value of 2 matches the b value of the existing tuple (1,2), but (1,4) is already present so a new copy is not inserted. 

Eg.
* (1,4). The trigger looks for existing tuples with a b value equal to the a value of the newly inserted tuple. It inserts new tuples with a values from the matching existing tuples and the b value from the new tuple. Check what happens when (3,4) is inserted.
* (1,3). The trigger looks for existing tuples with a b value equal to the a value of the newly inserted tuple. It inserts new tuples with a values from the matching existing tuples and the b value from the new tuple. Check what happens when (2,3) is inserted.
* (2,4). The trigger looks for existing tuples with a b value equal to the a value of the newly inserted tuple. It inserts new tuples with a values from the matching existing tuples and the b value from the new tuple. Check what happens when (3,4) is inserted.

Question 3
----------------------
Consider the following SQL table declaration: 
```SQL
   CREATE TABLE Emps (id INT, ssNo INT, name CHAR(20), managerID INT);
```
We would like to extend the table declaration to enforce that each of id and ssNo is a key (by itself), and each value of managerID must be one of the values that appears in the id attribute of the same table. Which of the following is not a legal addition of SQL standard key and/or foreign-key constraints? Note: The addition does not have to achieve all of the stated goals; it only must result in legal SQL. 

**Answer:** 
* Add ", FOREIGN KEY (managerID) REFERENCES Emps(id)" before the closing parenthesis. A foreign key must reference a declared key. While id is intended to be a key, we have not declared it as such in this modification.
* Add "PRIMARY KEY" after each of the first two INT's. You cannot have two primary keys in a table.
* Add "UNIQUE" after each of the first two INT's, and add "REFERENCES Emps(id,ssNo)" before the closing parenthesis. A foreign key must reference a declared key. In this case, both id and ssNo are declared as keys by themselves, but (id,ssNo) is not declared to be a key (even though it must be one).

**Explanation:** 
The correct answers (i.e., incorrect SQL) violate one of two rules: 
1.	You cannot have two primary keys (although you can have many "uniques"). 
2.	A foreign key can only reference an attribute that is a key (either primary key or unique). 

Eg.
* Add "PRIMARY KEY" after the first INT, and add "REFERENCES Emps(id)" before the closing parenthesis. This choice is correct SQL. We have set up a primary key and a foreign key that references it. This change does not satisfy the desire to make ssNo a key as well, but as the question states, we only ask that you identify legal SQL.
* Add "PRIMARY KEY" after the first INT, and add "UNIQUE" after the second INT. This choice is correct SQL. You can have both a primary key and a unique key in one table. This change does not satisfy the desire to make managerID a foreign key, but as the question states, we only ask that you identify legal SQL.
* Add "UNIQUE" after the first INT, and add "PRIMARY KEY" after the second INT. This choice is correct SQL. You can have both a primary key and a unique key in one table. This change does not satisfy the desire to make managerID a foreign key, but as the question states, we only ask that you identify legal SQL.
* Add "UNIQUE" after each of the first two INT's. This choice is correct SQL. You can have two unique keys in one table. This change does not satisfy the desire to make managerID a foreign key, but as the question states, we only ask that you identify legal SQL.
* Add "PRIMARY KEY" after the first INT, and add ", FOREIGN KEY (managerID) REFERENCES Emps(id)" before the closing parenthesis. This choice is correct SQL. We have set up a primary key and a foreign key that references it. This change does not satisfy the desire to make ssNo a key as well, but as the question states, we only ask that you identify legal SQL.

Question 4
------------------
Here are SQL declarations for two tables S and T: 
```SQL
   CREATE TABLE S(c INT PRIMARY KEY, d INT);
   CREATE TABLE T(a INT PRIMARY KEY, b INT REFERENCES S(c));
```
Suppose S(c,d) contains four tuples: (2,10), (3,11), (4,12), (5,13). Suppose T(a,b) contains four tuples: (0,4), (1,5), (2,4), (3,5). As a result of the constraints in the table declarations, certain insertions, deletions, and/or updates on S and T are disallowed. Which of the following modifications will not violate any constraint? 

**Answer:**
* `Deleting (0,4) from T`
* `Deleting (3,11) from S`
* `Inserting (6,6) into S`
* `Inserting (6,4) into T`
* `Deleting (2,4) from T`
* `Inserting (1,2) into S`
* `Deleting (3,5) from T`
* `Inserting (7,5) into T`

**Explanation:**
The question choices explore insertions into both tables and deletions from S. Since attribute c is a key for S, we cannot insert into S any tuple with first component 2, 3, 4, or 5. Since attribute a is a key for T, we cannot insert into T any tuple with first component 0, 1, 2, or 3. Since attribute T.b is a foreign key referencing S.c: (1) An insertion into T must have second component 2, 3, 4, or 5; (2) We cannot delete from S any tuple whose first component is a second component of T, that is, 4 or 5.

Eg.
* `Inserting (2,5) into T` It violates the primary-key constraint for T, since 2 is already a value of T.a.
* `Deleting (5,13) from S` It violates the foreign-key constraint, since 5 is a current value of T.b.
* `Inserting (6,1) into T` It violates the foreign-key constraint, since 1 is not a current value of S.c.
* `Inserting (5,12) into S` It violates the primary-key constraint for S, since 5 is already a value of S.c.
* `Inserting (1,2) into T` It violates the primary-key constraint for T, since 1 is already a value of T.a.
* `Deleting (4,12) from S` It violates the foreign-key constraint, since 4 is a current value of T.b.

