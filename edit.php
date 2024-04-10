<form action="index.php?action=update" method="POST">
    
    <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">

    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" value="<?php echo $employee['firstname']; ?>">

    <label for="lastname">Nom</label>
    <input type="text" name="lastname" value="<?php echo $employee['lastname']; ?>">

    <label for="salary">Salaire</label>
    <input type="text" name="salary" value="<?php echo $employee['salary']; ?>">

    <input type="submit" value="Modifier">

</form>