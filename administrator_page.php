<?php include('connect_to_our_database.php'); ?>
<?php include('authorized_validate.php'); ?>
                
<?php
?>
<html>
<head>
<title>Adminsitrator page</title>    
<style>
    body{
        background-color: #E1FFFF;
        background-image: url(medicine.png);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    
</style>
<link rel="stylesheet" href="styles.css">
    <?php include('header.php'); ?>
<!--Admin css starts at line 282 in styles.css-->
</head>
<body>
<!--ADDING SPECIAL HEADER FOR ADMIN-->
<!--A DIV JUST FOR WELCOMING-->
<div class="welcome-class">
<h1>Welcome to Administrator page ...</h1>
</div>
<div class="tabs-container">
    <div class="buttons-container">
    <button class="all-buttons-style" onclick="openpage('add',this,'#dae3f1')">Add</button>
    <button class="all-buttons-style" onclick="openpage('update',this,'#dae3f1')">Update</button>
    <button class="all-buttons-style" onclick="openpage('delete',this,'#dae3f1')">Delete</button>
    </div>
    <!--ADD DIV-->
    <div id="add" class="tab-panel">
        <div class="inside-add-div">
        <form id="form" action="addProduct_validate.php" method="post" name = "myForm" onsubmit = "return validateForm()" enctype="multipart/form-data">
        <label>Product Name :</label>    
            <input id ="product-name-input-style" type="text" name="product_name" required>
        <label id="company-name-label-style">Company Name :</label>
            <input id="company-name-input-style" type="text" name="company_name" required>
            <label id="catagory-label-style">Catagory :</label>
        <select id="catagory-input-style" name="category">
        <option>Vitamins</option>
        <option>daily-essentials</option>
        <option>medications</option>
        </select>
        <label id="barcode-label-style">Barcode :</label>
            <input id="barcode-input-style" type="text" placeholder="ex..1001" name="barcode" required>
        <label id="selling-label-style">Selling Price :</label>
            <input id="selling-input-style" type="text" placeholder="..SAR" name="price" required>
        <label id="production-label-style">Production Date :</label>
            <input id="production-input-style" type="date" name="pro_date" required>
        <label id="expiration-label-style">Expiration Date :</label>
            <input id="expiration-input-style" type="date" name="ex_date" required>
        <label id="quantity-label-style">Quantity :</label>
            <input id="quantity-input-style" type="number" name="quantity" required>
        <label id="description-label-style">Brief Description :</label>
        <textarea id="description-input-style" name="desc"></textarea>
            <input type="file" id="myFile" name="filename" accept=".jpg , .jpeg , .png" required>
            <input id="submit-button-style"type="submit">
            <input id="reset-button-style" type="reset">
        </form>
        <?php
            if(isset($_GET["error"]))
            {
                if ($_GET["error"] == "none")
                {
                    //echo "<p>Item has been added Sucessfully!</p>";
                    echo "<script>";
                    echo "window.alert('product added successfully')";
                    echo "</script>";
                }
            }
        ?>
            
        <script>
            
            
            function validateForm() 
            {
                // company name validation:
                let companyNameValidation = document.forms["myForm"]["company-name-input-style"].value;
                let barcodeValidation = document.forms["myForm"]["barcode-inpuy-style"].value;
                let x = document.forms["myForm"]["company-name-input-style"].value;
                let x = document.forms["myForm"]["company-name-input-style"].value;
                let x = document.forms["myForm"]["company-name-input-style"].value;
                let x = document.forms["myForm"]["company-name-input-style"].value;
                let x = document.forms["myForm"]["company-name-input-style"].value;
                let x = document.forms["myForm"]["company-name-input-style"].value;
                if (companyNameValidation == "Oral-B" || "Panadol" || "Redoxon" || "Sensodyne" | "Pfizer") 
                    {
                        return true;
                    }
                else
                {
                    alert("Choose correct company name!");
                    return false;
                }
                
                // barcode validation
                if(isNaN(barcodeValidation))
                {
                    alert("Enter numbers only for barcode!");
                    return false;
                }
                else
                {
                    return true;
                }
                
                
                
                
            }
        </script>
        
        </div>
    </div>
    <!--UPDATE DIV-->
    <div id="update" class="tab-panel">
        
        
        <div class="inside-add-div">
        <label id="SelectProductLabel"><p>Select product name to show its data:</p></label>
        <br>
        <table id="table" border='1'>
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>company_name</th>
                    <th>category</th>
                    <th>BARCODE</th>
                    <th>Product_ID</th>
                    <th>SELLING_PRICE</th>
                    <th>PRODUCTION_DATE</th>
                    <th>EXPIRATION_DATE</th>
                    <th>QUANTITY</th>
                    <th>real_img</th>
                    <th>description</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                
                $sql = "SELECT * FROM products";
                $result = $connection->query($sql);
                
                if(!$result)
                {
                    die("invalid query: " .$connection->error);
                }
                
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td>". $row["NAME"] ."</td>
                            <td>". $row["company_name"] ."</td>
                            <td>". $row["category"] ."</td>
                            <td>". $row["BARCODE"] ."</td>
                            <td>". $row["Product_ID"] ."</td>
                            <td>". $row["SELLING_PRICE"] ."</td>
                            <td>". $row["PRODUCTION_DATE"] ."</td>
                            <td>". $row["EXPIRATION_DATE"] ."</td>
                            <td>". $row["QUANTITY"] ."</td>
                            <td><img src='data:image;base64, ". base64_encode($row['real_img']) ."' width='85'> </td>
                            <td>". $row["description"] ."</td>
                        </tr>";
                }
                
                ?>
            </tbody>
        
        </table>
        <form action="updateProduct_validate.php" method="post" enctype="multipart/form-data">
		<div class="product-design">
			<div class="Product_Name">
            <label>Product Name :</label>    
                <input id = "product-name-input-style-update" type="text" name="product_name">
			</div>	
			
			
			<div class="company_name">
            <label id="company-name-label-style-update">Company Name :</label>
                <input id="company-name-input-style-update" type="text" name="company_name">
			</div>	
			<div class="category">
            <label id="catagory-label-style-update">Catagory :</label>
                <select id="catagory-input-style-update" name="category">
                    <option>Vitamins</option>
                    <option>daily-essentials</option>
                    <option>medications</option>
            </select>
			</div>
			
			<div class="barcodedi">
            <label id="barcode-label-style-update">Barcode :</label>
                <input id="barcode-input-style-update" type="text" name="barcode" readonly>
			</div>
            <div class="product_ID">
            <label id="product_ID-style-update">Product_ID :</label>
                <input id="selling-product_ID-update" type="text"  name="ID" readonly>
            </div>
			<div class="selling_price">
            <label id="selling-label-style-update">Selling Price :</label>
                <input id="selling-input-style-update" type="text" name="price">
			</div>
			<div class="production_date">
            <label id="production-label-style-update">Production Date :</label>
                <input id="production-input-style-update" type="date" name="pro_date">
			</div>
			
			<div class="exipration_date">
            <label id="expiration-label-style-update">Expiration Date :</label>
                <input id="expiration-input-style-update" type="date" name="ex_date">
			</div>
			
			<div class="quantityy">
            <label id="quantity-label-style-update">Quantity :</label>
                <input id="quantity-input-style-update" type="number" name="quantity">
			</div>
				
			<div class="brief_description">
			<p>Brief Description :</p>
            <label id="description-label-style-update"></label>
                <textarea id="description-input-style-update" name="desc"></textarea>
			</div>
			
			<div class="upload_button">
            <input type="file" id="myFile-update" name="filename" accept=".jpg , .jpeg , .png" required>
			</div>
			<div class="submit_button">
                <input id="submit-button-style-update"type="submit" value="Edit" name="update">
			</div>
			<div class="reset_button">
                <input id="reset-button-style-update" type="reset">
			</div>
		</div>
        </form>

            
        <script>
            var table = document.getElementById("table");
            var rIndex;
            for(var i = 0; i < table.rows.length; i++)
                {
                    // show data on text field
                    table.rows[i].onclick = function()
                    {
                        document.getElementById("product-name-input-style-update").value = this.cells[0].innerHTML;
                        document.getElementById("company-name-input-style-update").value = this.cells[1].innerHTML;
                        document.getElementById("catagory-input-style-update").value = this.cells[2].innerHTML;
                        document.getElementById("barcode-input-style-update").value = this.cells[3].innerHTML;
                        document.getElementById("selling-product_ID-update").value = this.cells[4].innerHTML;
                        document.getElementById("selling-input-style-update").value = this.cells[5].innerHTML;
                        document.getElementById("production-input-style-update").value = this.cells[6].innerHTML;
                        document.getElementById("expiration-input-style-update").value = this.cells[7].innerHTML;
                        document.getElementById("quantity-input-style-update").value = this.cells[8].innerHTML;
                        document.getElementById("description-input-style-update").value = this.cells[10].innerHTML;
                        document.getElementById("myFile-update").value = this.cells[9].innerHTML;
                    };
                }
            
            // update button
            function editHtmlTableSelectedRow()
            {
                var productName = document.getElementById("product-name-input-style-update").value;
                var companyName = document.getElementById("company-name-input-style-update").value;
                var catagory = document.getElementById("catagory-input-style-update").value; 
                var barcode = document.getElementById("barcode-input-style-update").value;
                var sellingPrice = document.getElementById("selling-input-style-update").value;
                var pDate = document.getElementById("production-input-style-update").value;
                var eDate = document.getElementById("expiration-input-style-update").value;
                var quantity = document.getElementById("quantity-input-style-update").value;
                var description = document.getElementById("description-input-style-update").value;
                var myFile = document.getElementById("myFile-update").value;
                
                table.rows[rIndex].cells[0].innerHTML = productName;
                table.rows[rIndex].cells[1].innerHTML = companyName;
                table.rows[rIndex].cells[2].innerHTML = catagory;
                table.rows[rIndex].cells[3].innerHTML = barcode;
                table.rows[rIndex].cells[5].innerHTML = sellingPrice;
                table.rows[rIndex].cells[6].innerHTML = pDate;
                table.rows[rIndex].cells[7].innerHTML = eDate;
                table.rows[rIndex].cells[8].innerHTML = quantity;
                table.rows[rIndex].cells[9].innerHTML = myFile;
                table.rows[rIndex].cells[10].innerHTML = description;
                
            }
        </script>
            
        
        </div>
    </div>
    <!--DELETE DIV-->
<?php
if (isset($_POST['delete_product'])) {
    $name_or_id = $_POST['name_or_id'];

    $check_query = "";
    if (is_numeric($name_or_id)) {
        $check_query = "SELECT * FROM products WHERE Product_ID='$name_or_id'";
    } else {
        $check_query = "SELECT * FROM products WHERE NAME='$name_or_id'";
    }

    $check_result = mysqli_query($connection, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $delete_query = "";
        if (is_numeric($name_or_id)) {
            $delete_query = "DELETE FROM products WHERE Product_ID='$name_or_id'";
        } else {
            $delete_query = "DELETE FROM products WHERE NAME='$name_or_id'";
        }

        $delete_result = mysqli_query($connection, $delete_query);
        if ($delete_result) {
            echo "<script>
                    function myFunction() 
                    {
                    alert('Item has been deleted successfully!');
                    }
                    myFunction();
                </script>";
        } else {
            echo "Error deleting record: " . mysqli_error($connection);
        }
    } else {
        echo "<script>
                function myFunction() 
                {
                alert('Item does not exist in the database!');
                }
                myFunction();
            </script>";
    }
}
?>

<div id="delete" class="tab-panel">
    <div class="inside-add-div">
        <form action="" method="post">
            <label id="deleteProductLabelStyle">Please enter product name or ID to delete:</label>
            <input id="deleteProductInputStyle" type="text" name="name_or_id" placeholder="Enter product name or ID">
            <button id="deleteProductButtonStyle" type="submit" name="delete_product">Delete</button>
        </form>
    </div>
</div>
    
<script>
    // add, delete, and update buttons popup
function openpage(pageName,elmnt,color){
    var i , tabcontent , tablinks;
    //REMOVE COLOR OF ALL PANELS
    tabcontent=document.getElementsByClassName("tab-panel");
    for(i=0;i<tabcontent.length;i++){
        tabcontent[i].style.backgroundColor="";
        //HIDE ALL PANELS
        tabcontent[i].style.display="none";
    }
    //REMOVE COLOR OF ALL BUTTONS
    tablinks=document.getElementsByClassName("all-buttons-style");
    for(i=0;i<tablinks.length;i++){
        tablinks[i].style.backgroundColor="";
    }
    
    document.getElementById(pageName).style.display="block";
    
    elmnt.style.backgroundColor=color;
    
}    
    
    
</script>

</body>
</html>