For most of these problems, you will use the **reuters.db** database consisting of a single table:
```SQL
frequency(docid, term, count)
````
where `docid` is a document identifier corresponding to a particular file of text, `term` is an English word, and `count` is the number of the occurrences of the term within the document indicated by `docid`.

Problem 1: Inspecting the Reuters Dataset
-----------------------------------------
a) **select**: Write a query that is equivalent to the relational algebra expression `σ10398_txt_earn(frequency)`. select.txt contains a single line with the number of records.

b) **select project**: Write a SQL statement that is equivalent to the relational algebra expression `πterm(σdocid=10398_txt_earn and count=1(frequency))`. select_project.txt states the number of records.

c) **union**: Write a SQL statement that is equivalent to the relational algebra expression `πterm(σdocid=10398_txt_earn and count=1(frequency)) U πterm(σdocid=925_txt_trade and count=1(frequency))`. union.txt contains a single line with the number of records.

d) **count**: Write a SQL statement to count the number of documents containing the word "parliament." count.txt contains a single line with the number of records. 

e) **big documents**: Write a SQL statement to find all documents that have more than 300 total terms, including duplicate terms. big_documents.txt contains a single line with the number of records.

f) **two words**: Write a SQL statement to count the number of unique documents that contain both the word 'transactions' and the word 'world'. two_words.txt contains a single line with the number of records.

Problem 2: Matrix Multiplication in SQL
---------------------------------------
Systems designed to efficiently support sparse matrices look a lot like databases; they represent each cell as a record `(i,j,value)`. Within **matrix.db**, there are two matrices A and B represented as follows:
```SQL
A(row_num, col_num, value)

B(row_num, col_num, value)
```
The matrix A and matrix B are both square matrices with 5 rows and 5 columns each.

g) **multiply**: Express A X B as a SQL query. multiply.txt contains a single line with the value of the cell (2,3).

Problem 3: Working with a Term-Document Matrix
----------------------------------------
The reuters dataset can be considered a term-document matrix, which is an important representation for text analytics. Each row of the matrix is a ***document vector***, with one column for every term in the entire corpus. Naturally, some documents may not contain a given term, so this matrix is rather sparse. The value in each cell of the matrix is the term frequency.





