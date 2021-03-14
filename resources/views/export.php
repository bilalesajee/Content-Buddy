<!DOCTYPE html>
<html lang="en">
    <?php include 'frontend/includes/head.php'; ?>
<body>
 <table>
    <thead>
    <tr>
        <th><strong>Title</strong></th>
        <th>Body</th>
    </tr>
    </thead>
    <tbody style="background-color: red;">
    <?php foreach($posts as $post) : ?>
        <tr>
            <td><?=$post->id;?></td>
            <td><?=$post->email;?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table> 
</body>
</html>
