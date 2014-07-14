select A.row_num, B.col_num, sum(A.value * B.value)
from A, B
where A.col_num = B.row_num
group by A.row_num, B.col_num;