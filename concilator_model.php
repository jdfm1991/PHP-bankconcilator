<?php
require_once("connection/connection.php");

class Payments extends Conectar{

    public function getbank(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();

        //QUERY

            $sql="SELECT * FROM Entity";

        
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        

    }

    public function getmovements($condition){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();

        //QUERY

            $sql="SELECT CodMov,DateMov,TipMov,DescripMov,RefMov,AmouMov,RateMov,
                (SELECT DescripCat FROM Category AS C WHERE C.CodCat = M.CodCat) AS CodCat,
                (SELECT DescripPar FROM Item AS I WHERE I.CodItem = M.CodItem) AS CodItem,
                (SELECT DescripEntity FROM Entity AS E WHERE E.CodEnt = M.CodEnt) AS CodEnt 
                FROM Movements AS M $condition";

        
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        

    }

    public function getcat(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();

        //QUERY

            $sql="SELECT * FROM Category";

        
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        

    }

    public function getitem(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();

        //QUERY

            $sql="SELECT * FROM Item";

        
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        

    }

    
    public function savepayments($date,$refenc,$descri,$amount,$motion,$entity){

        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION
        //CUANDO ES APPWEB ES CONEXION.
		$conectar= parent::conexion();
		parent::set_names();

 		//QUERY

			$sql="INSERT INTO Movements (DateMov, CodEnt, TipMov, DescripMov, RefMov, AmouMov) VALUES (?, ?, ?, ?, ?, ?)";

		//PREPARACION DE LA CONSULTA PARA EJECUTARLA.
		$sql = $conectar->prepare($sql);
        $sql->bindValue(1, $date);
        $sql->bindValue(2, $entity);
        $sql->bindValue(3, $motion);
        $sql->bindValue(4, $descri);
        $sql->bindValue(5, $refenc);
        $sql->bindValue(6, $amount);
		return $sql->execute();

	}

    public function savemovements($date,$refenc,$descri,$amount,$motion,$entity){

        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION
        //CUANDO ES APPWEB ES CONEXION.
		$conectar= parent::conexion();
		parent::set_names();

 		//QUERY

			$sql="INSERT INTO Movements (DateMov, CodEnt, TipMov, DescripMov, RefMov, AmouMov) VALUES (?, ?, ?, ?, ?, ?)";

		//PREPARACION DE LA CONSULTA PARA EJECUTARLA.
		$sql = $conectar->prepare($sql);
        $sql->bindValue(1, $date);
        $sql->bindValue(2, $entity);
        $sql->bindValue(3, $motion);
        $sql->bindValue(4, $descri);
        $sql->bindValue(5, $refenc);
        $sql->bindValue(6, $amount);
		return $sql->execute();

	}

    public function updatemovements($codmov,$ratemov,$codcat,$coditem){

        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION
        //CUANDO ES APPWEB ES CONEXION.
		$conectar= parent::conexion();
		parent::set_names();

 		//QUERY

			$sql="UPDATE Movements SET CodCat = ?, CodItem = ?, RateMov = ? WHERE CodMov = ?";

		//PREPARACION DE LA CONSULTA PARA EJECUTARLA.
		$sql = $conectar->prepare($sql);
        $sql->bindValue(1, $codcat);
        $sql->bindValue(2, $coditem);
        $sql->bindValue(3, $ratemov);
        $sql->bindValue(4, $codmov);
		return $sql->execute();

	}

    public function getvaluecat($codcat){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();

        //QUERY

            $sql="SELECT * FROM Category WHERE DescripCat = ?";

        
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $codcat);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function getvalueitem($coditem){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();

        //QUERY

            $sql="SELECT * FROM Item WHERE DescripPar = ?";

        
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $coditem);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function updaterate($ratedate,$date){

        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION
        //CUANDO ES APPWEB ES CONEXION.
		$conectar= parent::conexion();
		parent::set_names();

 		//QUERY

			$sql="UPDATE Movements SET RateMov = ? WHERE DateMov = ?";

		//PREPARACION DE LA CONSULTA PARA EJECUTARLA.
		$sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ratedate);
        $sql->bindValue(2, $date);
		return $sql->execute();

	}

}



