<?php

require 'connection.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $sql = "SELECT * FROM utilisateurs WHERE id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Aucun utilisateur trouvé";
        exit;
    }
} else {
    echo "ID de l'utilisateur non fourni";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_delete'])) {
        $sql = "DELETE FROM utilisateurs WHERE id = '$userId'";
        if ($conn->query($sql) === TRUE) {
            echo "Utilisateur supprimé";
        } else {
            echo "Erreur: " . $conn->error;
        }}}
?>
<form id="userForm" action="" method="POST">
    <table>
        <tr>
            <th>Id</th>
            <td><input type="text" class="form-control" value="<?php echo $row['id']; ?>" name="id" readonly /></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><input type="text" class="form-control" value="<?php echo $row['nom']; ?>" name="nom" /></td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td><input type="text" class="form-control" value="<?php echo $row['prenom']; ?>" name="prenom" /></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="text" class="form-control" value="<?php echo $row['email']; ?>" name="email" /></td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td><input type="text" class="form-control" value="<?php echo $row['telephone']; ?>" name="telephone" /></td>
        </tr>
        <tr>
            <th>Date de naissance</th>
            <td><input type="text" class="form-control" value="<?php echo $row['date_naissance']; ?>" name="date_naissance" /></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><input type="text" class="form-control" value="<?php echo $row['role']; ?>" name="role" /></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><input type="text" class="form-control" value="<?php echo $row['adresse']; ?>" name="adresse" /></td>
        </tr>
    </table>
    <div style="height: 15px;"></div>
    <div class="modal-footer">
        <a class="btn btn-primary" onclick="updateUser(<?php echo ($row['id']); ?>)">Modifier infos</a>
        <a class="btn btn-danger" onclick="DeleteUser(<?php echo ($row['id']); ?>)">Supprimer compte</a>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    </div>
</form>

<script>
// Function to confirm deletion and then trigger AJAX call to deleteUser.php
function DeleteUser(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ?")) {
        // AJAX call to deleteUser.php
        $.ajax({
            type: "POST",
            url: "deleteUser.php",
            data: { id: userId },
            success: function(response) {
                // Handle success response if needed
                console.log(response);
                // Optionally, reload the page or handle UI update
                alert('Compte supprimé avec succès.');
                location.reload();  // Reload the page
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
}

// Function to update user info and trigger AJAX call to updateUser.php
function updateUser(userId) {
    if (confirm("Êtes-vous sûr de vouloir modifier votre compte ?")) {
        var formData = $('#userForm').serialize();  // Gather all form data

        // AJAX call to updateUser.php
        $.ajax({
            type: "POST",
            url: "updateUser.php",
            data: formData,  // Send form data
            success: function(response) {
                // Handle success response if needed
                console.log(response);
                // Optionally, reload the page or handle UI update
                alert('Informations mises à jour avec succès.');
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
