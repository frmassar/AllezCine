<?php

    require('./Settings/dbconnect.php');
    require('./Settings/header.php');


    $sql = "INSERT INTO `COMMENTAIRES` (`ID-COM`, `ID-MOVIES`, `TITLE`, `TEXTE`, `DATE`, `LIKES`)
        VALUES(NULL,
            :IDMOVIES,
            :TITLE,
            :TEXTE,
            CURRENT_TIMESTAMP,
            '0'
        )";
    $stmt = $pdo->prepare($sql);

    $data = json_decode(file_get_contents('php://input'),true);
    var_dump($data);
    
    if(isset($data['Title'])){
        $idMovies = $data['idMovies'];
        $title = $data['title'];
        $texte = $data['texte'];

        $stmt->execute([
            'IDMOVIES'=> $idMovies,
            'TITLE'=>$title,
            'TEXTE'=>$texte
        ]);
        
        http_response_code(201);
        print json_encode(array("message"=>"Contact created"));
    }else{
        echo "Error posting comment :(";
        http_response_code(404);

    }

?>