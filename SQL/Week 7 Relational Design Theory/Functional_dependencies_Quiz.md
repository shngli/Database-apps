Functional Dependencies Quiz 
==============================

Question 1
-----------------------
Consider relation R(A,B,C,D,E) with functional dependencies:  `AB → C, C → D, BD → E`

Which of the following sets of attributes does not functionally determine E? 

**Answer:** 

* `ACD` Yes; ACD+ = ACD, so E is not functionally determined.
* `AD` Yes; AD+ = AD, so E is not functionally determined.
* `AC` Yes; AC+ = ACD, so E is not functionally determined

**Explanation:**
Let S be the set of FDs. To determine whether E is functionally determined by a given set of attributes, compute the closure of the set of attributes based on the FDs in S. Check if E is in the closure.

Eg.
* `BCD` BCD+ = BCDE, which includes E.
* `ABC` No; ABC+ = ABCDE, which includes E.
* `AB` No; AB+ = ABCDE, which includes E.

Question 2
---------------------------
Consider relation R(A,B,C,D,E) with functional dependencies:`D → C, CE → A, D → A, AE → D`

Which of the following is a key? 

**Answer:** 
* `ABE` Yes; ABE+= ABCDE.
* `BCE` Yes; BCE+= ABCDE.
* `BDE` Yes; BDE+= ABCDE.

**Explanation**
A set of attributes A is a key for a relation R if A functionally determines all attributes in R. Given a set S of FDs, we compute the closure of attribute set A using the FDs in S, then check if the closure is the set of all attributes in R.

* `CDE` CDE+ = CDEA; a key must functionally determine all attributes ABCDE.
* `AD` AD+ = ADC; a key must functionally determine all attributes ABCDE.

Question 3
----------------------------

Let relation R(A,B,C,D,E,F,G,H) satisfy the following functional dependencies:  `A → B, CH → A, B → E, BD → C, EG → H, DE → F` 

Which of the following FDs is also guaranteed to be satisfied by R? 

**Answer:** 

* `BDG → AE` Yes; BDG+ = BDGECHAF (all attributes), which contains AE.
* `BED → CF` Yes; BED+ = BEDCF, which includes CF.
* `CEG → AB` Yes; CEG+ = CEGHAB, which contains AB.

**Explanation:**
To determine if an FD F follows from a set S of FDs, compute the closure of the left side of F based on the FDs in S. If the right side of F is included in the result of the closure, then F follows from the FDs in S. If the right side of F contains any attributes not in the closure, then F does not follow from the FDs in S.

Eg.
* `ADE → CH` No; ADE+ = ADEBFC (closure with respect to the set of FDs in the question), which includes C but not H.
* `CGH → BF` No; CGH+ = CGHABE (closure with respect to the set of FDs in the question), which includes B but not F.
* `ACG → DH` No; ACG+ = ACGBE (closure with respect to the set of FDs in the question), which includes neither D nor H. The FD would not hold even if one of D or H (but not both) were not in the closure.
* `BCD → FH` No; BCD+ = BCDEF (closure with respect to the set of FDs in the question), which includes F but not H.
* `BFG → AE` No; BFG+ = BFGEH (closure with respect to the set of FDs in the question), which includes E but not A.

Question 4
-----------------------
Consider relation R(A,B,C,D,E,F) with functional dependencies:  `CDE → B, ACD → F, BEF → C, B → D`

Which of the following is a key? 

**Answer:** 
* `ABEF` Yes; ABEF+ = all attributes.
* `ACDE` Yes; ACDE+ = all attributes.
* `ABCE`

**Explanation**
A set of attributes A is a key for a relation R if A functionally determines all attributes in R. Given a set S of FDs, we compute the closure of attribute set A using the FDs in S, then check if the closure is the set of all attributes in R.

Eg.
* `BDF` BDF+ = BDF; a key must functionally determine all attributes ABCDEF.
* `ABE` ABE+ = ABED; a key must functionally determine all attributes ABCDEF.
* `ADEF` ADEF+ = ADEF; a key must functionally determine all attributes ABCDEF.
* `ABDF` ABDF+ = ABDF; a key must functionally determine all attributes ABCDEF.

Question 5
------------------------
Consider relation R(A,B,C,D,E,F,G) with functional dependencies:`AB → C, CD → E, EF → G, FG → E, DE → C, and BC → A`

Which of the following is a key? 

**Answer:** 
* `BCDF` Yes; BCDF+ = ABCDEFG.
* `BDEF` Yes; BDEF+ = ABCDEFG
* `BDFG` Yes; BDFG+ = ABCDEFG.

**Explanation:** 

A set of attributes A is a key for a relation R if A functionally determines all attributes in R. Given a set S of FDs, we compute the closure of attribute set A using the FDs in S, then check if the closure is the set of all attributes in R.

Eg. 
* `ABFG` ABFG+ = ABCEFG; a key must functionally determine all attributes ABCDEFG.
* `ABEF`ABEF+ = ABCEFG; a key must functionally determine all attributes ABCDEFG.
* `BCDE` BCDE+ = ABCDEG; a key must functionally determine all attributes ABCDEFG.
* `ADFG` ADFG+ = ACDEFG; a key must functionally determine all attributes ABCDEFG.
* `BDEG` BDEG+ = ABCDEG; a key must functionally determine all attributes ABCDEFG.
* `BDF` BDF+ = BDF; a key must functionally determine all attributes ABCDEFG.

Question 6
----------------------------
Let relation R(A,B,C,D,E) satisfy the following functional dependencies: `AB → C, BC → D, CD → E, DE → A, AE → B` 

Which of the following FDs is also guaranteed to be satisfied by R?  

**Answer:** 
* `BCD → A` Yes; BCD+ = ABCDE, which contains A.
* `ABD → C` Yes; ABD+ = ABCDE, which contains C.
* `AB → D` Yes; AB+ = ABCDE, which contains D.
* `ABC → D` Yes; ABC+ = ABCDE, which contains D.
* `ACE → D` Yes; ACE+ = ABCDE, which contains D.
* `CD → B` Yes; CD+ = ABCDE, which contains B.

**Explanation:** 
To determine if an FD F follows from a set S of FDs, compute the closure of the left side of F based on the FDs in S. If the right side of F is included in the result of the closure, then F follows from the FDs in S. If the right side of F contains any attributes not in the closure, then F does not follow from the FDs in S.

Eg.
* `D → C` No; D+ = D (closure with respect to the set of FDs in the question), which does not include C.
* `B → A` No; B+ = B (closure with respect to the set of FDs in the question), which does not include A.
* `CE → B` No; CE+ = CE (closure with respect to the set of FDs in the question), which does not include B.
* `AD → B` No; AD+ = AD (closure with respect to the set of FDs in the question), which does not include B.

Question 7
--------------------------
Let relation R(A,B,C,D) satisfy the following functional dependencies: `A → B, B → C, C → A` 

Call this set S1. A different set S2 of functional dependencies is equivalent to S1 if exactly the same FDs follow from S1 and S2. Which of the following sets of FDs is equivalent to the set above? 

**Answer:** 
* `A → BC, B → AC, C → AB`
* `C → B, B → A, A → C`

**Explanation**
* The given set of FDs has the property that any single attribute determines all of the other attributes, and consequently any subset of the attributes determines any other subset. Any equivalent set of FDs must have this same property.

Eg.
* `B → A, B → C, C → B` A → B and A → C follow from the given FDs, but not from the FDs in this choice.
* `A → B, B → C, C → B` C → A and B → A follow from the given FDs, but not from the FDs in this choice.
* `B → AC, C → AB` A → B and A → C follow from the given FDs, but not from the FDs in this choice.
* `A → B, B → A, C → A` A → C and B → C follow from the given FDs, but not from the FDs in this choice.
* `A → BC, B → AC` C → A and C → B follow from the given FDs, but not from the FDs in this choice.

Question 8
----------------------------
Suppose relation R(A,B,C) currently has only the tuple (0,0,0), and it must always satisfy the functional dependencies A → B and B → C. Which of the following tuples may be inserted into R legally? 

**Answer:** 
* (1,2,3)
* (1,2,0)
* (1,0,0)
* (1,1,0)

**Explanation:** 
To avoid violating A → B, the new tuple either has to disagree with (0,0,0) on A (that is, the first component of the new tuple is not 0), or it must agree on B (i.e., the second component must be 0). In other words, the new tuple must be of the form (0,0,w), or (x,y,z) where x ≠0. Similarly, to avoid violating B → C, the new tuple must either be of the form (w,0,0), or (x,y,z) where y ≠0. Thus, assuming the new tuple is not another copy of (0,0,0), it must be either of the form (w,0,0), or of the form (x,y,z) where x ≠0 and y ≠0. 
1.	It is (0,0,0) --- this tuple is already there and is not one of the available choices, although technically it could have been. 
2.	It is of the form (x,0,0). 
3.	It is of the form (x,x',y), where x', like x, is definitely not 0. 

Eg.
* (0,2,0). This choice violates A → B.
* (0,1,0). This choice violates A → B.
* (1,0,2). This choice violates B → C.
* (0,1,2). This choice violates A → B.
* (2,0,1). This choice violates B → C.
