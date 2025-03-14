<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filter Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { margin: 0; padding: 0; font-family: "Helvetica", sans-serif; }
        #filters { margin-left: 10%; margin-top: 2%; margin-bottom: 2%; }
        .table img { max-width: 100px; height: auto; }
    </style>
</head>
<body>
    <div class="container">
        <div id="filters">
            <span>Fetch results by </span>
            <select name="fetchval" id="fetchval" class="form-select d-inline-block w-auto">
                <option value="" selected>Filtrele</option>
                <option value="Teknoloji">Teknoloji</option>
                <option value="Mobilya">Mobilya</option>
                <option value="Sağlık">Sağlık</option>
                <option value="Kişisel Bakım">Kişisel Bakım</option>
            </select>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sıra No</th>
                    <th>Ürün Adı</th>
                    <th>Tarih</th>
                    <th>Post Başlığı</th>
                    <th>Post Resmi</th>
                </tr>
            </thead>
            <tbody id="postTable">
                <?php
                $query = "SELECT * FROM post";
                $r = mysqli_query($conn, $query);
                if (!$r) {
                    die("Sorgu hatası: " . mysqli_error($conn));
                }

                if (mysqli_num_rows($r) > 0) {
                    while ($row = mysqli_fetch_assoc($r)) {
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
                        <td colspan="5" class="text-center">Tabloda veri bulunamadı.</td>
                    </tr>
                    <?php
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#fetchval').on('change', function() {
                var value = $(this).val();
                $.ajax({
                    url: "fetch.php",
                    type: "POST",
                    data: 'request=' + value,
                    beforeSend: function() {
                        $("#postTable").html("<tr><td colspan='5' class='text-center'>Loading...</td></tr>");
                    },
                    success: function(data) {
                        $("#postTable").html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>