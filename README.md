# EasyRecipe
A PHP MVC summer project

This project will not run unless a file named 'ConnectionString.php' is added to the root directory. 
The content of ConnectionString.php should look similar to this:

```
<?php
$host = 'HOST HERE';
$db   = 'DB NAME HERE';
$user = 'USERNAME FOR DB HERE';
$pass = 'PASSWORD FOR ABOVE USERNAME';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$db = new PDO($dsn, $user, $pass, $opt);
?>
```
This will create the db object used throughout EasyRecipe for queries.

This project runs a local Apache server with a MySQL database. 
Although I'm not using any frameworks for PHP, I'm still working to create a clean, MVC feel for it.
The basic idea of this project is to have a working template for future MVC projects written in PHP
that I might end up doing. This code may be used in accordance to the MIT License reproduced below.

<em>Copyright 2017 Jonah Wasserman

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</em>
