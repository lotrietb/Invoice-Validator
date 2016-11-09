# Invoice Validator

This guide provides the setup instructions to get the system up and running, and also information on how to interface with the API.

## Setup

- Clone the repo.
- CD into the application directory.
- Copy the `.env.example` file to `.env`, then update the database information to point to your mysql database. 
- Migrate the database using the `php artisan migrate` command. 
- Next, seed the database using the `php artisan db:seed` command. 
- Lastly, generate an application key using the `php artisan key:generate` command.

Now, using `php artisan serve` you should be all set to run the application.

The login credentials are:
username: admin@gmail.com 
password: admin

## The API

The API exposes only 1 endpoint;
- POST -`/api/validate` -> Validates the passed in json against the schema.  

To authenticate against the api, the client must pass a md5 hash of their password in the GET parameters. eg. /api/validate?pass=YOUR_MD5_PASS_HERE`

The default api password is `admin`(`21232f297a57a5a743894a0e4a801fc3`).