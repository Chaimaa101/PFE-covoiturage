 <form action="" method="POST">
 <table>
    <?php
        require'connection.php';
            if (isset($_GET['id'])) {
            $userId = $_GET['id'];
            $sql = "SELECT * FROM utilisateurs where id = '$userId' ";
            $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            ?>  
             <tr>
            <th>Id</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['id'];?>" name="id" readonly/></td>
            </tr>
             <tr>
            <th>Nom</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['nom'];?>" name="nom" /></td>
            </tr>
             <tr>
            <th>Prenom</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['prenom'];?>" name="prenom"/></td>
            </tr>
            <tr>
            <th>Email</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['email'];?>" name="email"/></td>
            </tr>
            <tr>
            <th>Téléphone</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['telephone'];?>" name="telephone"/></td>
            </tr>
            <tr>
            <th>Date de naissance</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['date_naissance'];?>" name="date_naissance"/></td>
            </tr>
            <tr>
            <th>Role</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['role'];?>" name="role"/></td>
            </tr>
             <tr>
            <th>Adresse</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['adresse'];?>" name="adresse"/></td>
            </tr>
           <?php } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
    echo "ID de l'utilisateur non fourni";
}?>
   
</table>
<div style="height: 15px;"></div>
<button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#changeModal" name="supprimer" >Supprimer Utilisateur</button>
<button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#changeModal" name="modifier">Modifier les informations</button>

 </form>
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?php if(isset($_POST['submit'])=='supprimer'){?>
                <div class="modal-body">Vous-voulez vraiment supprimer cet utilisateur?</div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-secondary" type="submit" name="delete">Supprimer</button>
                    </form>
                </div>
                <?php }else if(isset($_POST['submit'])=='modifier'){?>
                    <div class="modal-body">Vous-voulez vraiment modifier les informations de <?php echo $row['nom'];?>?</div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-secondary" type="submit" name="update">Modifier</button>
                    </form>
                </div>
                <?php }?>
            </div>
        </div>
    </div>

   <?php 
if(isset($_POST['submit'])=='delete'){
  if (isset($_GET['id'])) {
     $sql = "DELETE FROM utilisateurs where id = '$userId' ";
     $result = $conn->query($sql);
}
} 
   
if(isset($_POST['submit'])=='update'){
  if (isset($_GET['id'])) {
     $sql = "UPDATE utilisateurs SET where id = '$userId' ";
     $result = $conn->query($sql);
}
} 
   ?>