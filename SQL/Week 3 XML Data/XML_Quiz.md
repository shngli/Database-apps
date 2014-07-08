XML Quiz 
====================

Question 1
----------------
We're interested in well-formed XML that satisfies the following conditions: 
* It has a root element "tasklist"
* 	The root element has 3 "task" subelements
* 	Each of the "task" subelements has an attribute named "name"
* 	The values of the "name" attributes for the 3 tasks are "eat", "drink", and "play"

Select, from the choices below, the well-formed XML that meets the above requirements. 

**Answer:** 
```XML
<tasklist>
  <task name="eat"/>
  <task name="drink"/>
  <task name="play"/>
</tasklist>
```

**Answer 2:** 
```XML
<tasklist>
  <task name="eat"></task>
  <task name="drink"></task>
  <task name="play"></task>
</tasklist>
```

**Explanation:** 
Well-formed XML must follow these rules (along with others): 
*	There must be exactly one top level element.
*	All opening tags must be closed.
*	All elements are properly nested i.e., there are no interleaved elements.
*	Attribute values must be enclosed in single or double quotes.
