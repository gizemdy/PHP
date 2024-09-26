<?php
include 'db_connect.php';

$limit=4;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page-1) * $limit;

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']): '';

$search_sql = $search ? "WHERE username LIKE '%$search%' OR email LIKE '%$search%'" : '';

$total_sql = "SELECT COUNT(*) FROM users $search_sql";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_array()[0];
$total_pages = ceil($total_rows / $limit);

$sql = "SELECT id, username, email, age FROM users $search_sql LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kullanıcı Yönetimi</title>
    </head>
    <body>
        <h1>Kullanıcı Listesi</h1>
        <form action="list_users.php" method="get">
            <input type="text" name="search" placeholder="Kullanıcı adı veya e-posta ara..." value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Ara">
        </form>
    <?php
    if($result->num_rows > 0){
        echo "<table>";
        echo "<tr><th>ID</th><th>Kullanıcı Adı</th><th>E-Mail</th><th>Yaş</th><th>İşlemler</th>";

        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"]."</td>";
            echo "<td>" . $row["email"]."</td>";
            echo "<td>" . $row["age"]."</td>";
            echo "<td> <a href='user_details.php?id=" . $row["id"] . "'>Detay</a> | <td><a href='update_user.php?id=" . $row["id"]."'>Güncelle</a> | <a href='delete.user.php?id=" . $row["id"] . "'>SİL</a></td>";
            echo  "</tr>";
        }
        echo "</table>";

        for ($i = 1; $i <= $total_pages; $i++){
            echo "<a href='list_users.php?page=$i&search=$search'>$i</a>";
        }
    }else{
        echo "Kayıt bulunamadı.";
    }

    $conn -> close();

?>
<a href="index.php"><br>Anasayfa</a>
</body>
</html>
