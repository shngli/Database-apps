select count(*) from (select term from frequency f1 where f1.docid='10398_txt_earn' and f1.count=1 union select term from frequency f2 where f2.docid='925_txt_trade' and f2.count=1);