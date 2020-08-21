    <?php
    //startar session
    session_start();
    ?>
    <html>
        <head>
        <title></title>
        </head>
        <meta charset="UTF8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
        <body>
    <!-- start php -->
    <?php
    //inkluderar och infogar innehåll från films.php 
    include 'films.php';

        //hämtar session variabler och använder unserialize för att packa upp värden movieobjekts från character_details.php
        $movieobjekts = unserialize($_SESSION["movielist"]);
        $movies = $movieobjekts[$_GET["index"]];

            //skriver ut title, openingcralw och director på skrämen, då objekten instansierat på föregående sida och packats ner i serialize, räcker det att packa upp och skriva ut datan på skrämen 
            echo "<h3>" . $movies->getTitle() . "</h3>";
            echo "<b>Beskrivning: </b>" . $movies->getOpening_crawl() . "<br>";
            echo "<b>Regissör: </b>" . $movies->getDirector();
    ?>
        </body>
    </html>