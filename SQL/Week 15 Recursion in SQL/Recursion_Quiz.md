Recursion Quiz
=========================


Question 1
-------------------------

Consider a table T(A) containing a set of positive integers with no duplicates, and the following recursive SQL query. Note that this query includes nonlinear recursion, which technically is not permitted in the strict SQL standard. 

 ```SQL
 With Recursive Mystery(X,Y) As
    (Select A As X, A As Y From T
     Union
     Select m1.X, m2.Y
     From Mystery m1, Mystery m2
     Where m2.X = m1.Y + 1)
 Select Max(Y-X) + 1 From Mystery
```
While the definition looks complicated, the query in fact computes a property of T that can be stated very succinctly. First try to determine what Mystery is computing from T. Then choose which of the following is a correct statement about the final query result. 

**Answer**
* If T = {2, 4, 5, 6, 8, 10, 11} then the query returns 3.
* If T = {7, 9, 10, 14, 15, 16, 18} then the query returns 3.
