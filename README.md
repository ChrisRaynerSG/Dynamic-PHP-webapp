# PHP Dynamic Booking Service Web Application

<!-- <img src="public/Assets/Images/" alt="website pic 1"> -->

## Overview
### Contents
1. [Overview](#overview)
2. [Setup](#setup)
3. [Testing](#testing)
4. [Additional Information](#additional-information)


### Project Overview

This is a dynamic webpage created using PHP for an online booking service for a lodge. This project interacts with a MySql server in order to save bookings and for customers to leave reviews. Setup of the database is detailed in [setup](#setup).

## Setup
To run this project locally please follow the below steps:

 1. <b>Database creation</b>

    This project relies on a MySQL database for persistance. In order to set up a blank schema for this web app to use please use the following script to generate the database.

    ```SQL
    CREATE SCHEMA lodge

    CREATE TABLE reviews

    CREATE TABLE bookings

    CREATE TABLE booked_dates

    CREATE TABLE guests

    # Fill this with additional db information when created.

    ```
 2. <b>Database connection</b> 

    In order to connect to your newly created database, this project relies on a config.php file which must be generated. Create config.php within the config directory in the root and populate it with the following code.

    ```php
        <?php
        return [
            'DB_HOST' => '{SERVER HOST}',
            'DB_PORT' => '{SERVER PORT}',
            'DB_NAME' => 'lodge',
            'DB_USER' => '{YOUR MYSQL USERNAME}',
            'DB_PASS'=> '{YOUR MYSQL PASSWORD}'
        ];
    ```
    Replace fields marked with {} with your own credentials. For example replace {SERVER HOST} with 127.0.0.1 or localhost if running on local host.

    
### 3.

## Testing

Unit testing to be performed using PHPUnit

## Additional Information

