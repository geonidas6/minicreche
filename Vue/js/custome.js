/**
 * Created by geonidas on 15/06/2019.
 */



function alertconditiondelehotel(lien) {

   var body = $('.modal-body');
    var lienprocess = $('#continerprocess');
    var message = "<p class='alert alert-danger' role='alert' >Vous êtes sur le point de suprimer un hotel.<br> cette opération suprimera tous les chambres et tous les reservations de cette hotel</p>";
   body.html(message);
   console.log(lien)
    lienprocess.attr('href',lien);

}



function alertconditiondelechambre(lien) {

   var body = $('.modal-body');
    var lienprocess = $('#continerprocess');
    var message = "<p class='alert alert-danger' role='alert' >Vous êtes sur le point de suprimer un chambre.<br> cette opération suprimera tous les  reservations de cette chambres</p>";
   body.html(message);
   console.log(lien)
    lienprocess.attr('href',lien);

}


