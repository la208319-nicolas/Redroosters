<?php
require_once('Model.php');

class Team extends Model{

    private $id;
    private $name;
    private $codeRegister;
    private $idIceRink;


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of codeRegister
     */ 
    public function getCodeRegister()
    {
        return $this->codeRegister;
    }

    public function setCodeRegister($codeRegister)
    {
        $this->codeRegister = $codeRegister;
    }

    /**
     * Get the value of idIceRink
     */ 
    public function getIdIceRink()
    {
        return $this->idIceRink;
    }

    public function setIdIceRink($idIceRink)
    {
        $this->idIceRink = $idIceRink;
    }

    // Hydratation
    public function fillObject(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this,$method)){
                $this->$method($value);
            }else{
                echo 'Nom de champs invalide';
            }
        }
    }

    //Récupération d'une entrée
    public function getTeam($id){
        $sql = "SELECT * FROM  `team` WHERE id=$id";
        $data = $this->executeRequest($sql);
        $team = new Team();
        $team->fillObject($data[0]);
        return $team;
    }

    //Récupération de toute les teams sauf celle des redroosters
    public function getAllOpponents(){
        $teamListe = array();
        $sql = "SELECT * FROM  `team` WHERE id!=1";
        $data = $this->executeRequest($sql);
        foreach($data as $elem){
            $team = new Team();
            $team->fillObject($elem);
            array_push($teamListe,$team);
        }
        return $teamListe;
    }

    public function getAllTeam(){
        $sql = "SELECT * FROM `team`";
        $data = $this->executeRequest($sql);
        return $data;
    }

    public function changeCodeRegister($code){
        $sql = "UPDATE `team` set `codeRegister` = '$code' WHERE id=1";
        $this->executeRequest($sql,false);
    }
}



?>