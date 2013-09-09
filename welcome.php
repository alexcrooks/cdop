<?php require('include/config.php'); ?>
<?php require('include/header.php'); ?>
<?php
$query = $mysqli->prepare('SELECT `id`, `date`, `value` FROM `data` ORDER BY `date` DESC;');
$query->execute();
$query->bind_result($id, $date, $data);
?>
    <div class="viewPageNoPrint">
        <h1>Classroom Observation Protocol for Undergraduate STEM - COPUS</h1>
        <div class="viewPageLane"><img src="img/add.png" /> <a href="new-session.php">New Session</a></div>
        <br>
        <table>
            <tr>
                <td class="copyheader">Date of Observation</td>
                <td class="copyheader">Observer</td>
                <td class="copyheader">Class</td>
                <td class="copyheader">Options</td>
            </tr>
            <?php while ($query->fetch()): ?>
                <?php $thisData = json_decode($data, true); ?>
                <tr>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $thisData['observer_name']; ?></td>
                    <td><?php echo $thisData['class_name']; ?> instructed by <?php echo $thisData['instructor_name']; ?></td>
                    <td><img src="img/page_white_go.png" /> <a href="view.php?id=<?php echo $id ?>">View</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
<?php $query->close(); ?>
<?php include('include/footer.php'); ?>