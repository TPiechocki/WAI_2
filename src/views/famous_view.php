<?php
$page = "famous";
include 'partial/head.php';
?>

    <div class="main">
        <aside class="left">
            <ul class=sideMenu>
                <li><a href="#s1">1. Santa Maria</a></li>
                <li><a href="#s2">2. Dar Młodzieży</a></li>
                <li><a href="#s3">3. Royal Clipper</a></li>
                <li><a href="#photos">4. Zdjęcia</a></li>
            </ul>
        </aside>
        <div id="content">
            <h2>Niektóre ze znanych żaglowców</h2>
            <span class="anchor" id="s1"> </span>
            <div class="ship">
                <h3>1. Santa Maria</h3>
                <p>
                    Żaglowiec, który uczestniczył w wyprawie Kolumba, gdy odkrył Amerykę.
                </p>
                <div class="col50 vh40">
                    <a href="#SantaMaria1">
                        <img class="shippicture" src="static/img/SantaMaria1.jpg" alt="SantaMaria" />
                    </a>
                </div>
                <div class="col50 vh40">
                    <table class="shiptable vh40">
                        <tr>
                            <td>Rok powstania</td>
                            <td>1460</td>
                        </tr>
                        <tr>
                            <td>W służbie do</td>
                            <td>25.12.1492</td>
                        </tr>
                        <tr>
                            <td>Długość</td>
                            <td>ok. 19m</td>
                        </tr>
                        <tr>
                            <td>Szerokość</td>
                            <td>ok. 5.5m</td>
                        </tr>
                        <tr>
                            <td>Zanurzenie</td>
                            <td>ok. 3.2m</td>
                        </tr>
                        <tr>
                            <td>Liczba masztów</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Wysokość masztów</td>
                            <td>Nieznana</td>
                        </tr>
                        <tr>
                            <td>Liczba żagli</td>
                            <td>Nieznana</td>
                        </tr>
                        <tr>
                            <td>Powierzchnia żagli</td>
                            <td>Nieznana</td>
                        </tr>
                    </table>
                </div>
                <input type="button" onclick="local(1);session(1);" value="Przeczytane">
            </div>
            <span class="anchor" id="s2"> </span>
            <div class="ship">
                <h3>2. Dar Młodzieży</h3>
                <p>
                    Chyba najbardziej popularny obecnie pływający polski żaglowiec. Pełni przede wszystkim funkcję szkoleniową.
                </p>
                <div class="col50 vh40">
                    <a href="#DarMlodziezy1">
                        <img class="shippicture" src="static/img/DarMlodziezy1.jpg" alt="Dar Młodzieży" />
                    </a>
                </div>
                <div class="col50 vh40">
                    <table class="shiptable vh40">
                        <tr>
                            <td>Rok powstania</td>
                            <td>1981</td>
                        </tr>
                        <tr>
                            <td>W służbie do</td>
                            <td>dziś</td>
                        </tr>
                        <tr>
                            <td>Długość</td>
                            <td>108m</td>
                        </tr>
                        <tr>
                            <td>Szerokość</td>
                            <td>14m</td>
                        </tr>
                        <tr>
                            <td>Zanurzenie</td>
                            <td>6.6m</td>
                        </tr>
                        <tr>
                            <td>Liczba masztów</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Wysokość masztów</td>
                            <td>49.5m</td>
                        </tr>
                        <tr>
                            <td>Liczba żagli</td>
                            <td>26</td>
                        </tr>
                        <tr>
                            <td>Powierzchnia żagli</td>
                            <td>3015 m<sup>2</sup></td>
                        </tr>
                    </table>
                </div>
                <input type="button" onclick="local(2);session(2);" value="Przeczytane">
            </div>
            <span class="anchor" id="s3"> </span>
            <div class="ship">
                <h3>3. SV Royal Clipper</h3>
                <p>
                    Obecnie największy żaglowiec. Warto wspomnieć, że kadłub został zbudowany w Stoczni Gdańskiej pod nazwą "Gwarek". Obecnie pełni funkcję statku pasażerskiego firmy Star Clippers.
                </p>
                <div class="col50 vh40">
                    <a href="#RoyalClipper1">
                        <img class="shippicture" src="static/img/RoyalClipper1.jpg" alt="Royal Clipper" />
                    </a>
                </div>
                <div class="col50 vh40">
                    <table class="shiptable vh40">
                        <tr>
                            <td>Rok powstania</td>
                            <td>2000</td>
                        </tr>
                        <tr>
                            <td>W służbie do</td>
                            <td>dziś</td>
                        </tr>
                        <tr>
                            <td>Długość</td>
                            <td>133.2m</td>
                        </tr>
                        <tr>
                            <td>Szerokość</td>
                            <td>16.4m</td>
                        </tr>
                        <tr>
                            <td>Zanurzenie</td>
                            <td>5.7m</td>
                        </tr>
                        <tr>
                            <td>Liczba masztów</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>Wysokość masztów</td>
                            <td>54m</td>
                        </tr>
                        <tr>
                            <td>Liczba żagli</td>
                            <td>42</td>
                        </tr>
                        <tr>
                            <td>Powierzchnia żagli</td>
                            <td>5050 m<sup>2</sup></td>
                        </tr>
                    </table>
                </div>
                <input type="button" onclick="local(3);session(3);" value="Przeczytane">
            </div>
            <span class="anchor" id="photos"> </span>
            <h2>Zdjęcia</h2>
            <div class="centerText">
                <a class="lightbox" href="#SantaMaria1">
                    <img src="static/img/SantaMaria1.jpg" alt="Santa Maria" />
                </a>
                <a class="lightbox" href="#DarMlodziezy1">
                    <img src="static/img/DarMlodziezy1.jpg" alt="Dar Młodzieży" />
                </a>
                <a class="lightbox" href="#DarMlodziezy2">
                    <img src="static/img/DarMlodziezy2.jpg" alt="Dar Młodzieży" />
                </a>
                <a class="lightbox" href="#RoyalClipper1">
                    <img src="static/img/RoyalClipper1.jpg" alt="Royal Clipper" />
                </a>
                <a class="lightbox" href="#RoyalClipper2">
                    <img src="static/img/RoyalClipper2.jpg" alt="Royal Clipper" />
                </a>
            </div>
        </div>
        <aside class="right">
            <div class=sideMenu>
                <p>
                    Przejrzałeś już punkty:
                </p>
                <div id="localRead"></div>
                <p>
                    Natomiast w tej sesji punkty:
                </p>
                <div id="sessionRead"></div>
            </div>
        </aside>
        <a href="#none" class="lightbox-target" id="SantaMaria1">
            <img src="static/img/SantaMaria1.jpg" alt="Santa Maria" />
            <span class="lightbox-description">Santa Maria na obrazie Andriesa van Eertvelta (1628)</span>
            <span class="lightbox-close">&times;</span>
        </a>
        <a href="#none" class="lightbox-target" id="DarMlodziezy1">
            <img src="static/img/DarMlodziezy1_full.jpg" alt="Dar Młodzieży" />
            <span class="lightbox-description">Dar Młodzieży</span>
            <span class="lightbox-close">&times;</span>
        </a>
        <a href="#none" class="lightbox-target" id="DarMlodziezy2">
            <img src="static/img/DarMlodziezy2.jpg" alt="Dar Młodzieży" />
            <span class="lightbox-description">Dar Młodzieży</span>
            <span class="lightbox-close">&times;</span>
        </a>
        <a href="#none" class="lightbox-target" id="RoyalClipper1">
            <img src="static/img/RoyalClipper1_full.jpg" alt="Royal Clipper" />
            <span class="lightbox-description">SV Royal Clipper</span>
            <span class="lightbox-close">&times;</span>
        </a>
        <a href="#none" class="lightbox-target" id="RoyalClipper2">
            <img src="static/img/RoyalClipper2.jpg" alt="Royal Clipper" />
            <span class="lightbox-description">SV Royal Clipper</span>
            <span class="lightbox-close">&times;</span>
        </a>
    </div>

<?php include 'partial/footer.php' ?>