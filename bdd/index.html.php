<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php session_start(); // Démarrer la session pour accéder aux variables de session
$_SESSION['user_pseudo'] = $user; 
    $requete = $database->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
    $requete->execute(['pseudo' => $_SESSION['user_pseudo']]);
    $userid = $requete->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $userid['id'];?>
    <h1><? echo $_SESSION['user_id'] ?></h1>
    <div class="container"> 
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Profil</a></li>
            </ul>
        </nav>
        <section class="feed">
            <?php if(!empty($user)): ?>
                <h3>BIENVENUE <?= $user ?></h3>
            <?php endif; ?>
            <form id="tweetForm" action="action.php" method="POST">
                <?php if(!empty($user)): ?>
                    <input type="hidden" name="user" value="<?= $user ?>">
                <?php endif; ?>
                <textarea placeholder="Quoi de neuf ?" name="message"></textarea>
                <button type="submit">Tweeter</button>
                
            </form>
            <ul>
            <!-- Créer une boucle avec des li pour chaque skills, si acquis j'affiche une classe success sinon danger.

            La valeur de mon LI doit etre le nom de la compétence. -->
            </ul>
 <div class="tweets">
    <?php foreach($tweets as $tweet): ?>
        <div class="tweet">
            <h1><?= $tweet['pseudo']  ?></h1>
            <p><?= $tweet['message']  ?></p>
            

            
            
            <form method="post" action="delete_tweet.php">
                <input type="hidden" name="user" value = "<?= $user?>" >
                <input type="hidden" name="tweet_id" value="<?= $tweet['id']  ?>">
                <input type="submit" name="delete" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tweet ?');">
            </form>

            


        </div>
    <?php endforeach; ?>
</div>
        </section>
    </div>
</body>
</html>
