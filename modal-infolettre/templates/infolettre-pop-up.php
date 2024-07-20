<!-- No comment -->

<div class= "infolettre-pop-up infolettre-pop-up--ouvert" style="background-color:<?php echo $values[1] ;?>" data-js-infolettre-pop-up>
    <form method="post">
        <section data-js-panneau-1>

            <p style="color:<?php echo $values[2]?>"><?php echo $values[3]; ?></p>
            <div class="wrapper">
                <label for="nom"><?php echo $values[4]; ?></label>
                    <input type="text" name="modalnom">
                <button data-js-<?php echo $values[6]; ?>-1><?php echo $values[6]; ?></button>
            </div>

        </section>

        <section data-js-panneau-2 class="invisible">

            <p style="color:<?php echo $values[2]?>"><?php echo $values[3]; ?></p>
            <div class="wrapper">
                <label for="nom"><?php echo $values[5]; ?></label>
                    <input type="text" name="modalcourriel">
                <button data-js-<?php echo $values[6]; ?>-2><?php echo $values[6]; ?></button>
            </div>

        </section>

        <section data-js-panneau-3 class="invisible">

            <div class="wrapper">
                <button class="soumettre"><?php echo $values[7]; ?></button>
            </div>

        </section>
    </form>
</div>