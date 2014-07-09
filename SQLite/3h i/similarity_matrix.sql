select A.docid, B.docid, sum(A.count * B.count) from frequency A join frequency B on A.term = B.term where A.docid = '10080_txt_crude' and B.docid = '17035_txt_earn' group by A.docid, B.docid;
