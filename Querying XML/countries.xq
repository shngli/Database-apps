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

(: Return the names of all countries where a city in that country contains more than one-third of the country's population. :)
doc("countries.xml")/countries/country[city/population > (@population div 3)]/data(@name)

(: Return the population density of Qatar. :)
doc("countries.xml")//country[@name = 'Qatar']/(@population div @area)

(: Return the names of all countries whose population is less than one thousandth that of some city (in any country). :)
doc("countries.xml")/countries/country[@population < //city/(population div 1000)]/data(@name)

(: Return all city names that appear more than once. :)
(: Return only one instance of each such city name. :)
doc("countries.xml")/countries/country/city[name = following::name]/name

(: Return the names of all countries containing a city such that some other country has a city of the same name. :)
doc("countries.xml")/countries/country[city/name = following::city/name | preceding::city/name]/data(@name)

(: Return the names of all countries whose name textually contains a language spoken in that country. :)
(: For instance, Uzbek is spoken in Uzbekistan, so return Uzbekistan. :)
doc("countries.xml")/countries/country[language[contains(parent::country/@name, self::language)]]/data(@name)

(: Return the names of all countries in which people speak a language whose name textually contains the name of the country. :)
(: For instance, Japanese is spoken in Japan, so return Japan. :)
doc("countries.xml")/countries/country[language[contains(., ../@name)]]/data(@name)

(: Return all languages spoken in a country whose name textually contains the language name. :)
(: For instance, German is spoken in Germany, so return German. :)
doc("countries.xml")/countries/country/language[contains(parent::country/@name, self::language)]/data(.)

(: Return all languages whose name textually contains the name of a country in which the language is spoken. :)
(: For instance, Icelandic is spoken in Iceland, so return Icelandic. :)
doc("countries.xml")/countries/country/language[contains(., ../@name)]/data(.)

(: Return the number of countries where Russian is spoken. :)
count(doc("countries.xml")/countries/country[language = 'Russian'])

(: Return the names of all countries for which the data does not include any languages or cities, but the country has more than 10 million people. :)
doc("countries.xml")/countries/country[count(language) = 0 and count(city) = 0 and @population > 10000000]/data(@name)

(: Return the name of the country with the highest population. :)
doc("countries.xml")/countries/country[@population = max(//country/@population)]/data(@name)

(: Return the name of the country that has the city with the highest population. :)
doc("countries.xml")/countries/country[city/population = max(//city/population)]/data(@name)

(: Return the average number of languages spoken in countries where Russian is spoken. :)
avg(doc("countries.xml")//country[data(language) = 'Russian']/count(language))

(: Return all country-language pairs where the language is spoken in the country and the name of the country textually contains the language name. :)
(: Return each pair as a country element with language attribute, e.g., :)
(: <country language="French">French Guiana</country> :)
let $countries := doc("countries.xml")/countries/country
for $c in $countries
  for $l in $c/language
    where contains($c/data(@name), $l)
    return <country language="{data($l)}">{$c/data(@name)}</country>

(: Return all countries that have at least one city with population greater than 7 million. :) 
(: For each one, return the country name along with the cities greater than 7 million, in the format :)
(: <country name="country-name"> :)
(:  <big>city-name</big> :)
(:  <big>city-name</big> :)
(: </country> :)
let $countries := doc("countries.xml")/countries/country
for $c in $countries
  where count($c/city[population > 7000000]) > 0
  return 
    <country name="{$c/data(@name)}">
    {
      for $city in $c/city
        where $city[population > 7000000]
        return <big>{$city/data(name)}</big>
    }
    </country>

(: Return all countries where at least one language is listed, but the total percentage for all listed languages is less than 90%. :)
(: Return the country element with its name attribute and its language subelements, but no other attributes or subelements. :)
let $countries := doc("countries.xml")/countries/country
for $c in $countries[language]
  where sum($c/language/data(@percentage)) < 90
  return 
    <country name="{$c/data(@name)}">
    {
      for $l in $c/language
      return $l
    }
    </country>

(: Return all countries where at least one language is listed, and every listed language is spoken by less than 20% of the population. :)
(: Return the country element with its name attribute and its language subelements, but no other attributes or subelements. :)
let $countries := doc("countries.xml")/countries/country
for $c in $countries[language]
  where every $l in $c/language satisfies $l/data(@percentage) < 20
  return 
    <country name="{$c/data(@name)}">
    {
      for $l in $c/language
      return $l
    }
    </country>

(: Find all situations where one country's most popular language is another country's least popular, and both countries list more than one language. :)
(: Return the name of the language and the two countries, each in the format :)
(: <LangPair language="lang-name"> :)
(:  <MostPopular>country-name</MostPopular> :)
(:  <LeastPopular>country-name</LeastPopular> :)
(: </LangPair> :)
let $countries := doc("countries.xml")/countries/country,
  $most_popular := 
    for $c in $countries[count(language) > 1]
      for $l in $c/language
        where xs:float($l/data(@percentage)) = xs:float(max($c/language/data(@percentage)))
        return $l,

  $least_popular := 
    for $c in $countries[count(language) > 1]
      for $l in $c/language
        where xs:float($l/data(@percentage)) = xs:float(min($c/language/data(@percentage)))
        return $l

  for $m in $most_popular
    for $l in $least_popular
      where data($m) = data($l)
        return
          <LangPair language="{data($l)}">
            <MostPopular>{$m/parent::country/data(@name)}</MostPopular>
            <LeastPopular>{$l/parent::country/data(@name)}</LeastPopular>
          </LangPair>

(: For each language spoken in one or more countries, create a "language" element with a "name" attribute and one "country" subelement for each country in which the language is spoken. :)
(: The "country" subelements should have two attributes: the country "name", and "speakers" containing the number of speakers of that language (based on language percentage and the country's population). :)
(: Order the result by language name, and enclose the entire list in a single "languages" element. :)
(: For example, your result might look like :) 
(: <languages> :)
(:  <language name="Arabic"> :)
(:    <country name="Iran" speakers="660942"/> :)
(:    <country name="Saudi Arabia" speakers="19409058"/> :)
(:    <country name="Yemen" speakers="13483178"/> :)
(:  </language> :)
(: </languages> :)
let $countries := doc("countries.xml")/countries/country,
  $languages := $countries/language,
  $language_names := distinct-values($countries/data(language))
  return 
  <languages>
  {
    for $l_name in $language_names
      order by $l_name
      return 
        <language name="{$l_name}">
        {
          for $l in $languages
            where data($l) = $l_name
            return <country name="{data($l/parent::country/@name)}" speakers="{xs:int($l/parent::country/@population * $l/@percentage div 100) }"/>
        }
        </language>
  }
  </languages>