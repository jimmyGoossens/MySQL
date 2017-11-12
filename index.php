<?php
    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8','root','');
    $reponse = $bdd->query('SELECT * FROM météo');

if (isset($_GET['supprimer'])){
   
     
  foreach($_GET['case'] as $i){
       
        $supprimer = $bdd->prepare('DELETE FROM météo WHERE ID = :y');   
                        $supprimer->execute(array("y"=> $i));
 
}
}
?>
<?php 

function envoi(){
    
        $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8','root','');
        $envoi = $bdd->prepare('INSERT INTO météo(ville,haut,bas)VALUES (:nom, :haut , :bas)');
        $envoi->execute(array(
            'nom' => $_GET['nom'],
            'haut' => $_GET['haut'],
            'bas' => $_GET['bas'] 

      ));
}

if (isset($_GET["nom"])&&isset($_GET["haut"])&&isset($_GET["bas"])) {
    envoi();
}

?>
<form method="get" action="index.php">
    <table>
        <tr>
            <th>ville</th>
            <th>haut</th>
            <th>bas</th>    
        </tr>
<?php    
    while ($donnees = $reponse->fetch()){   
    
?>
    <tr>
        <td><input type="checkbox" name="case[]" value="<?php echo $donnees['ID'];?>"></td>
        <td><?php echo $donnees['ville']?></td>
        <td><?php echo $donnees['haut']?></td>
        <td><?php echo $donnees['bas']?></td>
    </tr>
<?php
     }
        
    
?>
        
    </table>
    <input type="submit" name="supprimer" value="delete">
</form>






<form method="get" action="index.php">

    <label for="nom">nom</label>
    <input type="text" name="nom">
    <label for="haut" name="haut">haut</label>
    <input type="number" name="haut">
    <label for="bas" name="bas">bas</label>
    <input type="number" name="bas">
    <input type="submit" name="envoi" value="envoyer"> 


</form>
