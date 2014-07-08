Transactions Quiz
===========================

Question 1
------------------
Consider tables R(A) and S(B) and the following transaction T1: 
```SQL
T1: set transaction isolation level repeatable read;
    select * from R;
    select * from R;
    select * from S;
    commit;
```
Suppose table R initially has one tuple with value A=3 and table S initially has one tuple with value B=6. Consider the following possible transactions T2, executed around the same time as T1. Which one of them can cause the two transactions to exhibit nonserializable behavior? 

**Answer:** 
* `T2: set transaction isolation level serializable; insert into R values (4); commit;`
* `T2: set transaction isolation level serializable; update R set A=4; delete from S where B=6; commit;`

**Explanation:** 
Nonserializable behavior can be exhibited if transaction T2 performes inserts on R, or if T2 modifies both R and S. On inserts, repeatable reads allow "phantom" tuples to appear during a transaction. If both R and S are modified in T2, it is possible for T1 to read the state of R before T2 and the state of S after T2.

Eg.
* `T2: set transaction isolation level serializable; delete from S; insert into S values (6); commit;` Any interleaving of T1 and T2 has an equivalent serial execution.
* `T2: set transaction isolation level serializable; update R set A=4; update S set B=5 where B<5; commit;` The modification command on S does not make changes to the database.
* `T2: set transaction isolation level serializable; update S set B=7; commit;` T2 will always appear to execute either before or after T1.
* `T2: set transaction isolation level serializable; insert into S values (5); delete from R where A=2; commit;` The modification command on R does not make changes to the database.

Question 2
---------------------
Consider a relation R(x) containing integers. Suppose Alice runs a transaction that is a query: 
```SQL
   select sum(x) from R;
   commit;
```
Betty's transaction is a sequence of inserts: 
```SQL
   insert into R values (10);
   insert into R values (20);
   insert into R values (30);
   commit;
```
Carol's transaction is a sequence of deletes: 
```SQL
   delete from R where x=30;
   delete from R where x=20;
   commit;
```
Before any of these transactions execute, the sum of the integers in R is 1000, and none of the integers are 10, 20, or 30. If Alice's, Betty's, and Carol's transactions run at about the same time, and each runs under isolation level READ COMMITTED, which of the following sums could be produced by Alice's transaction? 

**Answer:** 
1010

**Explanation:** 
Alice must see all of Betty's inserts or none of them. Alice could compute the sum before Betty or Carol does anything (answer 1000), or after Betty's inserts but before Carol's deletes (answer 1060). Alternatively, Carol could complete her deletes before Betty starts, in which case Carol has no effect(answer 1000 or 1060). Carol could complete her deletes after Betty's inserts, but before Alice reads, in which case Alice sees only 10 from among Betty's inserts (answer 1010). Since the isolation level is READ COMMITTED and not SERIALIZABLE, another possibility is that Carol starts before Betty, deleting 30 (which has no effect on R), then Betty does her inserts and commits, then Carol deletes 20, leaving 10 and 30 in R. Finally, Alice executs (answer 1040). There are no other possibilities, so the possible sums are 1000, 1010, 1040, 1060.

Question 3
---------------------
Consider a relation R(x) containing integers. Suppose Alice runs a transaction that is a query: 
```SQL
   select sum(x) from R;
   commit;
```
Betty's transaction is a sequence of inserts: 
```SQL
   insert into R values (10);
   insert into R values (20);
   insert into R values (30);
   commit;
```
Carol's transaction is a sequence of deletes: 
```SQL
   delete from R where x=30;
   delete from R where x=20;
   commit;
```
Before any of these transactions execute, the sum of the integers in R is 1000, and none of these integers are 10, 20, or 30. Alice's, Betty's, and Carol's transactions run at about the same time. Which of the following sums could be returned by Alice's transaction if all three transactions run under isolation level READ UNCOMMITTED, but not if all three run under isolation level SERIALIZABLE? 

**Answer:** 
1030

**Explanation:** 
If all three transactions have isolation level SERIALIZABLE, the effect must be equivalent to one of: ABC, CAB, or ACB (answer 1000); BAC or CBA (answer 1060); BCA (answer 1010). If all three transactions have isolation level READ UNCOMMITTED, many more things can happen. We need to consider all possible sequences of events up to the time Alice reads: 

1.	Carol does nothing or has executed her deletes before Betty inserted the integers that would've been deleted. Then Alice's sum can be 1000, 1010, 1030, or 1060, depending how far Betty has progressed. 
2.	Carol deleted 30 after Betty inserted 30, but Carol has not deleted 20 yet. Then Alice's sum is 1030. 
3.	Carol deleted 30 before Betty inserted 30, but deleted 20 after Betty inserted 20. Then Alice's sum is either 1010 or 1040, depending whether Betty has yet inserted 30. 
4.	Carol deleted 20 and 30 after Betty inserted them. Then Alice's sum is 1010. 

Thus with READ UNCOMMITTED Alice can get a sum of 1000, 1010, 1030, 1040, or 1060. We saw with SERIALIZABLE Alice's sum can be 1000, 1010, or 1060, so 1030 and 1040 are in the difference.
