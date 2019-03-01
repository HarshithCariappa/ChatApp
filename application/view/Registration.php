<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */

// These are the files required in this page.
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsBranch.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsGender.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsYear.php');

// fetch all available branches. To show in the Branch drop down.
$objMsbranch = new MsBranch();
$arrMsbranchData = $objMsbranch->fetchAllBranches();

// fetch all genders. To show in the Gender drop down.
$objMsGender = new MsGender();
$arrMsGenderData = $objMsGender->fetchAllGender();

// fetch all available year. To show in the Year drop down.
$objMsYear = new MsYear();
$arrMsYearData  = $objMsYear->fetchAllYear();

?>
<html>
    <body>
    <div>
        <h1>Register Form</h1>

        <form action="../controller/SignUpController.php" method="post" name="registerUser">
            First Name : <input type="text" name="firstName" required size="32"><br><br>
            Last Name : <input type="text" name="lastName" size="32" required><br><br>
            Email : <input type="email" name="email" id="email" size="32" required><br><br>

            Branch :
            <select name='branchId' id='branchId' style='width: 238px'>
                <?php
                    // fetch all branches by looping.
                    while ($branch = $arrMsbranchData->fetch_assoc()){
                        echo "<option value=".$branch['BranchId'].">".$branch['BranchAbbrivation']."</option>";
                    }
                ?>
            </select><br><br>

            Year :
            <select name='yearId' id='yearId' style='width: 238px'>
                <?php
                    // fetch all year by looping.
                    while ($year = $arrMsYearData->fetch_assoc()){
                        echo "<option value=".$year['YearId'].">".$year['Year']."</option>";
                    }
                ?>
            </select><br><br>

            USN : <input type="text" name="usn" id="usn" size="32" required><br><br>

            Gender :
            <select name='genderId' id='genderId' style='width: 238px'>
                <?php
                    // fetch all gender by looping.
                    while ($gender = $arrMsGenderData->fetch_assoc()){
                        echo "<option value=".$gender['GenderID'].">".$gender['Gender']."</option>";
                    }
                ?>
            </select><br><br>

            Password : <input type="password" name="password" id="password" size="32" required><br><br>
            Confirm Password : <input type="password" name="confirmPassword" id="confirmPassword" size="32" required><br><br>

            <input type="submit" value="SIGNUP" ><br><br>

            <a href="Login.php">Login</a>
        </form>
    </div>

    <script>
        var confirmPassword = document.getElementById("confirmPassword");
        var password = document.getElementById("password");

        // When the user clicks outside of the password field, hide the message box
        confirmPassword.onblur = function() {
            if(confirmPassword.value !== password.value){
                alert("Passwords are not matching")
            }
        }
    </script>
    </body>
</html>