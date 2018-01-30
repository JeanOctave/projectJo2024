<?php 
require dirname(__DIR__) . "/controller/controller.php";
$controller = new controller('localhost', 'jo2024', 'root', '');
$idCountries = 0;

if(isset($_GET['countries'])) {
    $idCountries = strip_tags($_GET['countries']);
    $tabC = array(
        ":idCountries" => $idCountries
    );
    $aCompetitorCountries = $controller-> selectCompetitorCountries($tabC[":idCountries"]);
        
    foreach($aCompetitorCountries as $competitorByCountries) {
        echo"
            <tr>
                <td>".$competitorByCountries['firstname']."</td>
                <td>".$competitorByCountries['lastname']."</td>
                <td>".$competitorByCountries['stat']."</td>
                <td>".$competitorByCountries['label']."</td>
            </tr>
        ";
    }
}
