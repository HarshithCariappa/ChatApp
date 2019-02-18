<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsBranch.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsYear.php');

// fetch all available branches.
$objMsbranch = new MsBranch();
$arrMsbranchData = $objMsbranch->fetchAllBranches();

// fetch all available year.
$objMsYear = new MsYear();
$arrMsYearData  = $objMsYear->fetchAllYear();

?>

<html>
    <body>
        <div>
            <h1>Contacts</h1>
            <button onclick="location.href='Chats.php'">Chats</button><br><br>

            <form action="../controller/ContactsController.php" method="post" name="contacts">
                Branch :
                <select name='branchId' id='branchId' style='width: 238px'>
                    <?php
                    while ($branch = $arrMsbranchData->fetch_assoc()){
                        echo "<option value=".$branch['BranchId'].">".$branch['BranchAbbrivation']."</option>";
                    }
                    ?>
                </select>

                Year :
                <select name='yearId' id='yearId' style='width: 238px'>
                    <?php
                    while ($year = $arrMsYearData->fetch_assoc()){
                        echo "<option value=".$year['YearId'].">".$year['Year']."</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="SUBMIT" ><br><br>
            </form>
        </div>
    </body>
</html>
