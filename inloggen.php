<div class="content">
    <form name="inloggen" method="post" enctype="multipart/form-data" action="">
        <p id="page_titel">Inloggen</p>
        <input required type="email" name="E-Mail" placeholder="Pieterpost@yahmail.com" />
        <input required type="Password" name="Wachtwoord" placeholder="Wachtwoord" />
        <div class ="icon_container"> 
            <input type="submit" class="icon" id="submit" name="submit" value="%rarr;"/>
        </div>
        <a href="registreren.php" >Registreren</a><br>
        <a href="Wachtwoord_vergeten.php"> Ik ben mijn wachtwoord vergeten</a>
    </form>
</div>
<?php
if(isset($_POST["submit"])){
    $melding = "";
    $email = htmlspecialchars($_POST["e-mail"]);
    $wachtwoord = htmlspecialchars($_POST["Wachtwoord"]);
    try{
        $sql = "SELECT * FROM klant WHERE email = ?";
        $stmt = $verbinding-> prepare($sql);
        $stmt ->execute(array($email));
        $resultaat = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($resultaat){
            $wachtwoordInDatabase = $resultaat["wachtwoord"];
            $rol = $resultaat["rol"];
            if(password_verify($wachtwoord,$wachtwoordInDatabase)){
                $session["ID"] = session_id();
                $session["USER_ID"] = $resultaat["ID"];
                $session["USER_NAAM"] = $resultaat["voornaam"];
                $session["E-MAIL"] = $resultaat["email"];
                $session["STATUS"] = "ACTIEF";
                $session["ROL"] =$rol;
            if($rol ==0){
                echo "<script>location.href='index.php?page=webshop';</script>";
            }elseif($rol == 1){
                echo "<script>location.href='index.php?page=albums';</script>";
            }else{ $melding .= "Toegang Geweigerd<br>";

            }else{
                $melding .="Probeer Nogmaals In Te Loggen<br>";
            }else{
                $melding .="Probeer Nogmaals In Te Loggen<br>";
            }catch(PDOException $e){
                echo $e->getMessage();
            }
                echo "<div id='melding'->$melding</div>";
            }
        } 
    }
}
?>
