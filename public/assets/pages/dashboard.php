<?php require('db.php'); 

//poour supprimer la session
//session_destroy();

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Mon espace';
$description_page = 'Espace personelle';
$user = $_SESSION['user'];
$title_dashboard = 'Salut '.$user->firstname.' !';
$firstnameError = $lastnameError = $emailError = $photoError = "";

$req = $db->prepare("SELECT * FROM note_of_the_day WHERE user_id = :user_id ORDER BY create_at DESC");
$req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
$req->execute();

$notes = $req->fetchAll();





?>

<?php include('header.php'); ?>

<div class="dashboard-container">
    <h4><?= $title_dashboard; ?></h4>
    <br>



    <div class="redirect-lien">
        <a href="./noteOfTheDay.php">Rentre t'as note du jour !</a>
    </div>
    <br>

    <div class="redirect-lien">
        <a href="./todo.php">Rentre des tâches pour atteindre tes objectifs !</a>
    </div>
    <br>

    <div class="redirect-lien">
        <a href="./routine.php">Rentre une routine dès maintenant !</a>
    </div>
    <br>




    <?php
    if (!empty($notes)) {
        // Affichez chaque note à l'aide de la boucle foreach
        foreach ($notes as $note) {
            echo "<br>";
            echo "<hr>";
            echo "<br>";
            echo "<h3>$note->title </h3>";
            echo "<p><strong>Note : </strong> $note->rating/5</p>";
            echo "<br>";
            echo "<p>$note->content</p>";
            echo "<br>";
        }
    } else {
        echo "<div class='redirect-lien'><p>Tu n'as pas encore rentré de note, <a href='./noteOfTheDay.php'>rentre t'as note du jour !</a></div>";
    }
    ?>
    <br><br><br>

    
    <div class="table">
        <table>
            <!-- head -->
            <thead>
                <tr>
                <?php foreach ($notes as $note) {
                    echo "<th>titre 1</th>";
                }?>
                </tr>
            </thead>

            <!-- body -->
            <tbody>
                <?php foreach ($notes as $note) {
                    echo "<tr>";
                    foreach ($notes as $note) {
                        echo "<td>contenu 1</td>";
                    }
                    echo "</tr>";
                }?>
            </tbody>
        </table>
    </div>
    <br><br><br>

</div>
<?php include('./footer.php'); ?>
