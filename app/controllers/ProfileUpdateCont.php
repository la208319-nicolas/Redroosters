<?php
session_start();
/* Check si le formulaire d'update du profile est correctement remplit */

require_once("tools.php");
require_once("ProfileCont.php");
$contProfile = new ProfileCont();

// Elimine les dangers éventuelles pouvant provenir des données entrée par l'utilisateur
function cleanData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Potentiel erreur
$isError=false;
$error = false;

//FAIRE TEST
//WORK
//vérification nom
if( isset($_POST["inputFirstName"]) && !empty($_POST["inputFirstName"]) )
{
    if(!strlen($_POST["inputFirstName"]) > 2 && !strlen($_POST["inputFirstName"]) < 51){
        $isError=true;
    }
}else{
    $isError = true;
}

//FAIRE TEST
//WORK
//vérification prénom
if( isset($_POST["inputLastName"]) && !empty($_POST["inputLastName"]) )
{
    if(!strlen($_POST["inputLastName"]) > 2 && !strlen($_POST["inputLastName"]) < 51){
        $isError = true;
    }
}else{
    $isError = true;
}

//FAIRE TEST
//WORK
//vérification surnom
if( isset($_POST["inputNickName"]) && !empty($_POST["inputNickName"]) )
{
    if(!strlen($_POST["inputNickName"]) > 2 && !strlen($_POST["inputNickName"]) < 51){
        $isError = true;
    }
}else{
    $isError = true;
}

//FAIRE TEST
//WORK
//vérification date
if( isset($_POST["inputDateBirth"]) && !empty($_POST["inputDateBirth"]) )
{
    if(!isDateValid($_POST["inputDateBirth"])){
        $isError = true;
    }
}else{
    $isError = true;
}

//FAIRE TEST
//WORK
//vérification téléphone
if( isset($_POST["inputPhone"]) && !empty($_POST["inputPhone"]) )
{
    if(!strlen($_POST["inputPhone"]) > 16){
        $isError = true;
    }

    $pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im";
    $phone = cleanData($_POST["inputPhone"]);
    if(!preg_match($pattern,$phone)){
        $isError = true;
    } 
}else{
    $isError=true;
}

//FAIRE TEST
//NOT WORK (A TEST)
//vérification email
if( isset($_POST["inputMail"]) && !empty($_POST["inputMail"]) )
{
    if(!strlen($_POST["inputMail"]) > 256){
        $isError = true;
    }

    if(!filter_var($_POST["inputMail"],FILTER_VALIDATE_EMAIL)){
        $isError = true;
    }

    require_once('../models/user.php');
    $user = new User();
    if($_POST["inputMail"] != null){
        if($user->checkMail($_POST["inputMail"])){
            if($user->getMail() == $_POST['inputMail']){
                $isError = true;
            }
        }
    }
}else{
    $isError = true;
}

//FAIRE TEST
//NOT WORK (A TEST)
//vérification EmergencyEmail
if( isset($_POST["inputEmergencyMail"]) && !empty($_POST["inputEmergencyMail"]) )
{
    if(strlen($_POST["inputEmergencyMail"]) > 255){
        $isError=true;
    }

    if(!filter_var($_POST["inputEmergencyMail"],FILTER_VALIDATE_EMAIL)){
        $isError = true;
    }

}else{
    $isError = true;
}


//FAIRE TEST
//NOT WORK (A TEST)
//vérification ParentEmail
if( isset($_POST["inputParentMail"]) && !empty($_POST["inputParentMail"]) )
{
    if(strlen($_POST["inputParentMail"]) > 255){
        $isError=true;
    }

    if(!filter_var($_POST["inputParentMail"],FILTER_VALIDATE_EMAIL)){
        $isError = true;
    }

}else{
    $isError = true;    
}

//FAIRE TEST
//Vérification si c'est un joueur
$user = $contProfile->getUser();
if($user->getIsPlayer() == 1){

    //FAIRE TEST
    //WORK
    //vérification seasonArrived
    if( isset($_POST["inputSeasonArrivedPlayer"]) && !empty($_POST["inputSeasonArrivedPlayer"]) )
    {
        if(!isDateValid($_POST["inputSeasonArrivedPlayer"])){
            $isError = true;
        }
        
    }else{
        $isError = true;
    }

    //FAIRE TEST
    //WORK
    //vérification position
    if( isset($_POST["inputPosition"]) && !empty($_POST["inputPosition"]) )
    {
        $positions = $contProfile->getAllPositions();
        $isFind = false;
        foreach($positions as $key => $value) {
            if($value['name'] == $_POST["inputPosition"]){
                $isFind = true;
            }
        }

        if(!$isFind){
            $isError = true;
        }
    }

    //FAIRE TEST
    //WORK
    //vérification jersey number
    if( isset($_POST["inputJerseyNumber"]) && !empty($_POST["inputJerseyNumber"]) )
    {
        if($_POST["inputJerseyNumber"] < 0 || $_POST["inputJerseyNumber"] > 99){
            $isError = true;
        }
    }

    //FAIRE TEST
    //WORK
    //vérification license number
    if( isset($_POST["inputLicenseNumber"]) && !empty($_POST["inputLicenseNumber"]) )
    {
        if(!(strlen($_POST["inputLicenseNumber"]) < 11)){
            $isError=true;
        }
    }

    //FAIRE TEST
    //WORK
    //vérification handedness
    if( isset($_POST["inputHandedness"]) && !empty($_POST["inputHandedness"]) )
    {
        if($_POST["inputHandedness"] != 1 && $_POST["inputHandedness"] != 0){
            $isError=true;
        }
    }

    //FAIRE TEST
    //WORK
    //vérification size
    if( isset($_POST["inputSize"]) && !empty($_POST["inputSize"]) )
    {
        if($_POST["inputSize"] < 100 && $_POST["inputSize"] > 250){
            $isError=true;
        }
    }

    //FAIRE TEST
    //WORK
    //vérification weight
    if( isset($_POST["inputWeight"]) && !empty($_POST["inputWeight"]) )
    {
        if($_POST["inputWeight"] < 30 && $_POST["inputWeight"] > 150){
            $isError=true;
        }
    }

}
else
{
    //FAIRE TEST
    // WORK
    //vérification seasonArrived
    if( isset($_POST["inputSeasonArrivedStaff"]) && !empty($_POST["inputSeasonArrivedStaff"]) )
    {
        if(!isDateValid($_POST["inputSeasonArrivedStaff"])){
            $isError = true;
        }
        
    }else{
        $isError = true;
    }

    //FAIRE TEST
    // WORK
    //vérification function
    if( isset($_POST["inputFunction"]) && !empty($_POST["inputFunction"]) )
    {
        $functions = $contProfile->getAllFunction();
        $isFind = false;
        foreach($functions as $key => $value) {
            if($value['name'] == $_POST["inputFunction"]){
                $isFind = true;
            }
        }

        if(!$isFind){
            $isError = true;
        }
    }
}

if(!$isError){
    //update profil
    
    $firstN = cleanData($_POST["inputFirstName"]);
    $lastN = cleanData($_POST["inputLastName"]);

    $user->setMail($_POST['inputMail']);
    $user->setPhone($_POST['inputPhone']);
    $user->setFirstName($_POST['inputFirstName']);
    $user->setNickname($_POST['inputNickName']);
    $user->setLastName($_POST['inputLastName']);
    $user->setDateBirth($_POST['inputDateBirth']);
    $user->setEmergencyMail($_POST['inputEmergencyMail']); 
    $user->setParentMail($_POST['inputParentMail']);

    //Verifie si ça marche
    $user->updateUser();

    if($user->getIsPlayer() == 1){
        $player = new Player();
        $player->setSeasonArrived($_POST['inputSeasonArrivedPlayer']);

        //todo
        $player->setIsCarpooling($_POST['inputIsCarpooling']); 
        $player->setIsSick($_POST['inputIsSick']); 
        $player->setIsBan($_POST['inputIsBan']);

        $player->setWeight($_POST['inputWeight']);
        $player->setSize($_POST['inputSize']);
        $player->setHandedness($_POST['inputHandedness']);
        $player->setLicenseNumber($_POST['inputLicenseNumber']); 
        $player->setJerseyNumber($_POST['inputJerseyNumber']);

        //TO DO
        /* $player->setIdPosition($_POST['']); */

        //$player->updatePlayer($id);
    }else{
        $staff = new Staff();
        $staff->setSeasonArrived($_POST['inputSeasonArrivedStaff']);

        //TO DO
        /* $staff->setIdFunction($_POST['']); */

        //$staff->updateStaff($id);
    }

    header('Location: ../views/profile.php?id='.$_POST['id'].'');

}else{
    header('Location: ../views/profileManagement.php?id='.$_POST['id'].'&error=true');
}