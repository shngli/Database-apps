(: Author: Chisheng Li)
(: Write each of the following queries using XQuery. :)

(: Return all Title elements (of both departments and courses). :)
doc("courses-noID.xml")/Course_Catalog//*/Title

(: Return last names of all department chairs. :)
doc("courses-noID.xml")/Course_Catalog/Department/Chair/Professor/Last_Name

(: Return titles of courses with enrollment greater than 500. :)
doc("courses-noID.xml")/Course_Catalog/Department/Course[@Enrollment>500]/Title

(: Return titles of departments that have some course that takes "CS106B" as a prerequisite. :)
doc("courses-noID.xml")/Course_Catalog/Department[Course/Prerequisites/Prereq="CS106B"]/Title

(: Return last names of all professors or lecturers who use a middle initial. :)
(: Don't worry about eliminating duplicates. :)
doc("courses-noID.xml")//(Lecturer|Professor)[Middle_Initial]/Last_Name

(: Return the count of courses that have a cross-listed course. :)
doc("courses-noID.xml")/Course_Catalog/count(Department/Course[contains(Description,"Cross-listed")])

(: Return the average enrollment of all courses in the CS department. :)
doc("courses-noID.xml")/Course_Catalog/Department[@Code="CS"]/avg(Course/@Enrollment)

(: Return last names of instructors teaching at least one course that has "system" in its description and enrollment greater than 100. :)
doc("courses-noID.xml")/Course_Catalog/Department/Course[contains(Description,"system") and @Enrollment>100]/Instructors//Last_Name

(: Return the title of the course with the largest enrollment. :)
doc("courses-noID.xml")//Course[@Enrollment and not (@Enrollment > following::*/data(@Enrollment)) and not (@Enrollment > preceding::*/data(@Enrollment))]/Title

(: Return the course number of the course that is cross-listed as "LING180". :)
doc("courses-noID.xml")//Course_Catalog/Department/Course[contains(Description,"LING180")]/data(@Number)

(: Return course numbers of courses that have the same title as some other course. :)
doc("courses-noID.xml")//Course_Catalog/Department/Course[Title = following::*/data(Title) or Title = preceding::*/data(Title)]/data(@Number)

(: Return course numbers of courses taught by an instructor with first name "Daphne" or "Julie". :)
doc("courses-noID.xml")//Course_Catalog/Department/Course[Instructors//First_Name = "Daphne" or Instructors//First_Name = "Julie"]/data(@Number)

(: Return titles of courses that have both a lecturer and a professor as instructors. :)
(: Return each title only once. :)
doc("courses-noID.xml")//Course_Catalog/Department/Course[count(Instructors/Lecturer) and count(Instructors/Professor)> 0]/Title

(: Return the number (count) of courses that have no lecturers as instructors. :)
count(doc("courses-noID.xml")//Course_Catalog/Department/Course[count(Instructors/Lecturer)= 0])

(: Return titles of courses taught by the chair of a department. :)
(: Assume that all professors have distinct last names. :)
doc("courses-noID.xml")//Course_Catalog/Department/Course[Instructors//Last_Name = parent::Department/Chair/Professor//Last_Name]/Title

(: Return titles of courses taught by a professor with the last name "Ng" but not by a professor with the last name "Thrun". :)
let $catalog := doc('courses-noID.xml'),
  $courses := $catalog//Course
  for $c2 in (
    for $c in $courses
      where every $name in $c//Professor/Last_Name satisfies $name != 'Thrun'
      return $c 
    )
  where $c2//Professor/Last_Name = 'Ng'
  return $c2/Title

(: Return course numbers of courses that have a course taught by Eric Roberts as a prerequisite. :)
let $catalog := doc('courses-noID.xml'),
  $courses := $catalog//Course
  for $c2 in $courses
  where $c2//data(Prereq) = (
  for $c in $courses
    let $firsts := $c//Instructors/*/First_Name,
        $lasts := $c//Instructors/*/Last_Name
    where $firsts = 'Eric' and $lasts = 'Roberts'
    return $c/data(@Number)
  )
  return $c2/data(@Number)

(: List all CS department courses in order of enrollment. :)
(: For each course include only its Enrollment  and its Title. :)
let $catalog := doc('courses-noID.xml'),
  $courses := $catalog//Department[@Code = 'CS']/Course
return <Summary> 
  {
    for $c in $courses
      order by xs:int($c/@Enrollment)
      return <Course Enrollment = "{$c/data(@Enrollment)}">{$c/Title}</Course>
  }
  </Summary>

(: Return a "Professors" element that contains a listing of all professors in all departments as subelements , sorted by last name with each professor appearing once. :)
(: The "Professor" subelements should have the same structure as in the original data. :)
(: Assume that all professors have distinct last names. :)
let $catalog := doc('courses-noID.xml'),
  $professors := $catalog//Professor

let $distinct_prof := (
      $professors except (
        for $p in $professors
          where ($p/Last_Name = $p/following::*/Last_Name and $p/First_Name = $p/following::*/First_Name)
          return $p
      )
    )

return <Professors>
  {
    for $p in $distinct_prof
    order by $p/Last_Name
    return $p
  }
  </Professors>
