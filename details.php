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
    //inkluderar och infogar innehållet från films.php 
    include 'films.php';

        //hämtar session variabler och använder unserialize för att packa upp värden från index.php
        $movieresults = unserialize($_SESSION["detailinfo"]);
        $moviedetail = $movieresults[$_GET["index"]];
        //med hjälp av [] skapas en tom lista som senare fylls med hjälp av array push
        $characterresults = [];
        //skapar en index-"räknare" för att ge objekten ett individuellt id
        $index = 0; 
        //skaoar en separat räknare för att ge varje karaktär en synlig siffra 
        $characterindex = 0; 

            //Skriver ut och visar data från Api på skärmen från klassen Films
            echo "<h3>" . $moviedetail->getName() . "</h3>";
            echo "<b>Regissör: </b>" . $moviedetail->getDirector() . "<br>"; 
            echo "<b>Beskrivning: </b>" . $moviedetail->getOpening_crawl() . "...<br>";
                    
            //Loopar igenom värden och tar fram objekten title, director, openingcrawls samt characters
            foreach ($moviedetail->getCharacter() as $characterUrl) {
            $file = file_get_contents($characterUrl);
            $data = json_decode($file, true); 
                
                //instansierar objekt från klassen Character i films.php    
                $characterobjekt = new Character(
                $data["name"],
                $data["height"],
                $data["mass"],
                $data["gender"],
                $data["species"],
                $data["films"]
                ); 
                //lägger till värden i characterresults 
                array_push($characterresults, $characterobjekt);
                $characterindex ++; 
                // skriver ut karaktärer och skapar en klickbar länk till karäktär-detaljsida 
                echo "<br><b>Karaktär " . $characterindex . ",</b>"; 
                // skapar individuella idn för att vid klick få fram rätt resultat
                $characterUrl = substr($characterUrl, 0, strlen($characterUrl) - 1);
                $pos = strrpos( $characterUrl, "/");
                echo "<br><b><a href=character_details.php?index=$index> ".$characterobjekt->getName(). "</b></a><br>";
                $index++;
            }

                    //lagrar och överför characterresults till länkad character_details.php-sida
                    $_SESSION["characterinfo"] = serialize($characterresults);
    ?>
        </body>
    </html>