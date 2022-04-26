-- truncate all tables
set foreign_key_checks=0;
truncate table tag;
truncate table word;
truncate table wordlist;
truncate table wordtag;
set foreign_key_checks=1;