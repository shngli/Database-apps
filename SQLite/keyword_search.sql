CREATE VIEW IF NOT EXISTS new_frequency AS
SELECT * FROM frequency
UNION
SELECT 'q' as docid, 'washington' as term, 1 as count 
UNION
SELECT 'q' as docid, 'taxes' as term, 1 as count
UNION 
SELECT 'q' as docid, 'treasury' as term, 1 as count;

select A.docid, B.docid, sum(A.count * B.count) as similarity
from new_frequency A join new_frequency B on A.term = B.term 
where A.docid = 'q' and B.docid != 'q'
group by A.docid, B.docid
order by similarity desc;