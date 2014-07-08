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

**Answer:**
* If T = {2, 4, 5, 6, 8, 10, 11} then the query returns 3.
* If T = {7, 9, 10, 14, 15, 16, 18} then the query returns 3.

**Explanation:** 
Mystery contains all (p,q) pairs, p <= q, such that T contains all integers from p to q, inclusive. The base case inserts (p,p) for every value p in T, which clearly satisfies the condition. The recursion then looks for pairs (p,q) and (q+1,r) that are both in Mystery, and inserts (p,r). Since (p,q) and (q+1,r) both satisfy the condition, the two sequences "stitched together", based on q+1 following q, also satisfies the condition. After the recursion, the query finds the pair(s) (p,q) in Mystery with the maximum distance between p and q. Thus, what is finally returned is the length of the longest consecutive sequence of integers in R.

Question 2
----------------------------
Consider a relation Manager(manager,employee) where a tuple (m,e) in Manager specifies that person m is the manager of person e. The only key for Manager is both attributes together. The following recursive SQL query computes the relation Peer(X,Y). 

```SQL
    With Recursive Peer(X,Y) As
       (Select M1.employee, M2.employee
        From Manager M1, Manager M2
        Where M1.manager = M2.manager AND M1.employee < M2.employee
        Union
        Select M1.employee, M2.employee
        From Peer S, Manager M1, Manager M2
        Where S.X = M1.manager AND S.Y = M2.manager
        And M1.employee < M2.employee)
    Select * from Peer
```

Suppose the tuples in Manager are: (10, 9), (10,8), (9,7), (9,6), (8,6), (8,5), (7,4), (7,3), (6,3), (6,2), (5,2), (5,1). Consider the computation of Peer in the recursive query. Let the base case -- the first term of the Union -- be "round 1." Let each subsequent round of the recursion be "round 2," "round 3," and so on. Which of the following is a correct statement about when a pair gets added to Peer?

**Answer:** (2,4) is added in round 2.

**Explanation:**
The base case adds to Peer all pairs with a common manager, adding each pair only once (the pair with the first element less than the second). Thus, the pairs added in the base case (round 1) are: (8,9), (5,6), (6,7), (1,2), (2,3), (3,4). Round 2 adds pairs where the managers of the two elements are in Peer, again adding each pair only once. Thus, pairs added in round 2 are: (5,7), (1,3), (2,4). Round 3 adds pairs where the managers of the two elements are in Peer, without adding duplicates so only the new Peer pairs need to be considered. Thus, round 3 adds only the pair (1,4). Subsequent rounds do not find any new pairs to add.

Question 3
-----------------------
Consider a relation Parent(par,child), where a tuple (p,c) in Parent specifies that person p is the parent of person c. The only key for Parent is both attributes together. We are interested in writing a recursive SQL query to find all descendants of the person named "Eve." Here are six possible definitions of a recursive relation Ancestor(X,Y). Note that some of the definitions include nonlinear recursion, which technically is not permitted in the strict SQL standard. 

```SQL
1: With Recursive Ancestor(X,Y) As
      (Select par, child From Parent
       Union
       Select Ancestor.X, Parent.child
       From Ancestor, Parent
       Where Ancestor.Y = Parent.par)

2: With Recursive Ancestor(X,Y) As
      (Select par, child From Parent Where par = 'Eve'
       Union
       Select Ancestor.X, Parent.child
       From Ancestor, Parent
       Where Ancestor.Y = Parent.par)

3: With Recursive Ancestor(X,Y) As
      (Select par, child From Parent
       Union
       Select Parent.par, Ancestor.Y
       From Parent, Ancestor
       Where Parent.child = Ancestor.X)

4: With Recursive Ancestor(X,Y) As
      (Select par, child From Parent
       Union
       Select Parent.par, Ancestor.Y
       From Parent, Ancestor
       Where Parent.child = Ancestor.X and Parent.par = 'Eve')

5: With Recursive Ancestor(X,Y) As
      (Select par, child From Parent Where par = 'Eve'
       Union
       Select A1.X, A2.Y
       From Ancestor A1, Ancestor A2
       Where A1.Y = A2.X)

6: With Recursive Ancestor(X,Y) As
      (Select par, child From Parent
       Union
       Select A1.X, A2.Y
       From Ancestor A1, Ancestor A2
       Where A1.Y = A2.X and A1.X = 'Eve')
```
Consider two possible queries that can be used to complete any of the WITH statements (1)-(6): 
* A: Select Y From Ancestor
* B: Select Y From Ancestor Where X = 'Eve'
Which of the following combinations correctly computes the descendants of "Eve"? 

**Answer:** 
The only choice for which both (A) and (B) both give the correct answer is (2).

**Explanation:** 
Statement (1) defines Ancestor to be all the true ancestor facts. If we follow it by query (A), we get all of the people who are descendants of anybody, not just Eve. (B) gives the correct answer, since it restricts the result to those Ancestor tuples where the ancestor is Eve. 

Statement (2) is almost like (1), but the base case, where we initialize Ancestor, requires the first component to be Eve. Notice that the recursion never allows the first component of Ancestor to be anything but Eve, while the second component can take on any descendant of Eve, as we recursively add tuples following the Parent information from generation to generation. As a result, both (A) and (B) give the correct answer. 

Statement (3) is like (1), but the recursion uses Parent on the left instead of the right. The same conclusion holds for (3) as for (1): (B) is correct but (A) is not. 

Statement (4) looks similar to (3) but makes a serious mistake. Although the base case allows all Parent facts to be Ancestor facts, every other use of Parent requires the parent to be Eve. As a result, assuming Eve has no parents, we get at most the grandchildren of Eve. Thus, neither (A) nor (B) gives the correct answer. 

Statement (5) also makes a serious mistake: When we try to apply the recursion for the first time, we cannot infer any new facts unless Eve is both a parent and a child. Thus, neither (A) nor (B) gives the correct answer. 

Statement (6) fixes the problem of (5) in a subtle way: The base case allows all Parent facts into Ancestor. The recursion adds additional Ancestor facts only when the first component is "Eve". In the end, Ancestor holds all parent facts, plus all "multi-generational" facts (grandparent, great-grandparent, etc.) where the first component is Eve. Thus, (B) gives the correct answer. (A) does not give the correct answer, because some of the Parent facts may have first components other than Eve. 
