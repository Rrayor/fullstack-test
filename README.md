# fullstack-test
created for job application

The project is a test for a job application

The entry point is index.php which includes the route files in accordance to the request it receives.

The routers include the controllers or send the views.

Business logic is in the controllers.

During development, I used a vhost.

For the javascript I used Parcel JS to generate backward compatible JavaScript files. The list.js, I wrote is in the root of the js folder. Parcel generated files are in js/dist.

I also used SASS/SCSS for styling. The stylesheet I wrote is root/style.scss, the compiled css file is next to it.

The provided psd file contained images at certain places in the design. I considered using FontAwesome instead of the png files, so I could style the icons, but they were not identical to the images provided.
I used the png files as images instead as I thought it would better fit the purpose of the test.

In the root folder there is also an .sql file which contains the dump of my development MySQL database. It has a database called fullstack-test.

There is a CREATE DATABASE command in it.

The database has 3 tables: user, list_item, list.

It also contains some test data, including the user data provided in the task.
