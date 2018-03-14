<!DOCTYPE html>
<html>
<style>
input[type=text],input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.signUp {
    border-radius: 5px;
    background-color: #f2f2f2;
    //padding: 40px;
	
	float:	left;
    margin: 5px;
    padding: 20px;
    width: 300px;
    height: 360px;
    border: 1px solid black;
	
}
</style>
<body>

<h4>This page has been developed using standard CSS </h4>

<div class="signUp">
  <form method="POST" action="createUser.php">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname">
	
	<label for="email">Email Address</label>
    <input type="text" id="email" name="emailAdd">
	
	<label for="pwd">Password</label>
    <input type="password" id="pwd" name="password">
  
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
