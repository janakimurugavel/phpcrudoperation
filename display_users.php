<?php
include 'db_connection.php';
include 'delete.php';

// Define the number of records to display per page
$recordsPerPage = 10;

// Determine the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting record for the current page
$startFrom = ($page - 1) * $recordsPerPage;

// Fetch user data from the database for the current page
$sql = "SELECT * FROM user LIMIT $startFrom, $recordsPerPage";
$result = $conn->query($sql);

// Fetch total number of records for pagination
$totalRecords = $conn->query("SELECT COUNT(*) as total FROM user")->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Display</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: #ddd;
            text-decoration: none;
            color: black;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .delete-btn {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    border-radius: 5px;
    cursor: pointer;
}

.edit-btn,
    .delete-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px; /* Add margin between buttons */
    }

    .delete-btn {
        background-color: #e01806;
    }

    </style>
</head>
<body>
    <h2>User Data Display</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Place</th>
                <th>District</th>
                <th>State</th>
                <th colspan="2">Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['place']; ?></td>
                    <td><?php echo $row['district']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a> </td>
            <td><form method="post" action="">
                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="delete-btn">Delete</button></td>
            </form>
                   
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Pagination links -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>No user data available.</p>
    <?php endif; ?>


</body>
</html>
