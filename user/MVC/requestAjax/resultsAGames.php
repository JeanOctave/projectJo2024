<?php
require dirname(__DIR__) . "/controller/controller.php";
$controller = new controller('localhost', 'jo2024', 'root', '');

if(isset($_GET['key'])) {
    $tab = "";
    $key = $_GET['key'];
    //?q=
    $q = array(
        "value" => $key . '%',
    );
    $myGames = $controller-> selectaGames($q);
    if($myGames >= 1) {
        foreach($myGames as $result) {
            echo "
            <div class='games-block'>
                <div class='row'> 
                        <div class='col-md-4 img-games'>
                            <img src=". $result['link']." alt=alterophilie class='img-responsive' width='75%'>
                        </div>
                        <div class='col-md-8'>
                            <h2>".$result['labelEvents']."</h2>
                            <p class='desc-games'>".substr($result['descriptions'], 0, 150)."...</p>
                            <a href='user.php?page=3&&labelEvents=".$result['labelEvents']."'>View more</a>
                        </div>
                        <div class='col-md-12'>
                            <hr>
                        </div>
                </div>
            </div>
            ";
        }
    }  
    if($myGames == null) {
        echo "
            <div class='row'> 
                <div class='col-md-12'>
                    <center>
                        <div class='alert alert-danger alert-dismissable'>
                        <a href=# class=close data-dismiss=alert aria-label=close>×</a>
                            Neither Result
                        </div>
                    </center>
                </div>
            </div>";
    }
}