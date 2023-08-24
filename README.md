## Introduction

This is a simple e-commerce web application built using LARAVEL and Apache Kafka for message queuing between consumers and producers. The website will allow users
to browse products, add items to their cart, and checkout.

## Process flow
When a user adds an item to his/her cart, a message will be sent to the Kafka topic "cart_items" with the user ID and the product ID. 
A consumer, listening to the "cart_items" topic, stores the item in the user's cart in the database. 

When a user checks out, a message will be sent to the Kafka topic "checkout" with the user ID and the list of product IDs in their cart. 
A consumer, listening to the "checkout" topic, creates an order in the database with the user ID and the list of product IDs.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## About Apache Kafka

Apache Kafka is an open-source stream-processing platform developed by the Apache Software Foundation. It is designed for handling real-time data feeds, processing streams of data, and building applications that require high-throughput, fault tolerance, and scalability.
Apache Kafka provides reliable, scalable, and fault-tolerant data streaming and processing. It has gained popularity in scenarios where the ability to handle large volumes of data in real time is crucial, such as in modern data architectures and microservices-based systems.

## Contributing

Thank you for considering contributing to the project.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Oluwasegun Ibidokun via [segunibidokun@gmail.com](mailto:segunibidokun@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The ecommerce is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
