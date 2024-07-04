/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap.js';


import $ from 'jquery'; // Importez jQuery

 // Fonction pour vérifier si l'appareil est mobile ou tablette
 function isMobileOrTablet() {
    return window.matchMedia("(max-width: 767.98px)").matches;
  }

  // Si l'appareil n'est pas mobile ou tablette, exécuter le code
  if (!isMobileOrTablet()) {
    const text = "REPARATION ET VENTE DE MATERIEL INFORMATIQUE";
    let index = 0;
    const element = document.getElementById('repair-sale');

    function typeWriter() {
      if (index < text.length) {
        element.textContent += text.charAt(index);
        index++;
        setTimeout(typeWriter, 100);
      }
    }

    typeWriter();
  }


  
  















