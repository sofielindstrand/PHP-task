    <?php
    //startar session
    session_start();
    ?>
    <html>
        <head>
        <title></title>
        <!-- style -->
        <style>
        a:hover {
            background-color: grey;
        }
        </style>
        </head>
        <meta charset="UTF8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
        <body>
    <!-- start php -->
    <?php
    //inkluderar och infogar innehåll från films.php 
    include 'films.php';
    //hämtar session variabler och använder unserialize för att packa upp värden characterresults från details.php
    $characterresults = unserialize($_SESSION["characterinfo"]);
    $characterdetail = $characterresults[$_GET["index"]]; 
    //skapar en index-"räknare" för att ge objekten ett individuellt id
    $index = 0; 

        //Skriver ut och visar data från Api - från klassen Character på skärmen från klassen Films
        echo "<h3>" . $characterdetail->getName() . "</h3>";
        echo "<b>Längd: </b>" . $characterdetail->getHeight() . " cm" . "<br>";
        echo "<b>Vikt: </b>" . $characterdetail->getMass() . " kg" . "<br>";
        echo "<b>Kön: </b>" . $characterdetail->getGender() . "<br>";

            //Loopar igenom värden och tar fram ras som ligger på en separat länk
            foreach ($characterdetail->getSpecies() as $speciesUrl ) {
            $file = file_get_contents($speciesUrl);
            $data = json_decode($file, true); 
                //instansierar objekt från klassen Species i films.php   
                $species = new Species(
                $data["name"],
                $data["films"]
            ); 
                //skriver ut ras på skrämen
                echo "<b>Ras: </b>" . $species->getName() . "</br>";
            }
                    //skriver ut medverkat i på skrämen
                    echo "<br><b>Meverkat i:</b><br>";
                    //skapar en ny tom lista - movieobjekts
                    $movieobjekts = [];

                    //Loopar igenom fler värden och tar fram andra objekt, title, openingcrawl och director
                    foreach ($species->getFilms() as $filmUrl) {
                    $file = file_get_contents($filmUrl);
                    $data = json_decode($file, true); 
                        //instansierar objekt från klassen Movies i films.php   
                        $movies = new Movies(
                        $data["title"],
                        $data["opening_crawl"],
                        $data["director"]
                    );
                        //lägger till värden i movieobjekts 
                        array_push($movieobjekts, $movies);
                        echo "<b><a href=films_details.php?index=$index> ". $movies->getTitle(). "</b></a><br>";
                        $index++;
                    }
                            //lagrar och överför movieobjekts till länkad films.php-sida
                            $_SESSION["movielist"] = serialize($movieobjekts);

    ?>
    </body>
    </html>