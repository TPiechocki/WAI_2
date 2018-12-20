<?php
$page = "sailing_PL";
include 'partial/head.php';
?>
    <div class="main">
        <aside class="left">
        </aside>
        <div id="content">
            <span class="anchor" id="lakes"> </span>
            <div id="next">
                <h2>Polskie Jeziora</h2>
                <p>
                    Żeglarstwo morskie wydaje się dumne, jednak najpopularniejszą formą tego sportu jest żeglarstwo śródlądowe. W Polsce są bardzo dobre warunki do takiego żeglowania, między innymi dzięki miejscom wymienionym poniżej.
                </p>
                <h3>Jeziora Mazurskie</h3>
                <p>
                    Zdecydowanie największy kompleks żeglarski. Znajduje się tu kilkanaście, a może nawet kilkadziesiąt połączonych ze sobą różnej wielkości zbiorników wodnych. Najbardziej znane z nich to chociażby największe w Polsce Śniardwy, Niegocin, Mamry i Bełdany. Jest to teren bardzo zróżnicowany, gdyż znajdują się tu jeziora szerokie, jak również bardzo wąskie. Między jeziorami jest wybudowanych dużo kanałów, na trasie można spotkać dwie śluzy lub np. zabytkowy Most Giżycki, które jest zamykany w regularnych godzinach, by żaglówki mogły przepłynąć przez kanał.
                </p>
                <a class="extlink" id="mazuryLink" href="http://mazury.carpatian.pl/mapa.html" target="_blank">Mapa Wielkich Jezior Mazurskich</a>
                <div id="altMap" ondblclick="altMap()">Kliknij tutaj dwukrotnie by pokazać link do mapy z atrakcjami Mazur</div>
                <h3>Jeziorak</h3>
                <p>
                    Najdłuższe jezioro w Polsce, ale jest bardzo wąskie. Położone jest na Iławą.
                </p>
                <a class="extlink" href="http://pojezierzeilawskie.pl/assets/jeziorak_zaplecze.pdf" target="_blank">Mapa Jezioraka</a>
                <h3>Jezioro Zegrzyńskie</h3>
                <p>
                    Popularność tego zbiornika jest spowodowano bliskością od Warszawy. Jest to zbiornik retencyjny utworzony na Narwii w 1963r.
                </p>
                <a class="extlink" href="http://cdn11.zagle.smcloud.net/t/photos/88117/porty-i-przystanie-jeziora-zegrzynskiego.png" target="_blank">Mapa Jeziora Zegrzyńskiego</a>
                <!--<h3>Zalew Sulejowski</h3>
                    <p>
                            Ma wiele cech takich samych jak Jezioro Zegrzyńskie. Popularny za sprawą bliskości Łodzi, sztuczny zbiornik na rzece Pilica, który został otwarty w 1974 roku.
                    </p>
                <a class="extlink" href="http://www.a-hoj.pl/zalew-sulejowski-czarter/mapa-zal-2/" target="_blank">Mapa Zalewu Sulejowskiego</a> -->
            </div>
            <div>
            </div>
            <input type="button" onclick="addPoint()" value="Pokaż kolejne" id="nextButton">

            <span class="anchor" id="yachts"> </span>
            <h2>Popularne żaglówki</h2>
            <div id="toggle">Kliknij tutaj by pokazać lub schować filtr</div><br />
            <div id="toggleHidden">
                <input id="filter" type="text" placeholder="Szukaj..."><br /><br />
            </div>
            <table class="tablesail">
                <tr>
                    <th>Model</th>
                    <th>Długość</th>
                    <th>Max. ilość miejsc</th>
                </tr>
                <tbody id=tofilter>
                <tr>
                    <td>Tango 780</td>
                    <td>7.8m</td>
                    <td>6</td>
                </tr>
                <tr>
                    <td>Maxus 24 evo</td>
                    <td>8.2m</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>Antila 26cc</td>
                    <td>8.3m</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>Antila 27</td>
                    <td>8.85m</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>Maxus 33</td>
                    <td>10.45m</td>
                    <td>10</td>
                </tr>
                </tbody>
            </table>
        </div>
        <aside class="right">
        </aside>
    </div>

<?php include 'partial/footer.php' ?>