<!DOCTYPE html>
<html>
    <head>
        <title>Title of the document</title>
    </head>

    <body>
    <h1>Accueil</h1>

    <form action="" method="post">
        <div class="container">

            <label for="email"><b>E-mail</b></label>
            <input type="email" placeholder="Enter e-mail" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>"" required>

            <label for="mdp"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="mdp" value="<?= isset($_POST["mdp"]) ? $_POST["mdp"] : "" ?>"  required>

            <div>
                <input type="radio" id="achat" name="service" value="achat"
                        checked>
                <label for="achat">Achat</label>
            </div>

            <div>
                <input type="radio" id="vente" name="service" value="vente">
                <label for="vente">Vente</label>
            </div>

            <button type="submit" value="submit" name="submit">Login</button>
            
        </div>

    </form>

    <?php include('login.php') ?>

    </body>

</html>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>