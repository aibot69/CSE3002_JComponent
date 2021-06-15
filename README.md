
# Library Self Check-in System
This repository is made as a project for the subject Internet and Web Programming for the semester Winter Semester 2020-21 in VIT Vellore.

## Overview
This project is created to automate the process of borrowing books from a library from anywhere and enabling the user to either borrow the book easily without any check-out process, similar to how online check-in works for flights. The difference in concept here is that people can check the availability of books beforehand and book them for picking up later.

## How to run project
1. Open a command prompt or bash shell.
2. Give the following command.
```
git clone https://github.com/aibot69/CSE3002_JComponent
```
3. If you have XAMPP or WAMP installed, move the folder where you can run PHP, otherwise download PHP from [here](https://www.php.net/downloads.php).
4. Open a terminal inside the folder.
5. Type in `php -S localhost:8080` and open this to run the website on port 8080 in your localhost.

## Database Queries
There are four tables used within this web app. Each table is given in CSV format and described below:
### 1. admins
This table keeps track of administrators registered for the app. This type of user cannot register from within the app and should be pre-registered to the database.
```
Field;Type;Null;Key;Default;Extra
username;varchar(255);NO;PRI;NULL;
password;varchar(255);NO;;NULL;
fname;varchar(20);NO;;FirstName;
lname;varchar(20);NO;;LastName;
```
### 2. books
All books are kept in this table. There is no feature yet to update their fields or add/delete books from inside the app.
```
Field,Type,Null,Key,Default,Extra
ISBN,varchar(13),NO,PRI,NULL,
title,varchar(70),YES,,Book,
author,varchar(45),YES,,Anonymous,
publisher,varchar(30),YES,,None,
avail,int,YES,,0,
Price,float,YES,,0,
desc,varchar(300),YES,,"Not available",
bind,varchar(20),YES,,Paperback,
```
### 3. cart
This table associates the ISBN of a book add to the cart with the respective user.
```
Field,Type,Null,Key,Default,Extra
index,int,NO,PRI,NULL,auto_increment
isbnc,varchar(13),NO,,NULL,
usernc,varchar(255),NO,,NULL,
titlec,varchar(70),NO,,NULL,
```
### 4. users
This table keeps a track of all users, enabling the respective users to alter their records. The administrator can alter all record details too.
```
Field,Type,Null,Key,Default,Extra
user_n,varchar(255),NO,PRI,NULL,
user_p,varchar(255),NO,,NULL,
user_f,varchar(45),NO,,NULL,
user_l,varchar(45),NO,,NULL,
```
