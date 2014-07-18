Write each of the following queries using either XPath or XQuery.

Return all Title elements (of both departments and courses).
```XQuery
doc("courses-noID.xml")/Course_Catalog//*/Title
```

Return last names of all department chairs.
```XQuery
doc("courses-noID.xml")/Course_Catalog/Department/Chair/Professor/Last_Name
```

Return titles of courses with enrollment greater than 500.
```XQuery
doc("courses-noID.xml")/Course_Catalog/Department/Course[@Enrollment>500]/Title
```

Return titles of departments that have some course that takes "CS106B" as a prerequisite.
```XQuery
doc("courses-noID.xml")/Course_Catalog/Department[Course/Prerequisites/Prereq="CS106B"]/Title
```

Return last names of all professors or lecturers who use a middle initial.Don't worry about eliminating duplicates.
```XQuery
doc("courses-noID.xml")//(Lecturer|Professor)[Middle_Initial]/Last_Name
```

Return the count of courses that have a cross-listed course (i.e., that have "Cross-listed" in their description).
```XQuery
doc("courses-noID.xml")/Course_Catalog/count(Department/Course[contains(Description,"Cross-listed")])
```

Return the average enrollment of all courses in the CS department.
```XQuery
doc("courses-noID.xml")//Department[@Code="CS"]/avg(Course/@Enrollment)
```





