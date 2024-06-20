
Please create .env replacing the code of .env.example file and build with docker command:
# build
docker-compose up -d --build

# migration
docker compose exec php php artisan migrate

# optimize
docker compose exec php php artisan optimize:clear

# seeder
docker compose exec php php db:seed

# factory
docker compose exec php php db:seed ProductSeeder

## About this project

Sr. Software Engineer Assignment:

Objective:
Your client is planning to open a grocery store and build a website for taking
pre-orders. To help them achieve this task, prepare an independent Laravel
package/module and use VueJS for the front end.


following instructions.
● Use Vue.js as front-end libraries.
● Prepare a Laravel custom package.
● Make sure to decouple the front end from the back end.
● Create a Pre-order form that includes name, email, and product dropdown
fields.
● Conditionally add a "phone" field if the email ends with "@xyz.com".
● Include reCAPTCHA.
● Ensure that the form can only be submitted a maximum of 10 times per
minute.
● Save the form data to a database with proper validation and sanitization.
● Create a backend that shows all pre-orders in a list view. It should include
search, pagination, and ordering functionalities.
● Create two types of users: admin and manager. Admins can perform all
actions, while managers can only view records.
● Implement soft delete functionality and record the ID of the user who performs
the deletion in a "deleted_by_id" field. (you should use trait class to fill
deleted_by_id column)
● Enable searching by email and name. Use proper indexing to ensure fast
search and SQL performance.
● Implement ordering by the maximum matching ratio.
● Use queue, listener, events, etc., properly for email notifications.
● Sequentially send the confirmation email to the user's email first and then the
admin, but ensure that the admin receives the email before the user.
● We recommend using PostgreSQL as the database engine for all values or
any other feature.