<?php
$host="localhost"; $username="root"; $password="";

try{
    $pdo=new PDO("mysql:host=$host;charset=utf8mb4",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS college");
    $pdo->exec("USE college");

    $pdo->exec("CREATE TABLE IF NOT EXISTS courses(
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        duration VARCHAR(50) NOT NULL,
        status VARCHAR(30) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS students(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        course_id INT NOT NULL,
        fee DECIMAL(10,2) NOT NULL,
        rollno VARCHAR(30) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address VARCHAR(200) NOT NULL,
        dob DATE NOT NULL,
        status VARCHAR(30) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY(course_id) REFERENCES courses(id)
    )");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $a=$_POST["action"]??"";

        if($a=="add_course")
            $pdo->prepare("INSERT INTO courses(title,duration,status) VALUES(?,?,?)")
                ->execute([$_POST["title"],$_POST["duration"],$_POST["status"]]);

        elseif($a=="update_course")
            $pdo->prepare("UPDATE courses SET title=?,duration=?,status=? WHERE id=?")
                ->execute([$_POST["title"],$_POST["duration"],$_POST["status"],$_POST["id"]]);

        elseif($a=="delete_course")
            $pdo->prepare("DELETE FROM courses WHERE id=?")
                ->execute([$_POST["id"]]);

        elseif($a=="add_student")
            $pdo->prepare("INSERT INTO students(name,course_id,fee,rollno,phone,address,dob,status) VALUES(?,?,?,?,?,?,?,?)")
                ->execute([$_POST["name"],$_POST["course_id"],$_POST["fee"],$_POST["rollno"],$_POST["phone"],$_POST["address"],$_POST["dob"],$_POST["status"]]);

        elseif($a=="update_student")
            $pdo->prepare("UPDATE students SET name=?,course_id=?,fee=?,rollno=?,phone=?,address=?,dob=?,status=? WHERE id=?")
                ->execute([$_POST["name"],$_POST["course_id"],$_POST["fee"],$_POST["rollno"],$_POST["phone"],$_POST["address"],$_POST["dob"],$_POST["status"],$_POST["id"]]);

        elseif($a=="delete_student")
            $pdo->prepare("DELETE FROM students WHERE id=?")
                ->execute([$_POST["id"]]);
    }

    $courses=$pdo->query("SELECT * FROM courses ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

    $students=$pdo->query("
        SELECT s.*,c.title AS course_title
        FROM students s JOIN courses c ON s.course_id=c.id
        ORDER BY s.id DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("Database Error: ".$e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
<title>College Management System</title>
<style>
table{width:60%}
th,td{padding:2px 3px;font-size:8px}
</style>
</head>

<body>

<h2>Courses CRUD</h2>

<form method="post">
<input type="hidden" name="action" value="add_course">
Title:<input type="text" name="title" required>
Duration:<input type="text" name="duration" required>
Status:<input type="text" name="status" required>
<button>Add Course</button>
</form>

<table>
<tr>
<th>ID</th><th>Title</th><th>Duration</th><th>Status</th><th>Action</th>
</tr>

<?php foreach($courses as $c): ?>
<tr>
<td><?=$c["id"]?></td>
<td><?=htmlspecialchars($c["title"])?></td>
<td><?=htmlspecialchars($c["duration"])?></td>
<td><?=htmlspecialchars($c["status"])?></td>
<td>

<form method="post">
<input type="hidden" name="action" value="update_course">
<input type="hidden" name="id" value="<?=$c["id"]?>">
<input type="text" name="title" value="<?=htmlspecialchars($c["title"])?>" required>
<input type="text" name="duration" value="<?=htmlspecialchars($c["duration"])?>" required>
<input type="text" name="status" value="<?=htmlspecialchars($c["status"])?>" required>
<button>Update</button>
</form>

<form method="post">
<input type="hidden" name="action" value="delete_course">
<input type="hidden" name="id" value="<?=$c["id"]?>">
<button>Delete</button>
</form>

</td>
</tr>
<?php endforeach; ?>
</table>

<h2>Students CRUD</h2>

<form method="post">
<input type="hidden" name="action" value="add_student">

Name:<input type="text" name="name" required>

Course:
<select name="course_id" required>
<option value="">Select Course</option>
<?php foreach($courses as $c): ?>
<option value="<?=$c["id"]?>"><?=htmlspecialchars($c["title"])?></option>
<?php endforeach; ?>
</select>

Fee:<input type="number" step="1.00" name="fee" required>
Roll No:<input type="text" name="rollno" required>
Phone:<input type="text" name="phone" required>
Address:<input type="text" name="address" required>
DOB:<input type="date" name="dob" required>
Status:<input type="text" name="status" required>

<button>Add Student</button>
</form>

<table>
<tr>
<th>ID</th><th>Name</th><th>Course</th><th>Fee</th><th>Roll No</th>
<th>Phone</th><th>Address</th><th>DOB</th><th>Status</th><th>Action</th>
</tr>

<?php foreach($students as $s): ?>
<tr>
<td><?=$s["id"]?></td>
<td><?=htmlspecialchars($s["name"])?></td>
<td><?=htmlspecialchars($s["course_title"])?></td>
<td><?=htmlspecialchars($s["fee"])?></td>
<td><?=htmlspecialchars($s["rollno"])?></td>
<td><?=htmlspecialchars($s["phone"])?></td>
<td><?=htmlspecialchars($s["address"])?></td>
<td><?=htmlspecialchars($s["dob"])?></td>
<td><?=htmlspecialchars($s["status"])?></td>

<td>

<form method="post">
<input type="hidden" name="action" value="update_student">
<input type="hidden" name="id" value="<?=$s["id"]?>">

<input type="text" name="name" value="<?=htmlspecialchars($s["name"])?>" required>

<select name="course_id" required>
<?php foreach($courses as $c): ?>
<option value="<?=$c["id"]?>" <?=$c["id"]==$s["course_id"]?"selected":""?>>
<?=htmlspecialchars($c["title"])?>
</option>
<?php endforeach; ?>
</select>

<input type="number" step="1.00" name="fee" value="<?=$s["fee"]?>" required>
<input type="text" name="rollno" value="<?=htmlspecialchars($s["rollno"])?>" required>
<input type="text" name="phone" value="<?=htmlspecialchars($s["phone"])?>" required>
<input type="text" name="address" value="<?=htmlspecialchars($s["address"])?>" required>
<input type="date" name="dob" value="<?=$s["dob"]?>" required>
<input type="text" name="status" value="<?=htmlspecialchars($s["status"])?>" required>

<button>Update</button>
</form>

<form method="post">
<input type="hidden" name="action" value="delete_student">
<input type="hidden" name="id" value="<?=$s["id"]?>">
<button>Delete</button>
</form>

</td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>