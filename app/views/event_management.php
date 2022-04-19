<?php
session_start();
require_once("../controllers/eventManagementCont.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once("../views/includes/head.php")?>
    <title>Redroosters</title>
</head>
<body>

<?php require_once("../views/includes/header.php");?>

<div class="container align-items-center align-middle text-center d-grid mx-auto w-100 vh-100">
      <form method="POST" action="../controllers/eventManagementCont.php" class="form-event" data-bitwarden-watching="1">
      <img src="../../assets/img/logos/logo_icon_text.png" height="100px" loading="lazy"/>
      <h1 class="h3 mb-3 font-weight-normal">Ajouter/Modifier évènement</h1>

        <label for="inputName" class="sr-only">Nom</label>
        <input type="text" name="inputName" id="inputName" class="form-control" required="" autofocus="">

        <label for="inputBeginDate" class="sr-only">Date de début</label>
        <input type="date" name="inputBeginDate" id="inputBeginDate" class="form-control" required="">

        <label for="inputEndDate" class="sr-only">Date de fin</label>
        <input type="date" name="inputEndDate" id="inputEndDate" class="form-control" required="">

        <label for="inputRdvHours" class="sr-only">Heure du rendez-vous</label>
        <input type="time" name="inputRdvHours" id="inputRdvHours" class="form-control" required="">

        <label for="inputRdvDate" class="sr-only">Date du rendez-vous</label>
        <input type="date" name="inputRdvDate" id="inputRdvDate" class="form-control" required="">

        <label for="inputEndHour" class="sr-only">Heure de fin</label>
        <input type="time" name="inputEndHour" id="inputEndHour" class="form-control" required="">

        <label for="inputStreet" class="sr-only">Rue de l'évènement</label>
        <input type="text" name="inputStreet" id="inputStreet" class="form-control" required="">

        <label for="inputCity" class="sr-only">Ville de l'évènement</label>
        <input type="text" name="inputCity" id="inputCity" class="form-control" required="">

        <label for="inputPostalCode" class="sr-only">Code Postal</label>
        <input type="number" name="inputPostalCode" id="inputPostalCode" class="form-control" required="">

        <label for="inputRdvStreet" class="sr-only">Rue de rendez-vous</label>
        <input type="text" name="inputRdvStreet" id="inputRdvStreet" class="form-control" required="">

        <label for="inputRdvCity" class="sr-only">Ville de rendez-vous</label>
        <input type="text" name="inputRdvCity" id="inputRdvCity" class="form-control" required="">

        <label for="inputRdvPostalCode" class="sr-only">Code postal du rendez-vous</label>
        <input type="number" name="inputRdvPostalCode" id="inputRdvPostalCode" class="form-control" required="">

        <textarea for="inputDescription" name="inputDescription" class="sr-only">Description</textarea>
        <button class="btn btn-lg btn-primary btn-block mt-1 mb-2 w-100" type="submit" name="form-event">Ajouter évènement</button>
        <p class="mt-5 mb-3 text-muted">© Projet HELHa</p>
      </form>
    </div>
    <?php
      if(isset($_SESSION["error"])){
        echo $_SESSION["error"];
        session_destroy();
      }
    ?>
<?php require_once("../views/includes/footer.php");?>
</body>
</html>