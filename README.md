# EMarketplace
Semester work for subject "Development of applications for internet and intranet" for Faculty of Management Science and Informatics UNIZA.

EMarketplace is a simple web application created in the **Vue.js** framework and **OctoberCMS**, which is used to create listings. It includes: 

 - Landing page with most **recent** and most **popular** listings.
 - **Filtering** listings by search term or category.
 - **Auth** System. 
 - Listing creation with details like title, description, price, category, location, number of views and images.
 - **CMS** for better data management.


## Installation
**Front-End** 
 1. Open "app" folder in terminal and install packages by typing "`npm install`" command.
 2. Type "`npm run dev`" in terminal to start project on localhost.

**Back-End**
 1. Open "cms" folder in terminal and install packages by typing "`composer install`" command.
 2. Type "`php artisan october:migrate`" which will perform database migration, creating database tables and executing seed scripts to populate database.
 3. If you want to populate *categories* table, type "`php artisan db:seed --class=Fiiliip\EMarketplace\Classes\Seeders\CategoryTableSeeder`"