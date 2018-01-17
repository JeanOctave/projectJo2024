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
    $myActivities = $controller-> selectAActivities($q);
    if($myActivities >= 1) {
        foreach($myActivities as $result) {
            echo "
            <div class='activities-block'>
                <div class='row'> 
                        <div class='col-md-4 img-games'>
                            <img src=". $result['link']." alt=alterophilie class='img-responsive' width='75%'>
                        </div>
                        <div class='col-md-8'>
                            <h2>".$result['labelEvents']."</h2>
                            <p class='desc-activities'>".substr($result['descriptions'], 0, 150)."...</p>
                            <a href='user.php?page=2&&labelEvents=".$result['labelEvents']."'>View more</a>
                        </div>
                        <div class='col-md-12'>
                            <hr>
                        </div>
                </div>
            </div>
            ";
        }
    }  
    if($myActivities == null) {
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