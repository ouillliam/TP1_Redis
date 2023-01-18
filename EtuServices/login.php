<?php



if ( isset($_POST["submit"]) ) {
    
    $db = new PDO(
        'mysql:host=tp-epua:3308;dbname=paccoudw;charset=utf8',
        'paccoudw',
        'z5vt6yxb'
    );

    $query = "SELECT * from user WHERE email = '". $_POST["email"] ."' AND mdp = '" . $_POST["mdp"] ."'";
    $stm = $db->prepare($query);
    $stm->execute();

    $user = $stm->fetchAll()[0];

    if ( isset($user) && !empty($user) ){
        $cmd = "python3 script.py " . $user["id_user"] . " " . $_POST["service"] ;
        $output = shell_exec($cmd);
        echo "</br>" . $output;
        // Normalement ici : appel du script mais ça marche pas sur tp_epua
        echo "Normalement ici : appel du script mais ça marche pas sur tp_epua";

        $output = 1; // Pour le test

        if($output == 1){
            echo '<script type="text/javascript">
           window.location = "services.php"
            </script>';
        }elseif ($output == 0) {
            echo "Trop de connexions en 10 minutes";
        }
    }

}


?>

