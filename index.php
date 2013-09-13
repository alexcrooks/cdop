<?php
require('include/config.php');
require('include/header.php');

if (userLoggedIn()):
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
<?php
$query->close();
else:
    if (isset($_POST['username']) && isset($_POST['password'])):
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $mysqli->prepare("SELECT id FROM admin WHERE username = ? AND passcode = ?;");
        $query->bind_param('ss', $username, $password);
        $query->execute();
        $query->bind_result($id);
        $query->fetch();
        $query->close();

        if ($id > 0):
            $_SESSION['cdop_login_user'] = $username;
            header("Location: index.php");
            exit;
        endif;
    endif;
    ?>
    <div class="viewPageNoPrint">
        <h1>Classroom Observation Protocol for Undergraduate STEM - COPUS</h1>
        <form method="post">
            <strong>Login</strong>
            <p>
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password">
            </p>
            <input type="submit" value="Login">
        </form>
    </div>
<?php
endif;
include('include/footer.php');
?>


