<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>
<title>Error 401</title>
</head>
<meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
/>
<style>
body {
     background-color: lightblue;
	 text-align: center;
	 font-family: "Trebuchet MS", Helvetica, sans-serif;
}

h1 {
    color: #fff;
	background-color: #3ad;
    margin-left: 40px;
	border-radius:20px;
} 

input {
	border: 2px solid #fff;
	border-radius: 10px;
	outline: none;
} 
input[type=submit] {
	color: #fff;
	background-color: #3ad;
	font-size: 20px;
	padding: 8px 8px 8px 8px;
	width:150px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
	 -webkit-transition-property: background,color;
       -moz-transition-property: background,color;
         -o-transition-property: background,color;
            transition-property: background,color;
    -webkit-transition-duration: 0.2s;
       -moz-transition-duration: 0.2s;
         -o-transition-duration: 0.2s;
            transition-duration: 0.2s;
    -webkit-transition-timing-function: ease-in-out;
       -moz-transition-timing-function: ease-in-out;
         -o-transition-timing-function: ease-in-out;
            transition-timing-function: ease-in-out;
} 
input[type=submit]:focus {
    color: #3ad;
	background-color: #fff;
	width: 170px;
}
input[type=submit]:hover {
    color: #3ad;
	background-color: #fff;
}
input[type=text] {
    width: 130px;
	max-width:500px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 10px;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 100%;
}
</style>

<body>

<h1>500 Oops... Something wrong...</h4>

The page you are looking for is forbidden. Pleas try to <a href="./indexstandalone.php?plugin=Search">Search</a> or <a href="./Login.php">Login</a>.<br><br>


<form name="formzoek"  action="indexstandalone.php" method="GET" name="Users" accept-charset="UTF8"><input type="hidden" name="plugin" value="Search" border="0"><input type="hidden" name="type" value="" border="0"><input type="text" name="Searchstring" id ="Searchstring" value="" size="24" border="0"> 
	<input type="submit" value="Search">
	</form>

</body>