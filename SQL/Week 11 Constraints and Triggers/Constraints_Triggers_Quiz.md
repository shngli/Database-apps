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
* `c >= (SELECT SUM(b) FROM R)`
* `a < (SELECT MAX(b) FROM R)`
* `a < (SELECT COUNT(c) FROM R)`

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
* `Add ", FOREIGN KEY (managerID) REFERENCES Emps(id)" before the closing parenthesis.` A foreign key must reference a declared key. While id is intended to be a key, we have not declared it as such in this modification.
* `Add "PRIMARY KEY" after each of the first two INT's.` You cannot have two primary keys in a table.
* `Add "UNIQUE" after each of the first two INT's, and add "REFERENCES Emps(id,ssNo)" before the closing parenthesis.` A foreign key must reference a declared key. In this case, both id and ssNo are declared as keys by themselves, but (id,ssNo) is not declared to be a key (even though it must be one).

**Explanation:** 
The correct answers (i.e., incorrect SQL) violate one of two rules: 
1.	You cannot have two primary keys (although you can have many "uniques"). 
2.	A foreign key can only reference an attribute that is a key (either primary key or unique). 

Eg.
* `Add "PRIMARY KEY" after the first INT, and add "REFERENCES Emps(id)" before the closing parenthesis.` This choice is correct SQL. We have set up a primary key and a foreign key that references it. This change does not satisfy the desire to make ssNo a key as well, but as the question states, we only ask that you identify legal SQL.
* `Add "PRIMARY KEY" after the first INT, and add "UNIQUE" after the second INT.` This choice is correct SQL. You can have both a primary key and a unique key in one table. This change does not satisfy the desire to make managerID a foreign key, but as the question states, we only ask that you identify legal SQL.
* `Add "UNIQUE" after the first INT, and add "PRIMARY KEY" after the second INT.` This choice is correct SQL. You can have both a primary key and a unique key in one table. This change does not satisfy the desire to make managerID a foreign key, but as the question states, we only ask that you identify legal SQL.
* `Add "UNIQUE" after each of the first two INT's.` This choice is correct SQL. You can have two unique keys in one table. This change does not satisfy the desire to make managerID a foreign key, but as the question states, we only ask that you identify legal SQL.
* `Add "PRIMARY KEY" after the first INT, and add ", FOREIGN KEY (managerID) REFERENCES Emps(id)" before the closing parenthesis.` This choice is correct SQL. We have set up a primary key and a foreign key that references it. This change does not satisfy the desire to make ssNo a key as well, but as the question states, we only ask that you identify legal SQL.

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

Question 5
----------------------
Here are SQL declarations for two tables S and T: 
```SQL
   CREATE TABLE S(c INT PRIMARY KEY, d INT);
   CREATE TABLE T(a INT PRIMARY KEY, b INT, CHECK(b IN (SELECT c FROM S)));
```
Suppose S(c,d) contains the four tuples: (2,10), (3,11), (4,12), (5,13). Suppose T(a,b) contains the four tuples: (0,4), (1,5), (2,4), (3,5). As a result of the constraints in the table declarations, certain insertions, deletions, and/or updates on S and T are disallowed. Which of the following modifications will not violate any constraint? 

**Answer:** 
* `Inserting (7,3) into T`
* `Inserting (4,4) into T`
* `Inserting (4,6) into T`
* `Updating (3,5) in T to be (3,3)`

**Explanation:**
The question choices explore insertions into both tables and updates to T. Since attribute c is a key for S, we cannot insert into S any tuple with first component 2, 3, 4, or 5. Since attribute a is a key for T, we cannot insert into T any tuple with first component 0, 1, 2, or 3. The CHECK constraint says: (1) An insertion into T must have second component 2, 3, 4, or 5; (2) An update to T must keep the value of the second component as one of 2, 3, 4, or 5.
	
Eg.
* `Updating (0,4) in T to be (0,0)` The CHECK constraint prohibits us from updating T to have an T.b value that is not currently a value of S.c.
* `Inserting (4,13) into S` It violates the primary-key constraint for S, since 4 is already a value of S.c.
* `Updating (3,5) in T to be (3,1)` The CHECK constraint prohibits us from updating T to have an T.b value that is not currently a value of S.c.
* `Updating (2,4) in T to be (2,8)` The CHECK constraint prohibits us from updating T to have an T.b value that is not currently a value of S.c.
* `Inserting (3,3) into T` It violates the primary-key constraint for T, since 3 is already a value of T.a.
* `Inserting (1,4) into T` It violates the primary-key constraint for T, since 1 is already a value of T.a.
* `Inserting (4,6) into T` The CHECK constraint prohibits us from inserting into T a tuple whose T.b value is not currently a value of S.c.

Question 6
-----------------
Consider the following trigger over a table R(a,b), specified using the trigger language of the SQL standard: 
```SQL
   CREATE TRIGGER Rins
   AFTER INSERT ON R
   REFERENCING NEW ROW AS new
   FOR EACH ROW
   WHEN (new.a * new.b > 10)
   INSERT INTO R VALUES (new.a - 1, new.b + 1);
```
When we insert a tuple into R, the trigger may cause another tuple to be inserted, which may cause yet another tuple to be inserted, and so on, until finally a tuple is inserted that does not cause the trigger to fire. Suppose we begin with table R empty. Consider the following possible tuples inserted into R. After trigger execution completes, which of the insertions results in R containing exactly 3 tuples? 

**Answer:** 
* (2,50)
* (3,5)
* (3,8)

**Explanation:** 
Each time the trigger is activated by an insertion (x,y), if x*y is greater than 10 then the trigger inserts a new tuple (x-1,y+1). Thus, if we insert (x,y) first, then in order to insert exactly three tuples, we need for x*y and (x-1)*(y+1) to be greater than 10, but for (x-2)*(y+2) to be 10 or less.

Eg.
* (5,4). The insertion of (5,4) causes the insertion of (4,5), which causes the insertion of (3,6), which causes the insertion of (2,7). Thus, at least 4 tuples are inserted.
* (4,4). The insertion of (4,4) causes the insertion of (3,5), which causes the insertion of (2,6), which causes the insertion of (1,7). Thus, at least 4 tuples are inserted.
* (2,9). The insertion of (2,9) causes the insertion of (1,10), but 1*10 <= 10, so no more insertions are triggered
* (50,0). The insertion of (50,0) does not cause the insertion of any more tuples, since 50*0 <= 10.
* (3,9). The insertion of (3,9) causes the insertion of (2,10), which causes the insertion of (1,11), which causes the insertion of (0,12). Thus, at least 4 tuples are inserted.
* (11,1). The insertion of (11,1) causes the insertion of (10,2), which causes the insertion of (9,3), which causes the insertion of (8,4). Thus, at least 4 tuples are inserted.
* (2,6). The insertion of (2,6) causes the insertion of (1,7), but 1*7 <= 10, so no more insertions are triggered.

Question 7
-----------------
Here are SQL declarations for three tables R, S, and T: 
```SQL
   CREATE TABLE R(e INT PRIMARY KEY, f INT);
   CREATE TABLE S(c INT PRIMARY KEY, d INT REFERENCES R(e) ON DELETE CASCADE);
   CREATE TABLE T(a INT PRIMARY KEY, b INT REFERENCES S(c) ON DELETE CASCADE);
```
Suppose R(e,f) contains tuples (1,0), (2,4), (3,5), (4,3), and (5,7). Suppose S(c,d) contains tuples (1,5), (2,2), (3,3), (4,5), and (5,4). Suppose T(a,b) contains tuples (0,2), (1,2), (2,3), (3,4), and (4,4). As a result of the referential integrity actions in the table declarations, certain deletions may cause additional deletions to be performed automatically. Which of the following deletions, after all integrity actions, leaves table T empty? 

**Answer:** 
* `delete from R where f>3`
* `delete from R where e>=2`
* `delete from R where e=f-2`

**Explanation:** 
T contains tuples (0,2), (1,2), (2,3), (3,4), and (4,4). The removal of any of the following elements will result in the deletion of (0,2) from T: (0,2) from T, (2,2) from S, or (2,4) from R. The removal of any of the following elements will result in the deletion of (1,2) from T: (1,2) from T, (2,2) from S, or (2,4) from R. The removal of any of the following elements will result in the deletion of (2,3) from T: (2,3) from T, (3,3) from S, or (3,5) from R. The removal of any of the following elements will result in the deletion of (3,4) from T: (3,4) from T, (4,5) from S, or (5,7) from R. The removal of any of the following elements will result in the deletion of (4,4) from T: (4,4) from T, (4,5) from S, or (5,7) from R. For T to be empty, any deletion must remove at least one element from each set.

Eg.
* `delete from R where e+f>6` T still contains (0,2) and (1,2).
* `delete from R where f<6` T still contains (3,4) and (4,4).
* `delete from R where e+f<=8` T still contains (3,4) and (4,4).
* `delete from R where e<4` T still contains (3,4) and (4,4).
* `delete from R where e>f` T still contains (0,2), (1,2), (2,3), (3,4), and (4,4).
* `delete from R where e=5 or f=5` T still contains (0,2) and (1,2).
* `delete from R where e*f>=10` T still contains (0,2) and (1,2).

Question 8
-------------------
Here are SQL declarations for three tables R, S, and T: 
```SQL
   CREATE TABLE R(e INT PRIMARY KEY, f INT);
   CREATE TABLE S(c INT PRIMARY KEY REFERENCES R(e) ON UPDATE CASCADE, d INT);
   CREATE TABLE T(a INT PRIMARY KEY, b INT REFERENCES S(c) ON UPDATE CASCADE);
```
Suppose R(e,f) contains tuples (1,1), (3,4), (5,6), and (7,2). Suppose S(c,d) contains tuples (1,7), (3,2), (5,1) and (7, 5). Suppose T(a,b) contains tuples (1,1), (2,5), (3,5), and (4,3). As a result of the referential integrity actions in the table declarations, certain updates may cause additional updates to be performed automatically. Which of the following updates, after all integrity actions, leaves table T in a state such the sum of its b values is greater than 11 but less than 18? 

**Answer:** 
* `update R set e=e+1 where f>=3`
* `update R set e=e+3 where e<3`
* `update R set e=e-2 where e<2`
* `update R set e=e+3 where e<3`

**Explanation:** 
With each update on attribute e in R(e,f), track if update is cascaded to the attribute c in S and finally to the attribute b in T(a,b). In T(a,b) the b attribute of tuples (1,1), (2,5), (3,5), and (4,3) references the c attribute in S(c,d) of tuples (1,7), (5,1), (5,1), and (3,2) which references the e attribute in R(e,f) of tuples (1,1), (5,6), (5,6), (3,4).

Eg.
* `update R set e=e-3 where e>4` T will contain (1,1), (2,2), (3,2), (4,3).
* `update R set e=e-2 where f<8` T will contain (1,-1), (2,3), (3,3), and (4,1).
* `update R set e=e+1` T will contain (1,2), (2,6), (3,6), and (4,4).
* `update R set e=e-3 where f>5` T will contain (1,1), (2,2), (3,2), and (4,3).
* `update R set e=e+3 where e>=1` T will contain (1,4), (2,9), (3,9), and (4,6).
* `update R set e=e-1` T will contain (1,0), (2,4), (3,4), and (4,2).
