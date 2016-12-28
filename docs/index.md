# TM Tools

### Table of contents
1. [Introduction](#1-introduction)
2. [Technologies](#2-technologies)
3. [Application's structure](#3-applications-structure)

## 1. Introduction
The application is intended for personal use. Its main purpose is to simplify the generation of employees' documents related to travel expenses.
Also, it was a great opportunity for me to try Docker :)


## 2. Techologies
The project is built using Symfony PHP framework (v3.x) with MySql for data storage. Sonata Admin bundle is used for CRUD pages. The recommended PHP version is >7.0.

For local development, I use Docker (with docker-composer). The setup is found in the "docker" folder from application's root.

## 3. Application's structure
The main sections are:
* 3.1. HR
* 3.2. Travel
* 3.3. Reinbursement
* 3.4. Admin

### 3.1. HR
This is where the employees' details can be managed.

### 3.2. Travel
In this section you can generate the documents which contain the travel details. You can also manage generic destinations and travel purposes.

On the _Travel Documents_ list page there is the _Print_ button which generates the document in a printable format.

### 3.3. Reinbursement
In this section you can generate the documents which contain the reinbursement details.

On the _Reinbursement Documents_ list page there is the _Print_ button which generates the document in a printable format.

### 3.4. Admin
Manage application's users (add, delete, set permissions...).
