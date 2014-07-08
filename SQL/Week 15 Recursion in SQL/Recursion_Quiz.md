Recursion Quiz
=========================


Question 1
-------------------------

Consider a table T(A) containing a set of positive integers with no duplicates, and the following recursive SQL query. Note that this query includes nonlinear recursion, which technically is not permitted in the strict SQL standard. 

 `With Recursive Mystery(X,Y) As`
 &nbsp;&nbsp;&nbsp;`(Select A As X, A As Y From T`
 &nbsp;&nbsp;&nbsp;`Union`
 &nbsp;&nbsp;&nbsp;`Select m1.X, m2.Y`
 &nbsp;&nbsp;&nbsp;`From Mystery m1, Mystery m2`
 &nbsp;&nbsp;&nbsp;`Where m2.X = m1.Y + 1)`
 `Select Max(Y-X) + 1 From Mystery`
