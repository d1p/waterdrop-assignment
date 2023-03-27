## Project setup
You need docker and docker-compose installed on your machine.

- Clone the repository
- Go to the project dir`cd waterdrop-assignment`
- Run `./vendor/bin/sail up` to start the containers
- Run `./vendor/bin/sail artisan migrate` to run the migrations
- Run `./vendor/bin/sail php artisan queue:listen` to start the queue worker 

## API Endpoints
The postman collection is available in the **postman** directory of the project.

## Running Tests
- Run `./vendor/bin/sail artisan test` to run the tests

## Possible Improvements
- Cache the results of the API calls to reduce the number of calls to the API
- Use JSONB column type for the `data` column of the `dogs` table to improve the performance.
- Add index on the `name` key of the `dogs` table `data` column to improve the performance. (After the above improvement)

## Thoughts
- Currently, the required data on dogs are unknown, by knowing the required data, we can normalize the data and store it in a separate table. This will improve the performance of the application. (Example: breed, color, age, etc.)
- I am sure there are more improvements that can be done, but I am out of time and, I am creating this project while learning PHP and Laravel. I will be happy to discuss more improvements with you.
