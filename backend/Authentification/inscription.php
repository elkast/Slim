<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    require_once 'db_connect.php';
    
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Validation des données
    $errors = [];

    // Vérification du nom
    if (empty($nom) || strlen($nom) < 2) {
        $errors[] = "Le nom doit contenir au moins 2 caractères";
    }

    // Vérification du prénom
    if (empty($prenom) || strlen($prenom) < 2) {
        $errors[] = "Le prénom doit contenir au moins 2 caractères";
    }

    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide";
    }

    // Vérification du mot de passe
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }

    // Vérification des conditions d'utilisation
    if (empty($terms)) {
        $errors[] = "Vous devez accepter les conditions d'utilisation";
    }

    // Si aucune erreur, procéder à l'inscription
    if (empty($errors)) {
        try {            
            // Vérifier si l'email existe déjà
            $check_email = $connexion->prepare("SELECT email FROM platforme_reservation.utilisateurs WHERE email = ?");
            $check_email->execute([$email]);
            
            if ($check_email->rowCount() > 0) {
                $errors[] = "Cette adresse email est déjà utilisée";
            } else {
                // Hash du mot de passe
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insertion dans la base de données
                $sql = "INSERT INTO platforme_reservation.utilisateurs (nom, prenom, email, password) VALUES (?, ?, ?, ?)";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$nom, $prenom, $email, $hashed_password]);

                // Création de la session
                $_SESSION['user_id'] = $connexion->lastInsertId();
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;

                // Redirection vers la page suivante
                header('Location: ../pages/dashboard.php');
                exit();
            }
        } catch(PDOException $e) {
            $errors[] = "Erreur de connexion à la base de données: " . $e->getMessage();
        }
    }

    // Si des erreurs existent, les stocker dans la session
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../pages/inscription.php');
        exit();
    }
}
?>
