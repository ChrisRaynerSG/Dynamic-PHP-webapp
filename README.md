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

    CREATE TABLE `reviews` (
    `review_id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `rating` int unsigned NOT NULL,
    `created_at` datetime NOT NULL,
    `comment` longtext NOT NULL,
    `email_address` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`review_id`)) 

    CREATE TABLE `bookings` (
    `booking_id` int NOT NULL AUTO_INCREMENT,
    `start_date` date NOT NULL,
    `end_date` date NOT NULL,
    `guest_id` int NOT NULL,
    PRIMARY KEY (`booking_id`),
    KEY `guest_id_idx` (`guest_id`),
    CONSTRAINT `guest_id` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`));

    CREATE TABLE `lodge`.`booked_dates` (
    `booking_id` INT NOT NULL,
    `booked_date` DATE NOT NULL,
    PRIMARY KEY (`booking_id`, `booked_date`),
    CONSTRAINT `booking`
        FOREIGN KEY (`booking_id`)
        REFERENCES `lodge`.`bookings` (`booking_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION);

    CREATE TABLE `lodge`.`guests` (
    `guest_id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email_address` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(20) NULL,
    `notes` LONGTEXT NULL,
    PRIMARY KEY (`guest_id`),
    UNIQUE INDEX `email_address_UNIQUE` (`email_address` ASC) VISIBLE,
    UNIQUE INDEX `phone_number_UNIQUE` (`phone_number` ASC) VISIBLE);
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

