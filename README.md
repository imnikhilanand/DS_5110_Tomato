# DS_5110_Tomato

This is my final year project for DS 5110 course (Introduction to Data Management and Processing) at Northeastern University. In this project I have designed a database for real time food ordering. The web-platform was developed on top of it for user experience using HTML, JavaScript, SQL, and PHP. The objective was to showcase data modeling skills, write SQL functions, procedures, and transactions. On top of backend, there should be a front-end to showcase how real world application would perform on the underlying data model.

## ER Diagram

The below given diagram explains how different entities are related to one another. Different primary and foreign keys are highlighted. The arrows and their design signifies the different types of relationships between the entities.

<img src='tomato_ER_diagram_4.png' width="100%">

## User End

The user flow starts with loggin on the platform. There is a signup page too, but for the sake of demonstration, I have only mentioned the Login page. 

<img src='img_1.jpeg' width="100%">

Once a use login, he/she will land to the home page. At home page there will be options to select cusinies and add them to bag. 

<img src='img_2.jpeg' width="100%">

After adding food items in the cart, a user can proceed to the checkout. At the checkout page, there are three sections. In the first section the current items which are in the bag will be shown. In the second section, there will be recommended food items (based on the frequently purchased food items along with the current food items in the bag). And in the last section there will be food items that were purchased previously.

<img src='img_3.jpeg' width="100%">

## Rider Login

There is a seprate portal for Rider Login. 

<img src='img_4.jpeg' width="100%">

Once a rider login, he/she will be presented with pending orders that they can pick.

<img src='img_5.jpeg' width="100%">
