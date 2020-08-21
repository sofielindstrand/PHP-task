    <?php
    //startar session
    session_start();
    ?>
    <html>
    <head>
        <title></title>
    <!-- style -->
    <style>
        form {
            background-color: grey;
            padding:20px;
            margin-left:5px;
            margin-right:5px;
        }
        a {
            color: black;
            padding: -1px;   
        }
        a:hover {
            background-color: grey;
        }
        b {
            margin-left: 28px; 
        }
    </style>
        </head>
        <meta charset="UTF8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
        <body>
            <!-- Sökfunktion -->
            <form action="" method="post">
            <input type="text" name="search">
            <input type="submit" name="send" value="Sök">
            <!-- <välj>-attribut -->
            <select name="info">
            <option value="Titel">Titel</option>
            </select>
            <br><br>  
            </form> 
    <!-- start php -->
    <?php
        //inkluderar och infogar innehållet från films.php som är en annan php-fil 
        include 'films.php';
        //Hämtar data från swapi-api
        $file = file_get_contents("https://swapi.co/api/films/"); 
        $data = json_decode($file, true);
        //med hjälp av [] skapas en tom lista som senare fylls med hjälp av array push
        $movieresults = []; 
        //skapar en index-"räknare" för att ge objekten ett individuellt id
        $index = 0; 

            //Loopar igenom värden i arrayen - results från api:t, och tar fram objekten title, director, openingcrawls samt characters
            foreach ($data["results"] as $film) {
            //Skapar en if-sats som startar och visar resultat när man trycker på sök-knappen
            //stripos returnerar positionen för en sträng inuti en annan, och om strängen inte hittas returneras den som falsk 
            if (isset($_POST["search"]) && stripos($film['title'], $_POST["search"]) !==false){
                //instansierar objekt från klassen Films    
                $movieobjekt = new Films( 
                $film["title"],
                $film["director"],
                $film["opening_crawl"],
                $film["characters"]
            );
                //lägger till ett värden - movieresults, i slutet av en array/tom lista med hjälp av array_push 
                array_push($movieresults, $movieobjekt); 
                //Skriver ut och visar data från Api på skärmen samt länkar till nästa php-sida
                echo "<br><b><a href=details.php?index=$index> ".$movieobjekt->getName(). "</b></a><br>";
                //begränsar antal tecken med substr
                echo "<b>Beskrivning: </b>" . substr($movieobjekt->getOpening_crawl(), 0, 77) . "..." . "</br>"; 
                echo "<b>Regissör: </b>" . $movieobjekt->getDirector() . "</br>";
                $index++;
                }
            } 
                    //anger session variabler och använder serialize för att lagra och överföra movieresults-värden till nästa php-sida
                    $_SESSION["detailinfo"] = serialize($movieresults);
    ?>
        </body>
    </html>