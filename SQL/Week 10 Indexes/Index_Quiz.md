Indexes Quiz 
=======================

Question 1
--------------------
Consider the following relational schema: 
```SQL
   Course(courseName unique, department, instrID)
   Instructor(instrID unique, office)
   Student(studentID unique, major)
   Enroll(studentID, courseName, unique (studentID,courseName))
```
Suppose there are five types of queries commonly asked on this schema: 
*	Given a course name, find the department offering that course.
*	List all studentIDs together with all of the departments they are taking courses in.
*	Given a studentID, find the names of all courses the student is enrolled in.
*	List the offices of instructors teaching at least one course.
*	Given a major, return the studentIDs of students in that major.

Which of the following indexes could NOT be useful in speeding up execution of one or more of the above queries? 

**Answer:** 
* Index on Student.studentID
* Index on Course.department

**Explanation:** 
An index on an attribute R.A may be useful whenever a query has a selection condition on R.A, or does a join involving R.A.

Question 2
-------------------
Consider a table storing temperature readings taken by sensors: 
```SQL
   Temps(sensorID, time, temp)
```
Assume the pair of attributes [sensorID,time] is a key. Consider the following query: 
```SQL
   select * from Temps
   where sensorID = 'sensor541'
   and time = '05:11:02'
```
Consider the following scenarios:
* A - No index is present on any attribute of Temps
* B - An index is present on attribute sensorID only
* C - An index is present on attribute time only
* D - Separate indexes are present on attributes sensorID and time
* E - A multi-attribute index is present on (sensorID,time)

Suppose table Temps has 50 unique sensorIDs and each sensorID has exactly 20 readings. Furthermore there are exactly 10 readings for every unique time in Temps.

For each scenario A-E, determine the maximum number of tuples that might be accessed to answer the query, assuming one "best" index is used whenever possible. (Don't count the number of index accesses.) Which of the following combinations of values is correct? 

**Answer:** 
* B:20, C:10, E:1
* B:20, D:10, E:1

**Explanation:** 
The query has an equality condition on both the sensorID and time attributes of Temps. Since [sensorID,time] is a key, the query result contains either 0 or 1 tuples.

Scenario A: Since there are no indexes, all tuples of the table may need to be accessed to look for 'sensor541' and '05:11:02'. The number of tuples in Temps is 50 (unique sensorIDs) * 20 (number of readings per sensor) = 1000.

Scenario B: Using the index on sensorID, 20 readings will match the given sensorID, and all 20 tuples may need to be accessed to look for a matching time.

Scenario C: Using the index on time, 10 readings will match the given time, and all 10 tuples may need to be accessed to look for a matching sensorID.

Scenario D: Using the time index is better than using the sensorID index, so the time index is used and is the same as scenario C (10 tuples).

Scenario E: The index on [sensorID, time] will directly find the single matching tuple, if there is one.
