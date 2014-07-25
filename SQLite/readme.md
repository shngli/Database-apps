For most of these problems, you will use the **reuters.db** database consisting of a single table:
```SQL
frequency(docid, term, count)
````
where `docid` is a document identifier corresponding to a particular file of text, `term` is an English word, and `count` is the number of the occurrences of the term within the document indicated by `docid`.

Problem 1: Inspecting the Reuters Dataset
-----------------------------------------
a) **select**: Write a query that is equivalent to the relational algebra expression `σ10398_txt_earn(frequency)`. Output select.txt containing a single line with the number of records.

b) **select project**: Write a SQL statement that is equivalent to the relational algebra expression `πterm(σdocid=10398_txt_earn and count=1(frequency))`. Output select_project.txt stating the number of records.

c) **union**: Write a SQL statement that is equivalent to the relational algebra expression `πterm(σdocid=10398_txt_earn and count=1(frequency)) U πterm(σdocid=925_txt_trade and count=1(frequency))`. Output union.txt containing a single line with the number of records.

d) **count**: Write a SQL statement to count the number of documents containing the word "parliament." Output count.txt containing a single line with the number of records. 

e) **big documents**: Write a SQL statement to find all documents that have more than 300 total terms, including duplicate terms. Output big_documents.txt containing a single line with the number of records.

f) **two words**: Write a SQL statement to count the number of unique documents that contain both the word 'transactions' and the word 'world'. Output two_words.txt containing a single line with the number of records.

Problem 2: Matrix Multiplication in SQL
---------------------------------------
Systems designed to efficiently support sparse matrices look a lot like databases; they represent each cell as a record `(i,j,value)`. Within **matrix.db**, there are two matrices A and B represented as follows:
```SQL
A(row_num, col_num, value)

B(row_num, col_num, value)
```
The matrix A and matrix B are both square matrices with 5 rows and 5 columns each.

g) **multiply**: Express A X B as a SQL query. Output multiply.txt containing a single line with the value of the cell (2,3).

Problem 3: Working with a Term-Document Matrix
----------------------------------------
The reuters dataset can be considered a term-document matrix, which is an important representation for text analytics. Each row of the matrix is a ***document vector***, with one column for every term in the entire corpus. Naturally, some documents may not contain a given term, so this matrix is rather sparse. The value in each cell of the matrix is the term frequency.

h) **similarity matrix**: Write a query to compute the similarity matrix ***DD^T***. (Hint: The transpose is trivial -- just join on columns to columns instead of columns to rows.) Output similarity_matrix.txt containing a single line giving the similarity of the two documents '10080_txt_crude' and '17035_txt_earn'.


i) **keyword search**: Find the best matching document to the keyword query "washington taxes treasury". keyword_search.txt contains a single line giving the maximum similarity score between the query and any document. The SQL query should return a list of (docid, similarity) pairs.
