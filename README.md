<p align="center">
<a href="https://github.com/ahsanmauta/laravel-rest-api-/issues"><img alt="GitHub issues" src="https://img.shields.io/github/issues/ahsanmauta/laravel-rest-api-"></a>
<a href="https://github.com/ahsanmauta/laravel-rest-api-/network"><img alt="GitHub forks" src="https://img.shields.io/github/forks/ahsanmauta/laravel-rest-api-"></a>
<a href="https://github.com/ahsanmauta/laravel-rest-api-/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/ahsanmauta/laravel-rest-api-"></a>
<a href="https://github.com/ahsanmauta/laravel-rest-api-/blob/master/LICENSE.md"><img alt="GitHub license" src="https://img.shields.io/github/license/ahsanmauta/laravel-rest-api-"></a>

</p>

## Laravel 8 Rest API

Laravel 8 Rest API is a basic RESTful API crud app built with Laravel 8 and Passport. In this project a rest api created for managing product crud operations. 

Features (API) include:

- Laravel passport package
- Authentication using passport
- Logout to remove old tokens 
- Create product.
- List products.
- Update product.
- Delete product
- Search By Title
- Pagination link with json data

This app created to help developers to get started with their api crud based apps.


## Install

Install commands:
``` 
- git clone https://github.com/ahsanmauta/laravel-rest-api-.git 
- composer update
- add .env and update database settings
- php artisan migrate:fresh --seed
- php artisan serve

```

Use Postman to test the API.


## Note

- Login: 
    - URL: http://localhost/api/login 
    - Method: POST
    - Insert email and password: Body tab => x-www-form-urlencode
    - Press Enter to get Bearer token;
    - For future request add this token: 
      <br>Authorization tab: Type => Bearer Token; Insert token.
    
- Insert/Update:
    - Use Body tab => x-www-form-urlencode : Add title key and its value
    - Another way: Body tab => raw : select json type 
- Demo User (database/seeders/DatabaseSeeder.php): 
<br> ```admin@admin.com/password```


## License

The Laravel 8 Rest Api is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Contact

Feel free to contact:  
<a href="https://www.nazmulrobin.com/">nazmulrobin.com</a> | <a href="https://twitter.com/nhr_rob">Twitter</a> | <a href="https://www.linkedin.com/in/nhrrob/">Linkedin</a> | <a href="mailto:robin.sust08@gmail.com">Email</a>