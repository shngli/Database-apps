(: Author: Chisheng Li :)

(: Return the area of Mongolia. :)
doc("countries.xml")//country[@name = "Mongolia"]/data(@area)

(: Return the names of all cities that have the same name as the country in which they are located. :)
doc("countries.xml")//country[@name = city/name]/data(@name)
 
(: Return the average population of Russian-speaking countries. :)
avg(doc("countries.xml")//country[language="Russian"]/data(@population))

(: Return the names of all countries that have at least three cities with population greater than 3 million.
 :)
doc("countries.xml")//country[count(city[population>3000000])>=3]/data(@name)

(: Create a list of French-speaking and German-speaking countries. :)
<result>
<French>
{for $b in doc("countries.xml")//country
where $b/language="French"
return <country>{ $b/data(@name) }</country> }
</French>
<German>
{for $b in doc("countries.xml")//country
where $b/language="German"
return <country>{ $b/data(@name) }</country> }
</German>
</result>

(: Return the countries with the highest and lowest population densities.:) 
<result>
<highest density="{max(doc("countries.xml")//country/(@population div @area))}">
{ for $b in doc("countries.xml")//country
where data($b/(@population div @area)) = max(doc("countries.xml")//country/(@population div @area))
return data($b/@name)
}
</highest>
<lowest density="{min(doc("countries.xml")//country/(@population div @area))}">
{ for $b in doc("countries.xml")//country
where data($b/(@population div @area)) = min(doc("countries.xml")//country/(@population div @area))
return data($b/@name)
}
</lowest>
</result>

(: Return the names of all countries with population greater than 100 million. :)
doc("countries.xml")//country[data(@population) > 100000000]/data(@name)
  
(: Return the names of all countries where over 50% of the population speaks German. :)
doc("countries.xml")//country/language[contains(.,"German") and data(@percentage)>50]/../data(@name)