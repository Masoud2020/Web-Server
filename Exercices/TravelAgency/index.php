
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="styles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
    <title>Travel Agency</title>
</head>

<body>
    <header>
        <div class="wrapper">
            <h1>Travel Agency<span class="orange">.</span></h1>
            <nav>
                <ul>
                    <li><a href="#main-image">Accueil</a></li>
                    <li><a href="#steps">Destinations</a></li>
                    <li><a href="#possibilities">Circuits</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="main-image">
        <div class="wrapper">
            <h2>Organisez votre<br><strong>voyage sur mesure</strong></h2>
            <a href="#" class="button-1">Par ici</a>
        </div>
    </section>

    <section id="steps">
        <div class="wrapper">
            <ul>
                <li id="step-1">
                    <h4>Planifier</h4>
                    <p>Confiez-nous vos rêves d’évasion : en famille ou entre amis, nous trouverons la formule qui comblera vos attentes.</p>
                </li>
                <li id="step-2">
                    <h4>Organiser</h4>
                    <p>Bénéficiez de l’expertise de nos spécialistes de chaque destination, ils vous accompagnent dans la réalisation de votre voyage.</p>
                </li>
                <li id="step-3">
                    <h4>Voyager</h4>
                    <p>Nous nous chargeons d’assurer votre sécurité et de veiller à votre pleine sérénité tout au long de votre voyage.</p>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
    </section>

    <section id="possibilities">
        <div class="wrapper">
            <article style="background-image: url(images/article-image-1.jpg);">
                <div class="overlay">
                    <h4>Partez en famille</h4>
                    <p><small>Offrez le meilleur à ceux que vous aimez et partagez des moments fabuleux !</small></p>
                    <a href="#" class="button-2">Plus d'infos</a>
                </div>
            </article>

            <article style="background-image: url(images/article-image-2.jpg);">
                <div class="overlay">
                    <h4>Envie de s'evader</h4>
                    <p><small>Parfois un peu d'évasion serait le bienvenue et ferait le plus grand bien !</small></p>
                    <a href="#" class="button-2">Plus d'infos</a>
                </div>
            </article>

            <div class="clear"></div>

        </div>
    </section>

    <section id="contact">
        <div class="wrapper">
            <h3 id="contact-us">Contactez-nous</h3>
            <p>Chez Travel Agency nous savons que voyager est une aventure humaine mais également un engagement financier important pour vous. C'est pourquoi nous mettons un point d'honneur à prendre en compte chacune de vos attentes pour vous aider dans
                la préparation de votre séjour, circuit ou voyage sur mesure.</p>

            <form action="requete.php" method="POST" id="myForm">
                <label for="name">Nom<span style="color: red;"> *</span></label>
                <input type="text" id="name" name="name" placeholder="Votre nom">

                <label for="email">Email<span style="color: red;"> *</span></label>
                <input type="text" id="email" name="email" placeholder="Votre email">

                <input type="submit" value="OK" class="button-3" id="submit">
                <span class="tooltip" id="name">Le format de contenu n'est pas correct</span>
                <span class="tooltip" id="email">Le format d'email n'est correct !</span>
            </form>



        </div>
    </section>

    <script>
        (function() { // On utilise une IEF pour ne pas polluerl 'espace global
            // Fonction de désactivation de l'aff des « tooltips »
            function deactivateTooltips() {
                var spans = document.getElementsByTagName('span'),
                    spansLength = spans.length;
                for (var i = 0; i < spansLength; i++) {
                    if (spans[i].className == 'tooltip') {
                        spans[i].style.display = 'none';
                    }
                }
            }
            // La fonction ci-dessous permet de récupérer la « tooltip» qui correspond à notre input

            function getTooltip(element) {
                while (element = element.nextSibling) {
                    if (element.className === 'tooltip') {
                        return element;
                    }
                }
                return false;
            }
            // Fonctions de vérification du formulaire, elles renvoient« true» si tout est OK
            var check = {}; // On met toutes nos fonctions dans un objet littéral

            check['name'] = function(id) {
                var name = document.getElementById('name'),
                    tooltipStyle = getTooltip(name).style;
                if (name.value.length >= 2) {
                    name.className = 'correct';
                    tooltipStyle.display = 'none';
                    return true;
                } else {
                    name.className = 'incorrect';
                    tooltipStyle.display = 'inline-block';
                    return false;
                }
            };



            check['email'] = function() {
                var email = document.getElementById('email'),
                    tooltipStyle = getTooltip(email).style;
                if (/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email.value)) {
                    email.className = 'correct';
                    tooltipStyle.display = 'none';
                    return true;
                } else {
                    email.className = 'incorrect';
                    tooltipStyle.display = 'inline-block';
                    return false;
                }
            };


            // Mise en place des événements
            (function() { // Utilisation d'une fonction anonyme  pour éviter les variables globales.
                var myForm = document.getElementById('myForm'),
                    inputs = document.getElementsByTagName('input'),
                    inputsLength = inputs.length;
                for (var i = 0; i < inputsLength; i++) {
                    if (inputs[i].type == 'text') {
                        inputs[i].onkeyup = function() {
                            check[this.id](this.id); // « this » représente l'input actuellement modifié
                        };
                    }
                }
                myForm.onsubmit = function() {
                    var result = true;
                    for (var i in check) {
                        result = check[i](i) && result;
                    }
                    if (result) {
                        alert('Le formulaire est bien rempli.' + '\n' + 'Nous vous contacterons dans les prochains jours');
                        document.getElementById("contact-us").innerHTML = "Déjà contacté";
                        document.getElementById("contact-us").className = "form-done";
                        document.myForm.submit();
                        document.getElementById("name").disabled = true;
                        document.getElementById("email").disabled = true;
                        document.getElementById("submit").disabled = true;

                    }
                    return false;
                };

            })();
            // Maintenant que tout est initialisé, on peut désactiver les« tooltips»
            deactivateTooltips();
        })();
    </script>


<?php
if (isset($_POST['prev'])) { ?>
    <script>
        document.getElementById("contact-us").innerHTML = "Déjà contacté";
        document.getElementById("contact-us").className = "form-done";
        document.getElementById("name").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("submit").disabled = true;
    </script>
<?php } ?>



    <footer>
        <div class="wrapper">
            <h1>Travel Agency<span class="orange">.</span></h1>
            <div class="copyright">Copyright © Tous droits réservés.</div>
        </div>
    </footer>



</body>

</html>