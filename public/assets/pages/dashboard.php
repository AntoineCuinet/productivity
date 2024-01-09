<?php require('db.php'); 

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

$req = $db->prepare("SELECT * FROM note_of_the_day WHERE user_id = :user_id ORDER BY create_at DESC LIMIT 7");
$req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
$req->execute();

$notes = $req->fetchAll();



function joursPrecedents() {
    $joursFrancais = [
        'Mon' => 'Lun',
        'Tue' => 'Mar',
        'Wed' => 'Mer',
        'Thu' => 'Jeu',
        'Fri' => 'Ven',
        'Sat' => 'Sam',
        'Sun' => 'Dim',
    ];

    $aujourdhui = new DateTime();
    $aujourdhuiFormat = $joursFrancais[$aujourdhui->format('D')] . '. ' . $aujourdhui->format('d-m-Y');

    $joursPrecedents = array();
    $joursPrecedents[] = $aujourdhuiFormat;

    for ($i = 1; $i <= 6; $i++) {
        $aujourdhui->modify('-1 day');
        $joursPrecedents[] = $joursFrancais[$aujourdhui->format('D')] . '. ' . $aujourdhui->format('d-m-Y');
    }

    return $joursPrecedents;
}

// Appel de la fonction et affichage des résultats
$jours = joursPrecedents();

$todos = $notes;
$task = '';



?>

<?php include('header.php'); ?>

<div class="dashboard-container">
    <h4><?= $title_dashboard; ?></h4>
    <br>

    <?php 
        $today = new DateTime();
        $lastNoteDay = (count($notes) > 0) ? substr($notes[0]->create_at, 0, 10) : '';

        if ($today->format('Y-m-d') !== $lastNoteDay) {
    ?>
    <div class="redirect-lien">
        <a href="./noteOfTheDay.php">Rentre t'as note du jour !</a>
        
    </div>
    <br>
    <?php } ?>

    <div class="redirect-lien">
        <a href="./todo.php">Rentre des tâches pour atteindre tes objectifs !</a>
    </div>
    <br>

    <div class="redirect-lien">
        <a href="./routine.php">Rentre une routine dès maintenant !</a>
    </div>
    <br>

    <!-- affichage notes -->
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





    <!-- affichage tableau -->
    <div class="table">
        <table>
            <!-- head -->
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Weight</th>
                    <?php
                    //foreach ($todos as $task) {
                     //   echo "<th>".$task."</th>";
                    //}
                    ?>
                </tr>
            </thead>

            <!-- body -->
            <tbody>
                <?php
                $cursor = 0;
                for ($i = 0; $i <= 6; $i++) {
                    echo "<tr>";
                    echo "<td>" . $jours[$i] . "</td>";

                    $create_day = new DateTime($notes[$cursor]->create_at);
                    $modifi_day = substr($jours[$i], 5, 10);
                    if ($create_day->format('d-m-Y') === $modifi_day) {
                        echo "<td>" . $notes[$cursor]->weight . "</td>";
                        $cursor++;
                        $cursor = (count($notes) == $cursor)? 0 : $cursor;
                    } else {
                        echo "<td></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <br><br><br>




</div>
<?php include('./footer.php'); ?>
