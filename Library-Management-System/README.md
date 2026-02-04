## Topic: Library_Management System

A fully functional Library management System developed using PHP,SQL, HTML, CSS, and JavaScript.  
The application enables users to create, manage, and borrow books from a library's database

# Link to Working Website 
https://student.heraldcollege.edu.np/~np03cs4a240217/Library-Management-System/

# Github Link
https://github.com/PrajuMaharjan/Library-Management-System/tree/master


# Login Crediantials

-System Admin
Username: admin
Password : admin123

- User1
Username: Praju Maharjan
Password :qwertyuiop

- User2
Username: Sunil Shrestha
Password :sunil12345



## Setup Instructions

1. Install XAMPP and start Apache & MySQL.  

2. Copy the project folder into `C:\xampp\htdocs\`.  

3. Open `http://localhost/phpmyadmin`, create a database, and import the `.sql` file.  

4. Update database credentials in `db.php`.  

5. Open `http://localhost/` in the browser.


## Features

### CRUD Operations
- Admin can add new books.  
- User can get descriptions of books and borrow them  
- Admin can edit details of books  
- Admin can remove books from the application's database  


### Filtering and Sorting
- User can filter the books by genre
- User can sort the books by alphabetical order(a-z,z-a),rating and number of times borrowed

### Security
- SQL Injection prevention using prepared statements  
- XSS protection with `htmlspecialchars()`  
- Secure password hashing using `password_hash()`  
- Session-based authentication  
- Client-side and server-side validation 


# Issue
-Both user and admin can only log out from their respective dashboard page, not the index/home page

