    <?php
    //skapar en klass -  (objektets "ritning") 
    class Films
        {
        //synligheten/tillgängligheten hos objektattributet till Private - där endast egna objekt kan komma åt attributet 
        private $titel;
        private $director;
        private $opening_crawl;
        private $characters;
                //Initierar objekt med konstruktorn - en metod som möjligör att jag kan hämta data
            function __construct($titel, $director, $opening_crawl, $characters) {
                $this->titel = $titel;
                $this->director = $director;
                $this->opening_crawl = $opening_crawl;
                $this->characters = $characters;
            }
                    //ett objekt refererar till sig själv med hjälp av $this
                    function getName(){
                    return $this->titel;
                    } 
                    function getDirector(){
                        return $this->director;
                    }
                    function getOpening_crawl(){
                        return $this->opening_crawl;
                    }
                    function getCharacter(){
                        return $this->characters;
                    }
        }

        //skapar en ny klass - Character
        class Character
        {
            //tilldelar objekt private-attribut
        private $name;
        private $height;
        private $mass;
        private $gender;
        private $species;
        private $films;
        //Initierar objekt med konstruktorn
            function __construct($name,$height, $mass, $gender, $species, $films) {
                $this->name = $name;
                $this->height = $height;
                $this->mass = $mass;
                $this->gender = $gender; 
                $this->species = $species;
                $this->films = $films; 
            }
                    //returnerar egenskaper - objektet refererar till sig själv med hjälp av $this
                    function getName(){
                    return $this->name;
                }
                    function getHeight(){
                    return $this->height;
                }
                    function getMass(){
                    return $this->mass;
                }
                    function getGender(){
                    return $this->gender;
                }
                    function getSpecies(){
                    return $this->species;
                    }
                    function getFilms(){
                    return $this->films; 
                }
        }

        //skapar en ny klass
        class Species 
        {
        //tilldelar objekt private-attribut
        private $name;
        private $films;
            //Initierar objekt med konstruktorn
            function __construct($name, $films) {
                $this->name = $name;
                $this->films = $films;
            }
                    //returnerar egenskaper - objektet refererar till sig själv med hjälp av $this
                    function getName(){
                    return $this->name;
                    }
                    function getFilms(){
                    return $this->films;    
                    }
        }

        //skapar en ny klass - Movies 
        class Movies
        {
        //tilldelar objekt private-attribut
        private $title;
        private $opening_crawl;
        private $director;
            //Initierar objekt med konstruktorn
            function __construct($title, $opening_crawl, $director) {
                $this->title = $title;
                $this->opening_crawl = $opening_crawl;
                $this->director = $director; 
            }
                    //returnerar egenskaper - objektet refererar till sig själv med hjälp av $this
                    function getTitle(){
                    return $this->title;
                    } 
                    function getOpening_crawl(){
                    return $this->opening_crawl;
                    }
                    function getDirector(){
                        return $this->director;
                    }    
        }   
    ?>
