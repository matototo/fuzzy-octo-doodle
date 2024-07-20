// J'attends le chargement de la page pour initié les comportemments comme vu en cours !
window.addEventListener('DOMContentLoaded',function(){

  // J'ai pris beaucoup de selecteurs parceque ca ma aider a comprendre ou jetais ! donc on selectionne le popup, le premier panneau, son boutton, le deuxieme panneau, son bouton et le dernier panneau
  // Il ne faut pas oublier les preventDefault sur les boutons dans les premier panneaus
    const elPopup = document.querySelector('[data-js-infolettre-pop-up]');
    const elPanneauUno = elPopup.querySelector('[data-js-panneau-1]');
    const elBouttonUno = elPanneauUno.querySelector('button');
    const elPanneauDos = elPopup.querySelector('[data-js-panneau-2]');
    const elBouttonDos = elPanneauDos.querySelector('button');
    const elPanneauTres = elPopup.querySelector('[data-js-panneau-3]');

    // Event listener qui declenche une callback qui va cacher le panneau et afficher le prochain
    elBouttonUno.addEventListener("click", function(event){
        event.preventDefault()
        elPanneauUno.classList.add("invisible");
        elPanneauDos.classList.remove("invisible");
      });

    // Idem
    elBouttonDos.addEventListener("click", function(event){
      event.preventDefault()
      elPanneauDos.classList.add("invisible");
      elPanneauTres.classList.remove("invisible");
    });

});