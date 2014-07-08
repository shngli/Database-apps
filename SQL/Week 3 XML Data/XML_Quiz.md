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

Question 2
---------------------
An XML document contains the following portion: 
```XML
     <INFO>
         <ADDR>101 Maple St.</ADDR>
         <PHONE>555-1212</PHONE>
         <PHONE>555-4567</PHONE>
     </INFO>
```
Which of the following could be the INFO element specification in a DTD that the document matches? 

**Answer:** 
* `<!ELEMENT INFO (ADDR,PHONE*,MANAGER?)>`
* `<!ELEMENT INFO (ADDR*,PHONE+)>`
* `<!ELEMENT INFO (NAME*,ADDR,PHONE+)>`

**Explanation:**
In the XML snippet, the info element has one address subelement and two phone subelements, in that order. Thus, in the DTD the list of components for INFO must include `ADDR, ADDR*, ADDR+, or ADDR? followed by PHONE* or PHONE+`. Interspersed with these may be any elements that are not required to appear-- that is, any components with a `?` or `*`. Thus, we might also have components like `NAME*` or `MANAGER?` at any point in the list.

Eg.
* `<!ELEMENT INFO (ADDR+,PHONE+,MANAGER)>` This declaration requires every INFO element to have a MANAGER subelement.
* `<!ELEMENT INFO (ADDR,PHONE?)>` The ? says that there can be at most one phone.

