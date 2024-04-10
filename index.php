<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="seet.css">
</head>

<body>
    <h1>seet.be</h1>
    <?php

    $host = 'localhost';
    $db   = 'seetbe';
    $user = 'seetbe';
    $pass = 'Vx!~G^7ypF)P-q5e&Lt%J[';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);


    if (isset($_GET['action']) && $_GET['action'] == 'new') {
        include 'new.html';

    } elseif ($_GET['action'] == 'create') {
        // ICI INSERT SQL
        $sql = 'INSERT INTO employee (firstname, lastname, salary) VALUES (:first, :last, :salary)';
        $pdo->prepare($sql)->execute([
            'first' => $_POST['firstname'],
            'last' => $_POST['lastname'],
            'salary' => $_POST['salary']
        ]);

    }
    else if($_GET['action'] == 'edit'){
        // charger l'employe grace à son id
        $sql = 'SELECT * FROM employee WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        
        $stmt->execute(['id' => $_GET['id']]);

        $employee = $stmt->fetch();

        // afficher formulaire avec les données de l'employee
        include 'edit.php';
    }
    else if($_GET['action'] == 'update'){
        // lancer requete UPDATE avec données POST
        $sql = 'UPDATE employee 
                SET firstname=:first, lastname=:last, salary=:salary 
                WHERE id=:id';

        $pdo->prepare($sql)->execute([
            'first' => $_POST['firstname'],
            'last' => $_POST['lastname'],
            'salary' => $_POST['salary'],
            'id' => $_POST['id']
        ]);

    }

    $stmt = $pdo->query('SELECT * FROM `employee`');

    echo "<ul>";
    while ($item = $stmt->fetch()) {
        echo '<li><a href="index.php?action=edit&id='.$item['id'].'">' . $item['lastname'] . ' ' . $item['firstname'] . ": earns " . $item['salary'] . "</a></li>";
    }
    echo "</ul>";
    ?>

    <a href="index.php?action=new">Nouvel employé</a>
    <a href="index.php">Listing</a>

</body>

</html>