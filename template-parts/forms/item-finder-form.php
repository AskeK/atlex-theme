<form method="get" action="" class="item-finder-form">
    <a href="#" class="item-finder-toggle active">Øvelser</a>
    <a href="#" class="item-finder-toggle">Forløb</a>
    <div class="item-finder-list">
        <a href="#" class="item-finder-list-nav prev"><svg><use xlink:href="#icon-prev"></use></svg></a>
        <a href="#" class="item-finder-list-nav next"><svg><use xlink:href="#icon-next"></use></svg></a>
        <ul>
            <li>Listeitem nummer 1</li>
            <li>Listeitem nummer 2</li>
            <li>Listeitem nummer 3</li>
            <li class="active">Listeitem nummer 4</li>
            <li>Listeitem nummer 5</li>
            <li>Listeitem nummer 6</li>
            <li>Listeitem nummer 7</li>
            <li>Listeitem nummer 8</li>
        </ul>
    </div>
    <div class="item-finder-ranges">

        <fieldset class="range range-step">
            <label for="arms">Arme</label>
            <output>nej</output>
            <input type="range" value="0" name="arms">
        </fieldset>

        <fieldset class="range range-step">
            <label for="legs">Ben</label>
            <output>nej</output>
            <input type="range" value="0" name="legs">
        </fieldset>

        <fieldset class="range range-step">
            <label for="abs">Mave</label>
            <output>nej</output>
            <input type="range" value="0" name="abs">
        </fieldset>

        <fieldset class="range range-step">
            <label for="chest">Bryst</label>
            <output>nej</output>
            <input type="range" value="0" name="chest">
        </fieldset>

        <fieldset class="range range-step">
            <label for="back">Ryg</label>
            <output>nej</output>
            <input type="range" value="0" name="back">
        </fieldset>

        <fieldset class="range range-postfix" data-postfix="minut;minutter">
            <label for="time">Tid</label>
            <output>1 minut</output>
            <input type="range" value="1" min="1" max="90" name="time">
        </fieldset>

    </div>
</form>
