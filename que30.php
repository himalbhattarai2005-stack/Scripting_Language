<?php
$host = "localhost";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS php_lab");
    $pdo->exec("USE php_lab");

    $pdo->exec("CREATE TABLE IF NOT EXISTS records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        `rank` VARCHAR(50) NOT NULL,
        status VARCHAR(30) NOT NULL,
        image VARCHAR(255),
        created_by VARCHAR(100) NOT NULL,
        updated_by VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
    )");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST["action"];

        if ($action == "add") {
            $stmt = $pdo->prepare("INSERT INTO records
                (name, `rank`, status, image, created_by)
                VALUES (?, ?, ?, ?, ?)");

            $stmt->execute([
                $_POST["name"],
                $_POST["rank"],
                $_POST["status"],
                $_POST["image"],
                "admin"
            ]);
        }

        if ($action == "update") {
            $stmt = $pdo->prepare("UPDATE records SET
                name=?, `rank`=?, status=?, image=?, updated_by=?
                WHERE id=?");

            $stmt->execute([
                $_POST["name"],
                $_POST["rank"],
                $_POST["status"],
                $_POST["image"],
                "admin",
                $_POST["id"]
            ]);
        }

        if ($action == "delete") {
            $stmt = $pdo->prepare("DELETE FROM records WHERE id=?");
            $stmt->execute([$_POST["id"]]);
        }
    }

    $records = $pdo->query("SELECT * FROM records ORDER BY id DESC")
                   ->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Records CRUD</title>

    <style>
       table {
    border-collapse: collapse;
    width: 65%;
}

th, td {
    padding: 2px 4px;
    font-size: 10px;
}
    </style>
</head>

<body>

<h2>Records CRUD</h2>

<form method="post">
    <input type="hidden" name="action" value="add">

    Name:
    <input type="text" name="name" required>

    Rank:
    <input type="text" name="rank" required>

    Status:
    <input type="text" name="status" required>

    Image:
    <input type="text" name="image">

    <button>Add</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Rank</th>
    <th>Status</th>
    <th>Image</th>
    <th>Created By</th>
    <th>Updated By</th>
    <th>Created At</th>
    <th>Updated At</th>
    <th>Action</th>
</tr>

<?php foreach ($records as $r): ?>
<tr>
    <form method="post">
        <td>
            <?= $r["id"] ?>
            <input type="hidden" name="id" value="<?= $r["id"] ?>">
        </td>

        <td>
            <input type="text" name="name"
                   value="<?= htmlspecialchars($r["name"]) ?>">
        </td>

        <td>
            <input type="text" name="rank"
                   value="<?= htmlspecialchars($r["rank"]) ?>">
        </td>

        <td>
            <input type="text" name="status"
                   value="<?= htmlspecialchars($r["status"]) ?>">
        </td>

        <td>
            <input type="text" name="image"
                   value="<?= htmlspecialchars($r["image"]) ?>">
        </td>

        <td><?= htmlspecialchars($r["created_by"]) ?></td>
        <td><?= htmlspecialchars($r["updated_by"] ?? "") ?></td>
        <td><?= $r["created_at"] ?></td>
        <td><?= $r["updated_at"] ?></td>

        <td>
            <button name="action" value="update">Update</button>
            <button name="action" value="delete"
                    onclick="return confirm('Delete this record?')">
                Delete
            </button>
        </td>
    </form>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>