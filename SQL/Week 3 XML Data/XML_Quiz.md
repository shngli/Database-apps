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

Question 3
-------------------
An XML document contains the following portion: 
```XML
<EMP name = "Kermit">
    <ADDR>123 Sesame St.</ADDR>
    <PHONE type = "cell">555-1212</PHONE>
</EMP>
```
Which of the following could NOT be part of a DTD that the document matches? Note that there can be multiple ATTLIST declarations for a single element type; do not assume the only attributes allowed for an element type are the ones shown in the answer choice. 

**Answer:** 
* `<!ATTLIST PHONE owner IDREF #REQUIRED>` This is a correct choice, because a #REQUIRED attribute must appear with every element. In the example fragment of a document, we do not see the owner attribute in the PHONE element.
* `<!ATTLIST EMP ssNo CDATA #REQUIRED>` This is a correct choice, because a #REQUIRED attribute must appear with every element. In the example fragment of a document, we do not see the ssNo attribute in the EMP element.

**Explanation:** 
The correct choices (i.e., the erroneous DTD snippets) are based on two rules: 
1.	A #REQUIRED attribute must appear in every element. 
2.	An attribute can have types CDATA, ID, or IDREF(S), but not #PCDATA. 
The incorrect choices (i.e., the snippets that could appear in a DTD), are either optional attributes (#IMPLIED) or are required attributes of a proper type. 

Eg. 
* `<!ATTLIST EMP name CDATA #REQUIRED>` There is nothing wrong with this declaration. It says that EMP elements are required to have a name attribute, but the only example of such an element that we see does indeed have this attribute.

* `<!ATTLIST EMP name IDREF #REQUIRED>` There is nothing wrong with this declaration. It says that EMP elements are required to have a name attribute, but the only example of such an element that we see does indeed have this attribute. The fact that it would be illogical for this attribute to be an IDREF is beside the point. It might be the name of the employee's manager, for example.

**Question 4**
Here is a DTD: 
```DTD
<!DOCTYPE A [
    <!ELEMENT A (B+, C)>
    <!ELEMENT B (#PCDATA)>
    <!ELEMENT C (B?, D)>
    <!ELEMENT D (#PCDATA)>
]>
```
Which of the following sequences of opening and closing tags matches this DTD? Note: In actual XML, opening and closing tags would be enclosed in angle brackets, and some elements might have text subelements. This quiz focuses on the element sequencing and interleaving specified by the DTD. 

**Answer:** 
* A B /B C B /B D /D /C /A
* A B /B B /B C B /B D /D /C /A

**Explanation:** 
According to the DTD, an A element has within it one or more B subelements, and then a C element. Within the C element is zero or one B elements followed by exactly one D element. In terms of regular expressions, the tag sequences we can see are:A (B /B)(B /B)* C (D /D | B /B D /D) /C /A. 

Some text may appear between each B-/B pair and each D-/D pair, but text may not appear elsewhere. 

Question 5
----------------------------
Here is an XML DTD: 
```DTD
<!DOCTYPE meal [
    <!ELEMENT meal (person*,food*,eats*)>
    <!ELEMENT person EMPTY>
    <!ELEMENT food EMPTY>
    <!ELEMENT eats EMPTY>
    <!ATTLIST person name ID #REQUIRED>
    <!ATTLIST food name ID #REQUIRED>
    <!ATTLIST eats diner IDREF #REQUIRED dish IDREF #REQUIRED>
]>
```
Which of the following documents match the DTD?
1.
```DTD
<meal>
  <person name="Alice"/>
  <food name="salad"/>
  <eats diner="Alice" dish="salad"/>
  <person name="Bob"/>
  <food name="salad"/>
  <eats diner="Bob" dish="salad"/>
  <person name="Carol"/>
  <food name="sandwich"/>
  <eats diner="Carol" dish="sandwich"/>
</meal>
```
2.
```DTD
<meal>
  <person name="Alice"/>
  <person name="Bob"/>
  <person name="Carol"/>
  <person name="Dave"/>
  <food name="salad"/>
  <food name="turkey"/>
  <food name="sandwich"/>
  <eats diner="Alice" dish="turkey"/>
  <eats diner="Bob" dish="salad"/>
  <eats diner="turkey" dish="Dave"/>
</meal>
```
3.
```DTD
<meal>
  <person name="Alice"/>
  <person name="Bob"/>
  <food name="salad"/>
  <eats diner="Alice" dish="food"/>
  <eats diner="Bob" dish="food"/>
</meal>
```

**Answer:** only the second

**Explanation:** 
Focus on the ID and IDREF attributes: A valid document needs to have unique values across ID attributes. An IDREF attribute can refer to any existing ID attribute value.

Question 6
--------------------------
Study the following XML Schema specification: 
```XML
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
  <xs:element name="person">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="fname" type="xs:string"/>
        <xs:element name="initial" type="xs:string"
            minOccurs="0"/>
        <xs:element name="lname" type="xs:string"/>
        <xs:element name="address" type="xs:string"
            maxOccurs="2"/>
        <xs:choice>
          <xs:element name="major" type="xs:string"/>
          <xs:element name="minor" type="xs:string"
              minOccurs="2" maxOccurs="2"/>
        </xs:choice>
      </xs:sequence>
    </xs:complexType>
  </xs:element>
</xs:schema>
```
Select, from the choices below, the XML that is valid according to the XML Schema specification above.

**Answer:** 
```XML
  <person>
    <fname>John</fname>
    <initial>Q</initial>
    <lname>Public</lname>
    <address>123 Public Avenue</address>
    <address>Seattle, WA 98001</address>
    <major>Computer Science</major>
  </person>
```
**Answer2:**  
```XML
<person>
    <fname>John</fname>
    <initial>Q</initial>
    <lname>Public</lname>
    <address>123 Public Avenue, Seattle, WA 98001</address>
    <major>Computer Science</major>
  </person>
```
**Answer 3:**
```XML
  <person>
    <fname>John</fname>
    <lname>Public</lname>
    <address>123 Public Avenue, Seattle, WA 98001</address>
    <major>Computer Science</major>
  </person>
```

**Explanation:**
This question deals with the xs:element, xs:sequence, and xs:choice elements in XML Schema. In order for XML to be valid according to the specified schema:
*	The elements contained in a sequence must appear in exactly the same order as specified in the xs:sequence.
*	Exactly one of the elements contained in an xs:choice must appear.
*	If an element specifies a minOccurs attribute, the XML must contain at least that many instances of the element.
*	If an element specifies a maxOccurs attribute, the XML must not contain more than that many instances of the element.
*	If minOccurs and maxOccurs are not specified, their default value is 1.
*	Elements not defined as a part of a sequence or choice cannot occur inside the corresponding xs:sequence and xs:choice.

The given schema specifies the following constraints:
*	The "fname", "initial", "lname", and "address" elements must occur in that sequence.
*	The "initial" element is optional due to its minOccurs value being 0.
*	The "address" element can occur either 1 or 2 times due to its maxOccurs value being 2.
*	After the "address" element, either exactly one "major" element or exactly 2 "minor" elements can occur, but not both.
*	Elements not defined as a part of this schema specification are not allowed to occur as a part of the "person" element.

Here is an example of valid XML for this schema: 
```XML
  <person>
    <fname>John</fname>
    <initial>Q</initial>
    <lname>Public</lname>
    <address>123 Public Avenue</address>
    <address>Seattle, WA 98001</address>
    <major>Computer Science</major>
  </person>
```
