Normalization Quiz 
=======================

Question 1
--------------
Consider relation R(A,B,C,D,E) with multivalued dependencies: `A ↠ B, B ↠ D` 

and no functional dependencies. Suppose we decompose R into 4th Normal Form. Depending on the order in which we deal with 4NF violations, we can get different final decompositions. Which one of the following relation schemas could be in the final 4NF decomposition? 

**Answer:** 
* AB
* AD

**Explanation:**

Since there are no functional dependencies, the only key for the original R and any decomposed relations is the set of all attributes. Thus, if there are any nontrivial MVDs for a relation at any stage in the decomposition, the left side isn't a key so the relation must be further decomposed.
 
Suppose we start with violating MVD A ↠ B. We get AB and ACDE as a decomposition. A ↠ B is trivial in AB, so AB is in 4NF. However, ACDE has MVD A ↠ D, which follows by transitivity from the given MVDs. We therefore decompose ACDE into AD and ACE. These have no nontrivial MVDs, so {AB,AD,ACE} is one possible 4NF decomposition.
 
We could also start from ABCDE with violating MVD B ↠ D. We get BD and ABCE as a decomposition. B ↠ D is trivial in BD, so BD is in 4NF. However, ABCE has violating MVD A ↠ B. We therefore decompose ABCE into AB and ACE. These have no nontrivial MVDs, so another decomposition is {BD,AB,ACE}. 

Finally, we could start from ABCDE with violating MVD A ↠ D, which follows by transitivity from the given MVDs. This process results in the same decomposition we got the first time: {AB,AD,ACE}. 

Question 2
-----------------------
Let R(A,B,C,D,E) be a relation in Boyce-Codd Normal Form (BCNF). Suppose ABC is the only key for R. Which of the following functional dependencies is guaranteed to hold for R? 

**Answer:** 
* `ABC → E`
* `ABCD → E`
* `ABCE → D`

**Explanation:**
Since ABC is a key, by definition ABC → D and ABC → E. Furthermore, since R is in BCNF, all nontrivial FDs must include ABC on the left side. Thus, the only FDs guaranteed to hold are ABC → D and ABC → E, and the two FDs implied by them: ABCE → D and ABCD → E.

Question 3
-------------------------
Consider a relation R(A,B,C,D). For which of the following sets of FDs is R in Boyce-Codd Normal Form (BCNF)? 

**Answer:** 
* `AC → D, D → A, D → C, D → B` For each given FD, the closure of the left-side attributes is ABCD. Thus, the left-side attributes of each FD contain a key, and the relation is in BCNF.
* `C → B, D → A, C → D, A → C` For each given FD, the closure of the left-side attributes is ABCD. Thus, the left-side attributes of each FD contain a key, and the relation is in BCNF.
* `BD → C, AB → D, AC → B, BD → A` For each given FD, the closure of the left-side attributes is ABCD. Thus, the left-side attributes of each FD contain a key, and the relation is in BCNF.

**Explanation:**
A relation is in BCNF if for every nontrivial FD, the left-side attributes contain a key. To test whether a set of attributes S contains a key, compute the closure of the attributes in S using all of the FDs. If the closure is all attributes of the relation, then the attributes contain a key; otherwise not. You need to go through this process for each of the given FDs to determine if the relation is in BCNF.
Eg.
* `BC → A, AD → C, CD → B, BD → C` BC+ = BCA, so BC → A is a BNCF violation.
* `ABC → D, BCD → A, D → C, ACD → B` D+ = DC, so D → C is a BNCF violation.
* `C → B, BC → A, A → C, BD → A` C+ = CBA, so C → B is a BNCF violation.
* `A → D, C → A, D → B, AC → B` A+ = ADB, so A → D is a BNCF violation.

Question 4
-------------------------------
Consider relation R(A,B,C,D) with functional dependencies: `A → B, C → D, AD → C, BC → A`

Suppose we decompose R into Boyce-Codd Normal Form (BCNF). Which of the following schemas could not be in the result of the decomposition? 

**Answer:** 
* ABC. A → B but A is not a key.
* ABD. A → B but A is not a key.
* ACD. C → D but C is not a key.
* BCD. C → D but C is not a key.
* ABD. A → B but A is not a key.

**Explanation:**
A schema is in BCNF if every FD contains a key on its left side. Using the closure method on subsets of attributes, we see that the minimal keys for R are AC, AD, and BC.(To test whether a set of attributes S is a key, compute the closure of the attributes in S using all of the FDs. If the closure is all attributes of the relation, then the attributes in S are a key; otherwise not.) 

All of the correct answers -- schemas that could not be part of the decomposition -- have an FD whose left side does not contain one of these keys. All of the incorrect answers -- schemas that could be part of the decomposition -- result from one or two steps of the decomposition algorithm using the given FDs. Furthermore, these schemas all have two attributes. If a two-attribute relation has a nontrivial FD, then by definition the left side is a key. Thus, all two-attribute relations are in BCNF. 

Eg.
* AC. This schema results from two steps of decomposition based on the given FDs. Two-attribute relations can't be further decomposed.
* CD. This schema results from one step of decomposition based on the given FDs. Two-attribute relations can't be further decomposed.

Question 5
--------------------------
Consider a relation R(A,B,C,D,E). For which of the following sets of FDs is R in Boyce-Codd Normal Form (BCNF)? 

**Answer:**
* `AC → D, BCE → A, CD → E, CE → B` For each given FD, the closure of the left-side attributes is ABCDE. Thus, the left-side attributes of each FD contain a key, and the relation is in BCNF.
* `BCD → E, BDE → C, BE → D, BE → A`

**Explanation:**
A relation is in BCNF if for every nontrivial FD, the left-side attributes contain a key. To test whether a set of attributes S contains a key, compute the closure of the attributes in S using all of the FDs. If the closure is all attributes of the relation, then the attributes contain a key; otherwise not. You need to go through this process for each of the given FDs to determine if the relation is in BCNF.

Eg.
* `BDE → A, AC → E, B → C, DE → A` B+ = BC, so B → C is a BNCF violation.
* `ACD → E, AE → C, CE → B, A → D` A+ = AD, so A → D is a BNCF violation.
* `AD → B, ABC → E, BD → A, B → A` B+ = AB, so B → A is a BNCF violation.
* `ABD → C, ACD → E, ACE → B, BC → E` BC+ = BCE, so BC → E is a BNCF violation.
* `BE → D, B → E, D → E, CD → A` D+ = DE, so D → E is a BNCF violation.

Question 6
--------------------
Consider relation R(A,B,C,D) with functional and multivalued dependencies: `A → B, C → D, B ↠ C`

Suppose we decompose R into 4th Normal Form. Depending on the order in which we deal with 4NF violations, we can get different final decompositions. Which one of the following relation schemas could be in the final 4NF decomposition? 

**Answer:** 
* AC
* AD
* CD
* BC

**Explanation:**
From the FDs we see that AC is the one minimal key. Thus, each dependency is a 4NF violation. Furthermore, since every FD is also an MVD, by transitivity of MVDs we can infer A ↠ C, A ↠ D, and B ↠ D. Depending which violating dependency we pick first in the decomposition algorithm, every two-attribute relation can be one of the schemas in the decomposition. Furthermore, every three-attribute relation (and R itself) has at least one 4NF violation, so it cannot be in the final decomposition.
