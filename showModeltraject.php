<table id="trajetTable">
    <form id="userForm" action="" method="POST"></form>
    <?php
    require 'connection.php';
    if (isset($_GET['id'])) {
        $trajetId = $_GET['id'];
        $sql = "SELECT * FROM trajets WHERE id = '$trajetId' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            ?>  
            <tr id="trajet-<?php echo $row['id']; ?>">
                <th>Id</th>
                <td><input type="text" class="form-control" value="<?php echo $row['id']; ?>" name="id" readonly /></td>
            </tr>
            <tr>
                <th>Depart</th>
                <td><input type="text" class="form-control" value="<?php echo $row['depart']; ?>" name="depart" /></td>
            </tr>
            <tr>
                <th>Destination</th>
                <td><input type="text" class="form-control" value="<?php echo $row['destination']; ?>" name="destination" /></td>
            </tr>
            <tr>
                <th>Date de depart</th>
                <td><input type="datetime-local" class="form-control" value="<?php echo $row['date_depart']; ?>" name="date_depart" /></td>
            </tr>
            <tr>
                <th>Date d'arrivée</th>
                <td><input type="datetime-local" class="form-control" value="<?php echo $row['date_arrivee']; ?>" name="date_arrivee" /></td>
            </tr>
            <tr>
                <th>Distance</th>
                <td><input type="text" class="form-control" value="<?php echo $row['distance']; ?>" name="distance" /></td>
            </tr>
            <tr>
                <th>Statut</th>
                <td><input type="text" class="form-control" value="<?php echo $row['statut']; ?>" name="status" /></td>
            </tr>
            <tr>
                <th>Coût</th>
                <td><input type="text" class="form-control" value="<?php echo $row['prix']; ?>" name="prix" /></td>
            </tr>
            <tr>
                <th>Durée</th>
                <td><input type="text" class="form-control" value="<?php 
                    $date_depart = new DateTime($row['date_depart']);
                    $date_arrivee = new DateTime($row['date_arrivee']);
                    $interval = $date_depart->diff($date_arrivee);
                    echo $interval->format('%d days %h hours %i minutes'); 
                ?>" name="duree" /></td>
            </tr>
            <?php 
        } else {
            echo "Aucun trajet trouvé";
        }
    } else {
        echo "ID du trajet non fourni";
    } ?>
    </form>
</table>
<div style="height: 10px;"></div>
<div class="modal-footer">
    <a class="btn btn-primary" onclick="updateUser(<?php echo ($row['id']); ?>)">Modifier infos</a>
    <a class="btn btn-danger" onclick="DeleteUser(<?php echo ($row['id']); ?>)">Supprimer trajet</a>
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
</div>

<script>
function DeleteUser(trajetId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce trajet ?")) {
        // AJAX call to deleteTrajet.php
        $.ajax({
            type: "POST",
            url: "deleteTrajet.php",
            data: { id: trajetId },
            success: function(response) {
                // Handle success response if needed
                console.log(response);
                // Remove the row from the table
                document.getElementById('trajet-' + trajetId).remove();
                alert('Trajet supprimé avec succès.');
                // Hide the modal
                $('#myModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
}

// Function to update user info and trigger AJAX call to updateUser.php
function updateUser(trajetId) {
    if (confirm("Êtes-vous sûr de vouloir modifier ce trajet ?")) {
        var formData = $('#userForm').serialize();  // Gather all form data

        // AJAX call to updateTrajet.php
        $.ajax({
            type: "POST",
            url: "updateTrajet.php",
            data: formData,  // Send form data
            success: function(response) {
                // Handle success response if needed
                console.log(response);
                // Optionally, reload the page or handle UI update
                alert('Trajet mis à jour avec succès.');
                location.reload();  // Reload the page
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
}
</script>