
# API Books

This API is designed for the API Restful study in PHP

## Endpoints

The end-points are showed below:

    GET|HEAD        api/books .......................... books.index › BookController@index
    POST            api/books .......................... books.store › BookController@store
    GET|HEAD        api/books/{book} ..................... books.show › BookController@show
    PUT|PATCH       api/books/{book} ................. books.update › BookController@update
    DELETE          api/books/{book} ............... books.destroy › BookController@destroy
    POST            api/login ................................ login › AuthController@login
    POST            api/logout ............................. logout › AuthController@logout
    POST            api/register .................................. AuthController@register
    GET|HEAD        api/user .............................................................. 


Also, I've added Testing with PHPUnit and a Command Client

## Command client

    php artisan app:show-books
