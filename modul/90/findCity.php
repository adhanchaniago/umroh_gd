
<?php 
 $countryId=$_GET['country'];
 $stateId=$_GET['state'];
?>

<html> 
<form method="POST" action = "../modul/90/competition.php">
    <input name ="Hotel" value ="<?php echo $stateId ?>" hidden>
    <input type = "submit" id ="submit" hidden>
</form>
    <script>
    function(){
        submit.getElementById.click();
    }
    </script>
</html>


