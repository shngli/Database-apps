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
