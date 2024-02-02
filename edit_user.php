<?php
include 'db_connection.php';

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = (int)$_GET['id'];

    // Fetch user data from the database based on the ID
    $sql = "SELECT * FROM user WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

// Handle form submission for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPlace = $_POST['new_place'];
    $newDistrict = $_POST['new_district'];
    $newState = $_POST['new_state'];

    // Perform any additional validation or processing here

    // Update user data in the database
    $updateSql = "UPDATE user SET username = '$newUsername', email = '$newEmail', place = '$newPlace', district = '$newDistrict', state = '$newState' WHERE id = $userId";

    if ($conn->query($updateSql) === TRUE) {
        echo "User data updated successfully!";
    } else {
        echo "Error updating user data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="new_username">New Username:</label>
                <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="form-group">
                <label for="new_email">New Email:</label>
                <input type="text" class="form-control" id="new_email" name="new_email" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="new_place">New Place:</label>
                <input type="text" class="form-control" id="new_place" name="new_place" value="<?php echo $user['place']; ?>" required>
            </div>

            <div class="form-group">
                <label for="new_district">New District:</label>
                <input type="text" class="form-control" id="new_district" name="new_district" value="<?php echo $user['district']; ?>" required>
            </div>

            <div class="form-group">
                <label for="new_state">New State:</label>
                <input type="text" class="form-control" id="new_state" name="new_state" value="<?php echo $user['state']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
