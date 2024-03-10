# Symfony 7 with DDD, CQRS, and Docker

This project demonstrates a Symfony 7 application structured around Domain-Driven Design (DDD) principles and implementing Command Query Responsibility Segregation (CQRS) for efficient data handling. It utilizes Docker for a development-friendly environment.

## Features:

- Calling the NBP API to fetch and update currency exchange rates within the application's domain.
- CLI interface for interacting with application functions.
- Enforces a clear separation of concerns using DDD and CQRS patterns.
- Docker Compose for streamlined development and deployment.

## Prerequisites:

- Docker and Docker Compose
- MySQL8 _(optional)_
- Symfony CLI _(optional)_
- Composer _(optional)_

## Architecture

![image](https://github.com/aventez/symfony-cqrs-ddd-boilerplate/assets/38591237/d244ac93-6b97-4605-a779-e7fca5fa3c61)
Credits: Jacobs Data Solutions

## Getting started

### 1. Clone the repository

```ssh
~/$ git clone https://github.com/aventez/symfony-cqrs-ddd-boilerplate
~/$ cd symfony-cqrs-ddd-boilerplate
```

### 2. Initialize containers

```ssh
~/$ docker compose up -d
```

### 3. Install dependencies

```ssh
~/$ docker exec -it php bash
~/container$ composer install
```
