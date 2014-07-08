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
* `SELECT ON S(c)`. This privilege is useful for the reference to S.c in the WHERE clause.
* `SELECT ON T`. This privilege is useful for the references to T.a in the WHERE clause.
* `UPDATE ON R`. This privilege is useful for the update to R.a in the SET clause.

Question 2
-----------------------
Consider a set of users A, B, C, D, E. Suppose user A creates a table T and thus is the owner of T. Now suppose the following set of statements is executed in order: 
```SQL
  1. User A: grant update on T to B,C with grant option
  2. User B: grant update on T to D with grant option
  3. User C: grant update on T to D with grant option
  4. User D: grant update on T to E
  5. User A: revoke update on T from C cascade
```
After execution of statement 5, which of the following is true? 

**Answer:** 
* D has privilege UPDATE ON T
* Both D and E have privilege UPDATE ON T, but C doesn't

**Explanation:**
Let P denote the privilege "UPDATE ON T". After statements 1-4, all five users have privilege P. After statement 5, user C no longer has privilege P. Although C granted privilege P (with grant option) to user D, the "cascade" has no effect because D was also granted privilege P (with grant option) by user B.

Question 3
-------------------
The following SQL statement over tables R(c,d), S(f,g), and T(a,b) requires certain privileges to execute: 
```SQL
   UPDATE T
   SET a=1, b=2
   WHERE a <= ALL (SELECT d FROM R)
   OR EXISTS (SELECT f FROM S WHERE f > T.a)
```
Which of the following privileges is not useful for execution of this SQL statement? 

**Answer:** 
INSERT ON T(b)

**Explanation:** 
We need to have read access to T.a, because it is referred to in "WHERE a <= ALL ..." and "WHERE f > T.a". Thus, we need privilege SELECT ON T(a) or SELECT ON T. The subquery "(SELECT d FROM R)" requires privilege SELECT ON R(d) or SELECT ON R. The subquery "(SELECT f FROM S WHERE f > T.a)" requires privilege SELECT ON S(f) or SELECT ON f. Finally, we need to update T.a and T.b, so either UPDATE ON T(a) and UPDATE ON T(b), or else UPDATE ON T, is needed. No other privileges are useful for executing the statement.

Eg.
* `SELECT ON T`. This privilege is useful for the reference to T.a in the WHERE clause.
* `SELECT ON S`. This privilege is useful for the references to S.f in the WHERE clause.
* `SELECT ON T(a)`. This privilege is useful for the reference to T.a in the WHERE clause.
* `SELECT ON S(f)`. This privilege is useful for the reference to S.f in the WHERE clause.

Question 4
----------------------
Consider a set of users U, V, W, X, and Y. Suppose user U creates a table T and thus is the owner of T. Now suppose the following set of statements is executed in order: 
```SQL
  1. User U: grant select on T to V,W with grant option
  2. User V: grant select on T to W
  3. User W: grant select on T to X,Y
  4. User U: grant select on T to Y
  5. User U: revoke select on T from V restrict
  6. User U: revoke select on T from W cascade
```
Which of the following statements is true? 

**Answer:** 
X does not have privilege SELECT ON T after statement 6

**Explanation:** 
As owner, U has all privileges on T. Let P denote the privilege "SELECT ON T". After statement 1, V and W have privilege P granted by U. After statement 2, W is additionally granted privilege P by V. After statement 3, X and Y also have privilege P, granted by W. After statement 4, Y is additionally granted privilege P by U. After statement 5, V no longer has privilege P. The "restrict" does not block the statement since there is no cascading revoking of privileges (W still has privilege P from U). After statement 6, W loses privilege P and so does X since it was granted by W, but Y still retains privilege granted from U.

