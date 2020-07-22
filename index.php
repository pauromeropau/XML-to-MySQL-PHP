<?php
$contact = simplexml_load_file('data.xml');
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Save XML</title>
</head>

<body>
    <h1>Save XML</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>address</th>
                <th>email</th>
                <th>phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contact as $data) {
                $count += 1;
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $data->firstname; ?></td>
                    <td><?php echo $data->lastname; ?></td>
                    <td><?php echo $data->address; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->phone; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table><br><br>
    <a href="save.php" style="background-color:black; color:white; padding: 5px; text-decoration:none"> Save</a>
</body>

</html>