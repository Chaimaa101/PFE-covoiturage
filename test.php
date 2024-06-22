<?php
include 'connection.php';

// Supprimer un utilisateur
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = $id");
    $stmt->execute();
}

// Modifier un utilisateur
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("UPDATE utilisateurs SET name = $name, email = $email WHERE id = $id");
    $stmt->execute();
}

// Récupérer les utilisateurs
$stmt = $conn->prepare("SELECT * FROM utilisateurs");
$stmt->execute();
$users = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestion des Utilisateurs</h1>
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                        <button type="button" onclick="document.getElementById('editModal-<?php echo $user['id']; ?>').style.display='block'">Modifier</button>
                    </td>
                </tr>

                <!-- Modale de modification -->
                <div id="editModal-<?php echo $user['id']; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="document.getElementById('editModal-<?php echo $user['id']; ?>').style.display='none'">&times;</span>
                        <form method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $user['id']; ?>">
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                            <button type="submit">Modifier</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
