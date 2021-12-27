## project requirements
1- Open Source PHP Server Hosts like XAMPP or WAMP
<a href="https://serverguy.com/servers/php-servers/"> Read more </a>   
2- composer <a href="https://getcomposer.org/"> Read more </a>


## laravel task
    1- login

    User can login with email && password.
    User can login with google account. 
   
    ---------------------------------------
   
    2- posts 

    The user can view his post in list view with attachments for each post
    The user can add new post with title, body and attachments for each post
    The user can edit his posts 
    The user can delete his posts (single row - multiple row) 




## To run project
1- git clone git@github.com:mohamedfayez455/laravel-task.git

2- If there is no file named .env rename .env.example file to .env

3- update .env file

Create a database and add its name to the variable DB_DATABASE

    DB_DATABASE=mega
If your database has username or password you need to add them in the variables

    DB_USERNAME=root
    DB_PASSWORD=
4- open terminal in project folder and write this commands

       composer update
       php artisan optimize:clear
       php artisan migrate:fresh --seed
       php artisan serve 

5- You can browse the site through this link <a href="http://127.0.0.1:8000/login"> Browse </a>

you can log in with this data to browse posts

    email    => user@gmail.com
    password => 123456 
