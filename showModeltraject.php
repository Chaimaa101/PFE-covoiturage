 <table>
        <form action="" method="POST"></form>
            <?php
            require'connection.php';
            if (isset($_GET['id'])) {
            $trajetId = $_GET['id'];
            $sql = "SELECT * FROM trajets where id = '$trajetId' ";
            $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            ?>  
             <tr>
            <th>Id</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['id'];?>" name="id" readonly/></td>
            </tr>
             <tr>
            <th>Depart</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['depart'];?>" name="depart" /></td>
            </tr>
             <tr>
            <th>Destination</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['destination'];?>" name="destination"/></td>
            </tr>
            <tr>
            <th>Date de depart</th>
            <td> <input type="datetime-local" class="form-control" value="<?php echo $row['date_depart'];?>" name="date_depart"/></td>
            </tr>
            <tr>
            <th>Date d'arrivée</th>
            <td> <input type="datetime-local" class="form-control" value="<?php echo $row['date_arrivee'];?>" name="date_arrivee"/></td>
            </tr>
            <tr>
            <th>Distance</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['distance'];?>" name="distance"/></td>
            </tr>
            <tr>
            <th>Statut</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['statut'];?>" name="status"/></td>
            </tr>
             <tr>
            <th>Côut</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['prix'];?>" name="adresse"/></td>
            </tr>
            <tr>
            <th>Durée</th>
            <td> <input type="text" class="form-control" value="<?php 
                                $date_depart = new DateTime($row['date_depart']);
                                $date_arrivee = new DateTime($row['date_arrivee']);
                                $interval = $date_depart->diff($date_arrivee);
                                echo $interval->format('%d days %h hours %i minutes'); 
                            ?>" name="adresse"/></td>
            </tr>
           <?php } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
    echo "ID de l'utilisateur non fourni";
}?>
    </form>
</table>
<div style="height: 10px;"></div>
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input type="submit" class="btn btn-danger" value="supprimer">
<input type="submit"  class="btn btn-primary" value="modifier">