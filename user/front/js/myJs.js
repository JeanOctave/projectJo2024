$(document).ready(function(){
    $('#content').show('drop', 1000)
});

//ajax request
$(document).ready(function() {
    $("#searchGames").keyup(function() {
         //définition variable récupérer valeur de recherche tapé
         var search = $(this).val();
         //définition variable url data
         var data = "key=" + search;
         //si l'utilisateur tape 2 mots
         if(search.length > 0) {
            //requete ajax
            $.ajax({
                type: "GET",
                url: "MVC/requestAjax/resultsAGames.php",
                data:  data,
                success: function(server_response) {
                    $("#page-aGames").html(server_response).show();
                    $("#page-games").hide();
                }
            })
         }
         else {
            $("#page-aGames").html('').hide();
            $("#page-games").show();
         }
    })
    $("#searchActivities").keyup(function() {
        //définition variable récupérer valeur de recherche tapé
        var search = $(this).val();
        //définition variable url data
        var data = "key=" + search;
        //si l'utilisateur tape 2 mots
        if(search.length > 0) {
           //requete ajax
           $.ajax({
               type: "GET",
               url: "MVC/requestAjax/resultsAActivities.php",
               data:  data,
               success: function(server_response) {
                   $("#page-aActivities").html(server_response).show();
                   $("#page-activities").hide();
               }
           })
        }
        else {
           $("#page-aActivities").html('').hide();
           $("#page-activities").show();
        }
   })
})