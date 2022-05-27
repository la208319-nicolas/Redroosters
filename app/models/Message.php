<?php
//connection
require_once('Model.php');

class Message extends model{
    private $id;
    private $text;
    private $date;
    private $idUsers;
    private $idEvent;   //pas besoin pour le chat global

    public function getMessage($lastId){
        // On initialise le filtre
        $filtre = ($lastId > 0) ? " WHERE `message`.`id` > $lastId" : '';

        // On écrit la requêt
        $sql = 'SELECT `message`.`id`, `message`.`text`, `message`.`date`, `message`.`hours`, `users`.`firstName` FROM `message` LEFT JOIN `users` ON `message`.`idUsers` = `users`.`id`'.$filtre.' ORDER BY `message`.`id` DESC LIMIT 5;';

        // On récupère les données
        $messages = $this->executeRequest($sql) ;

        // On encode en JSON
        $messagesJson = json_encode($messages);

        // On envoie
        return $messagesJson;
        }

    public function addMessage($message,$user){
        $date = date('y-m-d');
        $time = date('h:i:s');
        $sql = "INSERT INTO `message`(`text`, `idUser`, `date`, `hours`) VALUES ('$message', '$user', '$date', '$time')";
        return $this->executeRequest($sql,false);
    }
}

?>