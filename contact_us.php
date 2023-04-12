<html>
<?php include('header.php') ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text],input[type=tel],input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit]{
  background-color: lightblue;
  color: black;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=reset]{
  background-color: lightblue;
  color: black;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: white;
}

input[type=reset]:hover {
  background-color: white;
}
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
    .our-location-div{
        position: relative;
        margin: 0 auto;
        width: 925px;
        height: 500px;
        
    }
    .our-location-label{
        font-size: 24px;
        font-style: italic;
        text-decoration: underline; 
    }
    .google-map-location{
        width: 450px;
        height: 250px;
    }
    .info-location{
        font-size: 20px;
    }
    .info-location span{
        font-weight: 700;
    }
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  <form>
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your first name" required>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Your email address" required>
    
    <label for="phone">Phone Number</label>
    <input type="tel" id="phone" name="phone" placeholder="054 000 0000" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>

    <label for="gender">Gender</label>
    <select id="gender" name="gender">
        <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="I do not wish to disclose">I do not wish to disclose</option>
    </select>

    
    <label for="Message">Message</label>
    <textarea id="Message" name="Message" placeholder="Write something.." style="height:100px" required></textarea>

    <input type="submit" value="Submit" onclick="alert('Sent successfully, thank you for contacting us')">
    <input type="reset" value="Reset">
  </form>
</div>
<div class="our-location-div">
<label class="our-location-label">Address and location</label>    
<p class="info-location"><span>Adress :</span> College of Computer Science and Information Technology </p>    
<p class="info-location"><span>Building :</span> A11</p>
<p class="info-location"><span>Phone :</span> 9874236</p>
    
<!--ADDING LOCATION-->
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7147.778459658816!2d50.1968984!3d26.3947661!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49ef811304efab%3A0xe664343a49ebbf2b!2sCollege%20of%20Computer%20Science%20and%20Information%20Technology!5e0!3m2!1sen!2ssa!4v1675871155154!5m2!1sen!2ssa" class="google-map-location"></iframe>
</div>
<footer>
    
<?php include('footer.php'); ?>    
</footer>
</body>
</html>