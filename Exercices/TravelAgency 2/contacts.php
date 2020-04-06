<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <style>
        table {
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            border: 1px solid;
        }
        table tr th {
            padding: 5px 8px;
            background-color: rgb(192, 245, 122); 
        }

        table tr td {
            padding: 5px 8px;
            background-color: antiquewhite ;
        }
        h3{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px;

        }
        a{
            margin: auto;
            width: 100px;
            height: 20px;
            padding: 10px;
            background-color: rgb(100, 100, 247);
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php 
    try
    {
       $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', ''); 
    }
    catch(Exception $e)
    {
        die('Erreur : '. $e->getMessage());
    }

    $repons = $bdd->query('SELECT * FROM contact');
    ?>
    <h3>Liste des personnes à contqcter</h3>

    <table >
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date de demande</th>
            <th>Contacté</th>
            <th>Date de contact</th>
        </tr>
        <?php while($donn=$repons->fetch()) {?>
        <tr>
            <td><?= $donn['name'] ?></td>
            <td><?= $donn['email'] ?></td>
            <td><?= $donn['requestdate'] ?></td>
            <td><?php if($donn['iscontacted']==false) echo "None"; else echo "Oui"; ?></td>
            <td><?= $donn['contactdate'] ?></td>
        </tr>
        <?php } ?>
        
    </table>
    <div style="text-align: center; margin-top:20px;"><a href="index.php">Page d'accueil</a></div>
</body>
</html>