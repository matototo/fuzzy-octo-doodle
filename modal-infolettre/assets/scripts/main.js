window.addEventListener('DOMContentLoaded',function(){
    const elPopup = document.querySelector('[data-js-infolettre-pop-up]');
    const elPanneauUno = elPopup.querySelector('[data-js-panneau-1]');
    const elBouttonUno = elPanneauUno.querySelector('button');
    const elPanneauDos = elPopup.querySelector('[data-js-panneau-2]');
    const elBouttonDos = elPanneauDos.querySelector('button');
    const elPanneauTres = elPopup.querySelector('[data-js-panneau-3]');

    elBouttonUno.addEventListener("click", function(event){
        event.preventDefault()
        elPanneauUno.classList.add("invisible");
        elPanneauDos.classList.remove("invisible");
      });

    elBouttonDos.addEventListener("click", function(event){
      event.preventDefault()
      elPanneauDos.classList.add("invisible");
      elPanneauTres.classList.remove("invisible");
    });

});