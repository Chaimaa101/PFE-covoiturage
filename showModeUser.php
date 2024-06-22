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
        }
        exit;
    } elseif (isset($_POST['confirm_update'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $date_naissance = $_POST['date_naissance'];
        $role = $_POST['role'];
        $adresse = $_POST['adresse'];

        $sql = "UPDATE utilisateurs SET nom = '$nom', prenom = '$prenom', email = '$email', telephone = '$telephone', date_naissance = '$date_naissance', role = '$role', adresse = '$adresse' WHERE id = '$userId'";
        if ($conn->query($sql) === TRUE) {
            echo "Informations mises à jour";
        } else {
            echo "Erreur: " . $conn->error;
        }
        exit;
    }
}
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
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    <button class="btn btn-primary" type="button" onclick="confirmAction('delete')">Supprimer Utilisateur</button>
    <button class="btn btn-primary" type="button" onclick="confirmAction('update')">Modifier les informations</button>
</form>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">Êtes-vous sûr de vouloir effectuer cette action?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="" method="POST" id="confirmForm">
                    <input type="hidden" name="confirm_delete" id="confirmDelete" value="">
                    <input type="hidden" name="confirm_update" id="confirmUpdate" value="">
                    <!-- Hidden inputs for the updated data -->
                    <input type="hidden" name="nom" id="hiddenNom" value="">
                    <input type="hidden" name="prenom" id="hiddenPrenom" value="">
                    <input type="hidden" name="email" id="hiddenEmail" value="">
                    <input type="hidden" name="telephone" id="hiddenTelephone" value="">
                    <input type="hidden" name="date_naissance" id="hiddenDateNaissance" value="">
                    <input type="hidden" name="role" id="hiddenRole" value="">
                    <input type="hidden" name="adresse" id="hiddenAdresse" value="">
                    <button class="btn btn-primary" type="submit">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function confirmAction(action) {
    let modalBody = document.getElementById('modalBody');
    let confirmDelete = document.getElementById('confirmDelete');
    let confirmUpdate = document.getElementById('confirmUpdate');

    if (action === 'delete') {
        modalBody.textContent = 'Êtes-vous sûr de vouloir supprimer cet utilisateur?';
        confirmDelete.value = 'true';
        confirmUpdate.value = '';
    } else if (action === 'update') {
        modalBody.textContent = 'Êtes-vous sûr de vouloir modifier les informations de cet utilisateur?';
        confirmDelete.value = '';
        confirmUpdate.value = 'true';

        // Set the hidden input values
        document.getElementById('hiddenNom').value = document.querySelector('input[name="nom"]').value;
        document.getElementById('hiddenPrenom').value = document.querySelector('input[name="prenom"]').value;
        document.getElementById('hiddenEmail').value = document.querySelector('input[name="email"]').value;
        document.getElementById('hiddenTelephone').value = document.querySelector('input[name="telephone"]').value;
        document.getElementById('hiddenDateNaissance').value = document.querySelector('input[name="date_naissance"]').value;
        document.getElementById('hiddenRole').value = document.querySelector('input[name="role"]').value;
        document.getElementById('hiddenAdresse').value = document.querySelector('input[name="adresse"]').value;
    }

    $('#confirmationModal').modal('show');
}
</script>
