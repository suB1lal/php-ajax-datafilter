<?php
include 'config.php';

$query = "SELECT DISTINCT p_title, p_no, p_username, p_tmg, p_img FROM post"; // Varsayılan sorgu: Tüm kayıtlar
$request = "";

if (isset($_POST['request']) && !empty($_POST['request'])) {
    $request = mysqli_real_escape_string($conn, $_POST['request']);
    $query = "SELECT DISTINCT p_title, p_no, p_username, p_tmg, p_img FROM post WHERE p_title = '$request'";
}

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Sorgu hatası: " . mysqli_error($conn));
}

$count = mysqli_num_rows($result);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr data-category="<?= htmlspecialchars($row['p_title']) ?>">
            <td><?= htmlspecialchars($row['p_no']) ?></td>
            <td><?= htmlspecialchars($row['p_username']) ?></td>
            <td><?= htmlspecialchars($row['p_tmg']) ?></td>
            <td><?= htmlspecialchars($row['p_title']) ?></td>
            <td><img src="upload/<?= htmlspecialchars($row['p_img']) ?>" alt="Post Image" class="img-thumbnail" width="150"></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="5" class="text-center">Sorry, no record found!</td>
    </tr>
    <?php
}

mysqli_close($conn);
?>