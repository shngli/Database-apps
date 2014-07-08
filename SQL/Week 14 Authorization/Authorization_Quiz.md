Authorization Quiz 
============================

Question 1
-----------------
The following SQL statement over tables R(a,b), S(b,c), and T(a,c) requires certain privileges to execute: 
```SQL
   UPDATE R
   SET a = 10
   WHERE b IN (SELECT c FROM S)
   AND NOT EXISTS (SELECT a FROM T WHERE T.a = R.a)
```
Which of the following privileges is not useful for execution of this SQL statement? 

**Answer:**
SELECT ON S(b)

**Explanation:**
We need to have read access to R.a and R.b, because these attributes are referred to in "WHERE b IN..." and "WHERE T.a = R.a", respectively. Thus, we need privileges SELECT ON R(a) and SELECT ON R(b), or SELECT ON R. The subquery "(SELECT c FROM S)" requires privilege SELECT ON S(c) or SELECT ON S. The subquery "(SELECT a FROM T ...)" requires privilege SELECT ON T(a) or SELECT ON T, which also apply for condition "WHERE T.a=R.a". Finally, we need to update R.a, so either UPDATE ON R(a) or UPDATE ON R is needed. No other privileges are useful for executing the statement.

Eg.
* SELECT ON S(c)
* This privilege is useful for the reference to S.c in the WHERE clause.

* SELECT ON T
* This privilege is useful for the references to T.a in the WHERE clause.

* UPDATE ON R
* This privilege is useful for the update to R.a in the SET clause.
