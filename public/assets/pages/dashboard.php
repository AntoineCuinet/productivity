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

$req = $db->prepare("SELECT * FROM todo WHERE user_id = :user_id ORDER BY create_at DESC");
$req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
$req->execute();
$todos = $req->fetchAll();

$req = $db->prepare("SELECT * FROM routine WHERE user_id = :user_id");
$req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
$req->execute();
$routines = $req->fetchAll();



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


//Affichage des étoiles
function noteRating($note) {
    switch ($note) {
        case "1":
            echo "★☆☆☆☆";
            break;

        case "2":
            echo "★★☆☆☆";
            break;

        case "3":
            echo "★★★☆☆";
            break;

        case "4":
            echo "★★★★☆";
            break;

        case "5":
            echo "★★★★★";
            break;

        default:
            echo "";
    }
}



//test graphique
$weightTab = array();
$dateTab = array();
foreach ($notes as $note) {
    $weightTab[] = $note->weight;
    $noteCreate_at = new DateTime($note->create_at);
    $dateTab[] = $noteCreate_at->format('m-d');
}
$data = array();

for ($i = 0; $i < count($weightTab); $i++) {
    // Ajoutez chaque paire poids/jour au tableau $data
    $data[] = array("jour" => $dateTab[$i], "poids" => $weightTab[$i]);
}

// Convertir les données en format JSON
$jsonData = json_encode($data);


?>

<?php include('header.php'); ?>

<div class="dashboard-container">
        
    <h4><?= $title_dashboard; ?></h4>

    <h2>Aujourd'hui est le meilleur jour pour réussir !</h2>
    <br><br><br>

    <div class="dashboard-init">
        <!-- graph -->
        <div class="chart-container todolist">
            <canvas id="myChart" aria-label="chart" role="img"></canvas>
            <script>
                var jsonData = <?php echo $jsonData; ?>;
            </script>
        </div>
        <br>

        <!-- time -->
        <div class="todolist time">
            <h2 class="text-time-home"></h2>
        </div>
        <br><br><br>
    </div>


    <div class="dashboard-aera">

        <!-- affichage to-do-list -->
        <div class="todolist">
            <div class="add-button">
                <a href="./todo.php"><i class='bx bx-plus-circle'></i></a>
            </div>
            <?php
            if (!empty($todos)) {
                // Affichez chaque note à l'aide de la boucle foreach
                foreach ($todos as $todo) {
                    $checked = ($todo->realized_at) ? " checked" : "";
                    echo '<div class="row-todolist">';
                    echo '<div class="affichage-color" style="background-color: ' . $todo->color . ';"></div>';
                    echo '<label for="todo'.$todo->todo_id.'" class="todo-title ' . ($checked ? 'checked' : '') . '">' . $todo->title . '</label>';
                    echo '<div class="todocheck-label"><input class="todocheck" dbid="'.$todo->todo_id.'" type="checkbox" name="todo" id="todo'.$todo->todo_id.'"><span></span></div>';
                    echo '<div class="sup-button" dbidsup="'.$todo->todo_id.'"><a  ><i class="bx bx-minus-circle"></i></a></div>';
                    echo "<br>";
                    echo ' </div>';
                }
            } else {
                echo "<div class='redirect-lien'><p>Tu n'as pas encore rentré de tâche, <a href='./todo.php'>rentre t'as première tâche !</a></div>";
            }
            ?>
        </div>
        <br>



        <!-- routine -->
        <div class="todolist">
            <div class="redirect-lien">
                <a href="./routine.php">Rentre une routine dès maintenant !</a>
                <br><br><br>

                <?php
                echo "<h3>Aujourd'hui tu dois : </h3><br>";
                foreach ($routines as $routine) {
                    $recursivity = $routine->recursivity;
                    $currentDay = date('N');
                    $checked = ($routine->realized_at) ? " checked" : "";

                    if (strpos($recursivity, (string) $currentDay) !== false) {
                        // Afficher la tâche
                        echo '<div class="row-todolist">';
                        echo '<div class="affichage-color" style="background-color: ' . $routine->color . ';"></div>';
                        
                        echo '<label for="todo'.$routine->routine_id.'" class="todo-title ' . ($checked ? 'checked' : '') . '">' . $routine->title . '</label>';
                        echo '<div class="todocheck-label"><input class="todocheck" dbid="'.$routine->routine_id.'" type="checkbox" name="todo" id="todo'.$routine->routine_id.'"><span></span></div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <br><br>


        <!-- affichage notes -->
        <div class="todolist">
        <?php 
            $today = new DateTime();
            $lastNoteDay = (count($notes) > 0) ? substr($notes[0]->create_at, 0, 10) : '';

            if ($today->format('Y-m-d') !== $lastNoteDay) {
                echo "<div class='redirect-lien'><a href='./noteOfTheDay.php'>Rentre t'as note du jour !</a></div><br>";
            }
        ?>
        <?php
        if (!empty($notes)) {
            // Affichez chaque note à l'aide de la boucle foreach
            foreach ($notes as $note) {
                echo "<br><hr><br>";
                echo "<h3> $note->title </h3>";
                echo "<p>". noteRating($note->rating)."</p>";
                echo "<br>";
                echo "<p>$note->content</p>";
                echo "<br>";
            }
        } else {
            echo "<div class='redirect-lien'><p>Tu n'as pas encore rentré de note, <a href='./noteOfTheDay.php'>rentre t'as note du jour !</a></div>";
        }
        ?>
        </div>
        <br><br><br>

        
        <br><br>
    </div>



    <!-- affichage tableau -->
    <div class="table">
        <table>
            <!-- head -->
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Poids</th>
                    <?php
                    foreach ($routines as $routine) {
                        echo "<th>".$routine->title."</th>";
                    }
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

                    if ($cursor < count($notes)) {
                        $create_day = new DateTime($notes[$cursor]->create_at);
                        $modifi_day = substr($jours[$i], 5, 10);
                        if ($create_day->format('d-m-Y') === $modifi_day) {
                            echo "<td style='background: #1e6549ed; color: #FFFFF0;'>" . $notes[$cursor]->weight . "</td>";
                            $cursor++;
                        } else {
                            echo "<td style='background: #a61c1cec;'></td>";
                        }
                    } else {
                        echo "<td></td>";
                    }


                    foreach ($routines as $routine) {
                        $recursivity = $routine->recursivity;
                        $currentDay = date('N');
                        $inverse = 10 - $i;
                        $inverseCurrentDay = 8 - $currentDay +1;

                        $cycleValue = ($inverseCurrentDay + $inverse + 8) % 7 +1;
                        if (strpos($recursivity, (string) $cycleValue) !== false) {
                            if ($routine->realized_at) {
                                echo "<td style='background: #1e6549ed; color: #FFFFF0;'>" . "ok" . "</td>";
                            } else {
                                echo "<td style='background: #a61c1cec; color: #FFFFF0;'></td>";
                            }
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <br><br>




</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php include('./footer.php'); ?>
