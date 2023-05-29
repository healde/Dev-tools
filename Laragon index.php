<!-- EN -->
<!-- FROM: LARAGON DEFAULT PAGE, FOR WEB SERVER WWW REPERTORY -->
<!-- Actual official version of this page: https://github.com/leokhoa/laragon/blob/master/www/index.php -->

<!-- In this version: -->
<!-- ALL HEADER'S ELEMENTS KEPT FROM OFFICIAL VERSION + a link to phpmyadmin + infotip -->
<!-- TOGGLE SWITCH Inspired by this design from Tim Silva - https://dribbble.com/shots/14199649-Dark-Light-Mode-Toggle-Switch-Pattern-A11y -->
<!-- FILE AND FOLDER TREE WITH "WWW" REPERTORY AS ROOT, GENERATED IN PHP -->
  <!-- and inspired by the code used in this article about recursivity - unsecure website http://www.finalclap.com/faq/197-php-liste-fichier-dossier-recursif -->
  <!-- + added a dimension indicating tree's level to the function -->
<!-- FILE AND FOLDER TREE DISPLAY MANAGED IN JAVASCRIPT -->
  <!-- FULL DISPLAY : all folders and files after "www" are available to link, but the current page -->
  <!-- DYNAMICAL DISPLAY : move from folder to another -->
    <!-- activ folder set to "www" at start and disable the link of the current page -->
    <!-- after a move, the activ folder won't reset without reloading, and that why the link of the current page is retablished -->
    <!-- then inable folder and files that are brothers, childrens, of the parent of the activ folder, 
         and disable all others plus the link of the activ folder -->
    <!-- apply a different style for unclickable elements, links on folders, and links on files -->

<!-- I WISH YOU AN AGREABLE JOURNEY - healde -->

<!-- FR -->
<!-- DE: PAGE D'ACCEUIL PAR DEFAUT DE LARAGON, POUR LE RÉPERTOIRE WWW -->
<!-- VERSION ACTUELLE ET OFFICIELLE DE CETTE PAGE: https://github.com/leokhoa/laragon/blob/master/www/index.php -->

<!-- Dans cette version: -->
<!-- TOUT LES ÉLÉMENTS DE LA PAGE ORGINALE SONT GARDÉS + un lien vers phpmyadmin + infobulles -->
<!-- BOUTON DEUX-ÉTATS Inspiré par le design de Tim Silva - https://dribbble.com/shots/14199649-Dark-Light-Mode-Toggle-Switch-Pattern-A11y -->
<!-- ARBORESCENCE DES DOSSIERS ET FICHIERS, AVEC LE RÉPERTOIRE "WWW" COMME RACINE, GÉNÉRÉ EN PHP -->
  <!-- et inspiré du code utilisé dans cette article pour illustrer le principe de récursivité - Site web non sécurisé : http://www.finalclap.com/faq/197-php-liste-fichier-dossier-recursif -->
  <!-- + ajoutée à cette fonction, une dimension pour indiquer le niveau dans l'arborescence -->
<!-- ARBORESCENCE DES DOSSIERS ET FICHIERS EN JAVASCRIPT -->
  <!-- SWITCH ACTIF : MODE AFFICHAGE COMPLET : tout les dossiers et fichiers après "www" sont affichés
       et redirige vers leurs adresses dans le navigateur, à part le fichier correspondant à cette page -->
  <!-- SWITCH INACTIF : MODE AFFICHAGE PARTIEL ET DYNAMIQUE : se déplacer d'un dossier à un autre -->
    <!-- le dossier actif est initialisé à la racine étant "www" au chargement, et désactive le lien du fichier correspondant à cette page -->
    <!-- après un changement de dossier actif, celui ci ne sera pas ré-initialisé sans un rechargement de la page, 
         et c'est pourquoi le lien du fichier correspondant à cette page est alors rétabli -->
    <!-- ensuite afficher les dossiers et fichiers qui sont enfants, frères, ou le parent du dossier actif.
         enfin masquer tout les autres dossier et fichiers, et désactiver entièrement le lien du dossier actif -->
    <!-- appliquer un style différent pour les liens menant vers un fichier, menant vers un dossier, et ceux entièrement désactivés -->

<!-- EN VOUS SOUHAITANT BONNES PRATIQUES AVEC CETTE PAGE - healde -->

<?php
  if (!empty($_GET['q'])) {
    switch ($_GET['q']) {
      case 'info':
        phpinfo(); 
        exit;
      break;
    }
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Laragon</title>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .opt {
                margin-top: 30px;
            }

            .opt a {
              text-decoration: none;
              font-size: 150%;
            }

            .line {
              
            }

            a {
              color: blue;
              text-decoration: none;
            }
            
            .chemin {
              text-align: initial;
            }
            
            a:visited {
              color: blue;
              text-decoration: none;
            }

            a:hover {
              color: red;
              text-decoration: none;
            }

            a.dir:hover {
              color: #0a715f;
              text-decoration: underline;
            }

            /* BOUTON DEUX ETATS, DESIGNÉ EN CSS UNIQUEMENT, POUR CHOISIR ENTRE DEUX MODES D'AFFICHAGE CONCERNANT L'ARBORESCENCE DES DOSSIERS ET FICHIERS */
            :root {
              --light: #d8dbe0;
              --dark: #0aae92;
            }


            .toggle-switch {
              left: 0;
              right: 0;
              margin: auto;
              margin-top: 20px;
              position: relative;
              width: 100px;
              height: 50px;
              text-align: left;
            }

            label {
              position: absolute;
              width: 100%;
              height: 50px;
              background-color: var(--dark);
              border-radius: 50px;
              cursor: pointer;
            }

            input {
              position: absolute;
              display: none;
            }

            .slider {
              position: absolute;
              width: 100%;
              height: 100%;
              border-radius: 50px;
              transition: 0.3s;
            }

            input:checked ~ .slider {
              background-color: var(--light);
            }

            .slider::before {
              content: "";
              position: absolute;
              top: 7px;
              left: 10px;
              width: 35px;
              height: 35px;
              border-radius: 50%;
              box-shadow: inset 10px -4px 0px 0px var(--light);
              background-color: var(--dark);
              transition: 0.3s;
            }

            input:checked ~ .slider::before {
              transform: translateX(45px);
              background-color: var(--dark);
              box-shadow: none;
            }


        </style>
    </head>
    <!-- PAGE D'ACCEUIL DE LARAGON AVEC ÉLÉMENTS INITIAUX CONSERVES -->
    <body>
        <div class="container">
          <div class="content">
                <div class="title" title="Laragon">Laragon</div>
     
                <div class="info"><br />
                      <?php print($_SERVER['SERVER_SOFTWARE']); ?><br />
                      PHP version: <?php print phpversion(); ?>   <span><a title="phpinfo()" href="/?q=info">info</a></span><br />
                      Document Root: <?php print ($_SERVER['DOCUMENT_ROOT']); ?><br />

                </div>
                <div class="opt">
                 <div><a title="Online documentation" href="https://laragon.org/docs">- Getting Started</a></div>
                 <div><a title="PhpMyAdmin" href="http://127.0.0.1/phpmyadmin/index.php?route=/&route=%2F">- Entering the Database</a></div>
                </div>

                
                <div class = 'toggle-switch' title = "Switch view for files tree">
                    <label>
                        <input type = 'checkbox'>
                        <span class = 'slider'></span>
                    </label>
                </div>

                <div class="chemin">
                  <p>
                    
                    <!-- GÉNÉRATION DE L'ARBORESCENCE DES DOSSIERS ET FICHIERS AVEC PHP -->
                    <?php

                    define("DIRLABEL", "DIRECTORY");
                    $noeud = 0;

                    // LA FONCTION DE GÉNÉRATION CONSISTE EN ...
                    function explorer($chemin, $noeud) {

                        // RÉCUPÉRATION DU LIEN CORRESPONDANT AU CHEMIN POUR LE NAVIGATEUR
                        $lien = str_replace(dirname(__FILE__, 1), "", $chemin);

                        // RECUPÉRATION DES AUTRES INFORMATIONS RELATIVES AU CHEMIN TRAITÉ
                        $lstat    = lstat($chemin);
                        $mtime    = date('d/m/Y', $lstat['mtime']);
                        $filename = basename($chemin);
                        $filetype = filetype($chemin);
                        $niveau = str_repeat(">  ", $noeud);

                        // AFFICHAGE DES INFOS SUR LE FICHIER $CHEMIN SAUF POUR LA RACINE (NOEUD=0)
                        if ( $noeud > 0 ) {

                          echo "<div class=\"line\"> $niveau <a href=\"$lien\"";

                          if ( $filetype == "dir" ) {
                            echo "class='dir'";
                          } 
                          echo "> $filename </a>";

                          if ( $filetype != "dir" ) {
                            echo "<span style='float: right'>&emsp; $lstat[size] octets";
                          } 
                          else {
                            echo "&emsp; " . DIRLABEL . "<span style='color: grey;float: right'>";
                          }
                          echo "&emsp; opened: $mtime </span></div>";
                        }
                        
                        // SI $chemin est un dossier => on RÉ-APPELLE la fonction explorer() pour chaque élément (fichier ou dossier) de ce dossier
                        if( is_dir($chemin) ) {

                            $me = opendir($chemin);
                            while( $child = readdir($me) ){
                                if( $child != '.' && $child != '..' ){
                                    $noeud += 1;
                                    explorer( $chemin.DIRECTORY_SEPARATOR.$child,  $noeud);
                                    $noeud -= 1;
                                }
                            }
                        }
                    }
                    
                    // PREMIER APPEL DE LA FONCTION explorer()
                    explorer(dirname(__FILE__), $noeud);
                    // GÉNÉRATION DE L'ARBORESCENCE TERMINÉE
                    ?>
                  </p>
                </div>
          </div>

        </div>
    </body>

    <!-- ARBORESCENCE DES DOSSIERS ET FICHIERS DYNAMIQUE AVEC JAVASCRIPT -->
    <script type="application/javascript">
      const dirlabel = "<?php echo DIRLABEL; ?>";

      // FONCTION DE MISE À JOUR DE L'ARBORESCENCE DES DOSSIERS ET FICHIERS ( "trier" < ~ > "filter" )
      function trier() {
        niveauactif = cheminactif.split("\\").length - 1;

        if (!commande.checked) {
          // SWITCH INACTIF : N'AFFICHER QUE LES DOSSIERS ET FICHIERS QUI SE TROUVENT AUTOUR DU DOSSIER ACTIF DANS L'ARBORESCENCE
            document.querySelectorAll(".line").forEach((elem) => { 
            chemin = elem.querySelector('a').getAttribute("href");
            
            // AFFICHER TOUT LES ENFANTS, LES FRÈRES, ET LE PARENT DU DOSSIER ACTIF
            if ( ( chemin.indexOf(cheminactif) >= 0 && chemin.replace(cheminactif, "").split("\\").length - 1 == 1 ) // ENFANTS
              || ( niveauactif == chemin.split("\\").length - 1 && chemin.indexOf(cheminactif.split("\\").slice(0, -1).join('\\')) >= 0 ) // FRÈRES (<> ÉLÉMENTS DE MÊME GENERATION )
              || ( niveauactif == chemin.split("\\").length && cheminactif.indexOf(chemin) >= 0 ) // PARENT (&& AU SINGULIER )

               ) { elem.hidden=false; // AFFICHER ET ...
                
                // SI L'ÉLÉMENT EST UN DOSSIER: REMPLACER L'ÉXÉCUTION CLASSIQUE DU LIEN, PAR
                // L'APPEL DE LA FONCTION DE MISE À JOUR DE L'ARBORESCENCE À PARTIR DU NOEUD CLIQUÉ RÉCUPÉRÉ COMME CHEMIN ACTIF
                elem.querySelector('a').onclick = function (e) { if ( elem.textContent.indexOf(dirlabel) >= 0 ) {

                cheminactif = elem.querySelector('a').getAttribute("href");
                trier(); // MISE À JOUR DU CHEMIN ACTIF DEPUIS CE NOEUD

                return false; // DESACTIVATION DU LIEN, EMPÊCHER QUE CELUI CI NE REDIRIGE VERS UNE NOUVELLE PAGE
                } }
            }  
            // MASQUER TOUTES LES AUTRES LIGNES
            else { elem.hidden=true; }
          });

          // ET REMPLACER LE LIEN DE LA PAGE COURANTE (AU premier appel de la fonction seulement, ou pour l'autre mode d'affichage), 
          // AINSI QUE CELUI DU DOSSIER ACTIF (À chaque appel), PAR DU TEXTE BRUTE
          // #################### ↓ Ajout / Commit : V2-1
            nombrute = "Acceuil";
            nomlien = "index.php ( reload )";
            acceuil = document.querySelector('a[href="\\\\index.php"]');
            if (acceuil) { if (niveauactif == 0) {
              acceuil.hidden = true; 

              if ( acceuil.parentNode.querySelector('span').innerText!=nombrute ) { 
                  elle=document.createElement("span"); 
                  elle.setAttribute("class", "originactiv");
                  elle.innerHTML=nombrute; 
                  acceuil.parentNode.insertBefore(elle, acceuil); 
              } } else {
                  acceuil.hidden = false;
                  if ( acceuil.parentNode.querySelector('.originactiv') ) { 
                    acceuil.parentNode.querySelector('.originactiv').remove(); }
                  acceuil.textContent=nomlien;
              } 
            }

            dossieractif = document.querySelector('a[href="' + cheminactif.replaceAll('\\', '\\\\') + '"]');
            if (dossieractif) {
              if (document.querySelector('.currentfolder') && document.querySelector('span.currentfolder ~ a')) { 
                document.querySelector('span.currentfolder ~ a').hidden=false;
                document.querySelector('.currentfolder').remove();
              }

              il=document.createElement("span");
              il.setAttribute("class", "currentfolder"); 
              il.innerHTML=cheminactif.split("\\")[niveauactif]; 
              dossieractif.parentNode.insertBefore(il, dossieractif); 
              dossieractif.hidden=true;
            }
          // #################### ↑

        }
        else {
          // SWITCH ACTIF : RÉTABLIR TOUT LES DOSSIERS ET FICHIERS DE L'ARBRE ET LEUR COMPORTEMENT PAR DEFAULT
          document.querySelectorAll(".line").forEach((elem) => { 
            elem.hidden=false; // AFFICHER ET ...
            elem.querySelector('a').onclick = function (e) { }; // RÉTABLIR LES LIENS
          })

          // ET REMPLACER LE LIEN DE LA PAGE COURANTE PAR DU TEXTE BRUTE, RETABLIR CELUI DU DOSSIER ACTIF
          // SANS réinitialiser la variable contenant dossier actif pour l'autre mode d'affichage
          // #################### ↓ Ajout / Commit : V2-1
            acceuil = document.querySelector('a[href="\\\\index.php"]');
            if (acceuil) { 
              acceuil.hidden = true; 

              if ( acceuil.parentNode.querySelector('span').innerText!=nombrute ) { 
                  elle=document.createElement("span"); 
                  elle.setAttribute("class", "originactiv");
                  elle.innerHTML=nombrute; 
                  acceuil.parentNode.insertBefore(elle, acceuil); 
              }
            }

            dossieractif = document.querySelector('a[href="' + cheminactif.replaceAll('\\', '\\\\') + '"]');
            if (dossieractif) {
              if (document.querySelector('.currentfolder') && document.querySelector('span.currentfolder ~ a')) { 
                document.querySelector('span.currentfolder ~ a').hidden=false;
                document.querySelector('.currentfolder').remove();
            } }
          // #################### ↑

        }

      } // FIN DE DÉFINITION, DE LA FONCTION DE MISE À JOUR DE L'ARBORESCENCE DES DOSSIERS ET FICHIERS

      // DÉFINITION DU CHEMIN ACTIF ET DES ÉLÉMENTS À AFFICHER POUR SI LE SWITCH EST ACTIVÉ
      let cheminactif = "";
      let niveauactif = cheminactif.split("\\").length - 1;
      let chemin = "";

      // RÉCUPÉRER LA VALEUR DU SWITCH, ET SI IL EST DÉSACTIVÉ, MASQUER TOUT LES FICHIERS ET DOSSIERS DE L'ARBRE NON DÉSIRÉS À L'AFFICHAGE
      // SINON RÉTABLIR TOUT LES DOSSIERS ET FICHIERS DE L'ARBRE
      let commande = document.querySelector('input') ;
      trier();

      commande.addEventListener("click", () => { trier(); });

    </script>
</html>
