NOTE: I'll be creating a lot of my notes in here, rather than giving explanations in the actual files.

/////Part 1: (Setting up project)

-   sail artisan make:controller BookController --api --model=\_\_\_\_ (for each of my controller - Artist, Genre & Music) - This was to create an API Controller rather than a standard Resource Contoller as API Contollers don't use the Create and Edit functions
-   sail artisan make:resource MusicResource - (returning one Song) Template where I could define how I wanted the JSON data to be retunred
-   sail artisan make:resource MusicCollection - (returning multiple Songs)
-   sail artisan migrate - to publish tables to the database
-   seeded the database with fake data using faker in MusicFactory.php and by editing the public function in the seeder file
    when seeding the command sail artisan db:seed didn't seem to be working for me so I had to run the alternative command/s
    ;sail artisan db:seed --class=MusicSeeder
    ;sail artisan db:seed --class=ArtistSeeder
    ;sail artisan db:seed --class=GenreSeeder
-   sail artisan route:list - gave me an insight to the http method required, the endpoint and the action. For example;
    GET... api/musics/{music}... musics.show > MusicController@show

/////Part 2: (GET all)

-   I will GET all music by calling the api.php, contollers, collections and recources

/////Part 3: (Store)

-   Use Eloquent to store data
-   Mass assignment - when a user passes an unexpected HTTP request field that changes a column in your database
-   $fillable - help you define which attribrutes you want to make mass assignable
-   $guarded - can specify which properties are guarded (empty array means they all are)

/////Part 4: (Show)

-   I will call the database to retive an {id} - this is done when api.php calls the MusicController:show() function
-   (Further Explanation) The music{id} is passed as part of the get request, api.php routes to the the show() function in MusicController, Laravel retrives the ID from the database, the MusicResource then converts it into JSON and is returned to the user.

/////Part 5: (Put/Patch)

-   PUT will work similar to POST, because if the resource doesn't already exist, it will be created.

/////Part 6: (Destroy)

-   Like all previous parts, I edited the public function in MusicController. In this section I will destroy the Music/Song which will be removed fom the database.

/////Part 7: (Swagger)

-   Swagger helps users build, document, test and consume RESTful web services. (https://www.techtarget.com/searchapparchitecture/definition/Swagger)
-   In this section, I downloaded and installed Swagger for my CA
-   index.blade.php is where the JSON will be fed into swagger view.
-   I will edit a lot of my code in each of my controllers to eanble proper documentation for swagger
-   After editing this code, I will: sail artisan l5-swagger:generate - to 'publish' my code so it is viewable

/////////////////////////////////////
SCRIPT

-   Using api.php rather than web.php because **\_\_\_** (part 1, slide 16)
