////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

**Scroll to Line 78 for documentation on CA2**

GitHub Link: https://github.com/nathanmoore21/music-store
CA1 Video Demo Link: https://youtu.be/0rGRRfbMtgs
CA2 Video Demo Link:

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

**CA1**
/////Part 1: (Setting up project)

-   sail artisan make:controller BookController --api --model= (for each of my controllers - Artist, Genre & Music) - This was to create an API Controller rather than a standard Resource Controller as API Controllers don't use the Create and Edit functions
-   sail artisan make:resource MusicResource - (returning one Song) Template where I could define how I wanted the JSON data to be returned
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

-   I will GET all music by calling the api.php, controllers, collections and resources

/////Part 3: (Store)

-   Use Eloquent to store data
-   Mass assignment - when a user passes an unexpected HTTP request field that changes a column in your database
-   $fillable - help you define which attributes you want to make mass assignable
-   $guarded - can specify which properties are guarded (empty array means they all are)

/////Part 4: (Show)

-   I will call the database to retrieve an {id} - this is done when api.php calls the MusicController:show() function
-   (Further Explanation) The music{id} is passed as part of the get request, api.php routes to the show() function in MusicController, Laravel retrieves the ID from the database, the MusicResource then converts it into JSON and is returned to the user.

/////Part 5: (Put/Patch)

-   PUT will work similar to POST, because if the resource doesn't already exist, it will be created.

/////Part 6: (Destroy)

-   Like all previous parts, I edited the public function in MusicController. In this section I will destroy the Music/Song which will be removed from the database.

/////Part 7: (Swagger)

-   Swagger helps users build, document, test and consume RESTful web services. (https://www.techtarget.com/searchapparchitecture/definition/Swagger)
-   In this section, I downloaded and installed Swagger for my CA
-   index.blade.php is where the JSON will be fed into swagger view.
-   I will edit a lot of my code in each of my controllers to enable proper documentation for swagger
-   After editing this code, I will: sail artisan l5-swagger:generate - to 'publish' my code so it is viewable

/////

-   Why I chose this topic for my CA?
    -It was an API I could show interest in, which in the long-run will keep me more involved

-   How did I develop this?
    -Attending classes, following the lessons posted by Anne

-   How do I plan on extending this for CA2?
    -Artists & Genres can have many albums
    -Albums can have many artists & many genres
    -Adding more detail like song length, artwork for songs

-   What is my understanding of the principles of data management and back-end application frameworks?

-   What applications/tools did I use?
    -VSCode, Insomnia, TablePlus, Laravel, Swagger, Docker

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

**CA2**

/////Part 8: (ERD)

-   Here, I created my ERD which included a pivot table (genre_music). This will allow for a many-to-many relationship between genre and music.

/////Part 9: (One to Many)

-   I created a one-to-many relationship between Artist and Music. Each Artist releases many Songs(Musics) and each Song(Musics) is released by one Artist.
-   In CA1, I created an Artist and Genre model so I did not need to redo this.
-   So firstly, I made a migration that will alter the musics table, rather than re-creating it.
-   Altered, music recourse and controller to allow artist name and label to be returned.
-   In the music resource I included the artist's name and label to be shown - not just its ID.

/////Part 10: (Artist CRUD)

-   Once again, in CA1 I had already created the majority of the artist's CRUD functionality. Although there were still some changes that needed to be made.
-   I decided against using paginate to display my data as I thought it was much cleaner, and clearer without it.
-   I created two form request classes, one which will create (StoreArtistRequest) and one which will update (UpdateArtistRequest) form validation.
-   I altered the header in insomnia to accept JSON to be returned, for when I was testing my PUT method, otherwise I was being directed to Laravel’s 'home' page

/////Part 11: (Authentication)

-   In this section, I created an AuthController which has register, login and logout. When registering and Logging in Sanctum will generate a bearer token which will give authentication to the user.
-   Sanctum was already installed as I have the latest version of Laravel, so there was no need to install it.
-   I also had to alter some lines of code in api.php to ensure authentication is required for accessing these routes.
-   I then began testing in Insomnia starting with registering a new user to receive a token to allow me access to the CRUD functions.

/////Part 12: (Many to Many)

-   As I already had a genres table, I started off with creating the genre_music table with genre_id and music_id as foreign keys.
-   I then added the belongs to many relationship in the genre and music model.
-   I created a new form request for storing music and set auth as true as I want the user to be authorised for when they are creating new music.
-   Finally, I moved on to testing in Insomnia. I stuck with entering the JSON in rather than multicast as it was just a personal preference. I tested all CRUD functionality for musics and artists.

/////Part 13: (Swagger)

-   Like CA1, I updated my swagger documentation so it is easy to read, understand and use by end-users.
