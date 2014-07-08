/*** Schema for OLAP demo on MySQL ***/

drop table if exists Store;
drop table if exists Item;
drop table if exists Sales;
drop table if exists Customer;

create table Store(storeID char(6) primary key, city text, county text, state text);
create table Item(itemID char(6) primary key, category text, color text);
create table Customer(custID char(6) primary key, cName text, gender char, age int);
create table Sales(storeID char(6) references Store, itemID char(6) references Item, custID char(6) references Customer, price text);
