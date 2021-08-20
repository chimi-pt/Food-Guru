<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="client" )
{
    header("location:test.php");
}

?>

<html>
    <head>
        <title>Food Guru</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="background-color: wheat">
        <a href="logout.php" style="position: absolute;top: 0;right: 0; font-size: 50px; color: red " >LOGOUT</a>

        <h1 style="color: blue">Welcome <?=  $_SESSION ['username'] ?></h1>
        <h1 style="color: blue">You are a <?=  $_SESSION ['role'] ?></h1>
        <h1 ><strong><i>Food Guru</i></strong></h1>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ6lFdfei7VTGv5RrBkMZoobgMJuxQVLvLxYhP58bnyloSez3kl&usqp=CAU">
        
        <h2>Home Page</h2>
        
        <fieldset>
            <legend><strong>Buy Food</strong></legend>
            <p> To purchase our food products please visit our <a href="C:\Users\njeke\Documents\Things\School\2.1\Active\Web Application Development\Notes\HTML\Activities\Food Guru Grocery.html" title="Food Guru Grocery" target="_blank"><i>Food Guru Grocery</i></a></p>
        </fieldset>
        <br><br>
        <fieldset>
            <legend><strong>Supply Food</strong></legend>
            <p>To find out more about supplying oof food products please visit our <a href="C:\Users\njeke\Documents\Things\School\2.1\Active\Web Application Development\Notes\HTML\Activities\Food Guru Supply.html" title="Food Guru Suppliers" target="_blank"><i>Food Guru Supply Page</i></a></p>
        </fieldset>
        <br><br>
        <fieldset>
            <legend><strong>Food inquiries</strong></legend>
            <p> To find out more for the love of food, please visit our <a href="C:\Users\njeke\Documents\Things\School\2.1\Active\Web Application Development\Notes\HTML\Activities\Food Guru Inquiries.html" title="Food Guru Inquiries" target="_blank"><i>Food Guru Inquiry Page</i></a>
        </fieldset>
        <br>
        <fieldset>
            <legend><strong>Contact us</strong></legend>
            <p>To talk to us, please contact us on :</p>
            <p>Email: <a href="mailto:info@foodguru.co.ke"><i>info@foodguru.co.ke</i></a></p>
            <p>Telephone: <a>0208474632</a></p>
        </fieldset>
        <br><br>
    </body>
</html>
