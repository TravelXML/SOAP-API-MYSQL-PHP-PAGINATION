# SOAP-API-MYSQL-PHP-PAGINATION
SOAP API with MYSQL PHP in 20 mins

![cover](https://github.com/TravelXML/SOAP-API-MYSQL-PHP-PAGINATION/assets/8361967/d47d4e95-f103-4b7d-be7f-d1f92102acdd)


This project demonstrates how to set up a SOAP API using PHP and MySQL with pagination support. The application is containerized using Docker to ensure a consistent and reproducible environment. It also includes a simple rate limiting mechanism and JWT authentication for secure API access.

#### Features

- **SOAP API**: Implemented using PHP's built-in SOAP server capabilities.
- **MySQL Database**: Used for data storage, with a sample `products` table.
- **Pagination**: Supports pagination for efficient data retrieval.
- **JWT Authentication**: Ensures secure access to the API endpoints.
- **Rate Limiting**: Limits the number of requests to prevent abuse.
- **Dockerized**: Utilizes Docker and Docker Compose for easy setup and deployment.

#### Project Structure

```
SOAP-API-MYSQL-PHP-PAGINATION/
├── Dockerfile
├── composer.json
├── config.php
├── docker-compose.yml
├── index.php
├── Database.php
├── SoapHandler.php
├── request.xml
├── .gitignore
└── vendor/
```

#### Getting Started

1. **Clone the Repository**

   ```sh
   git clone https://github.com/yourusername/SOAP-API-MYSQL-PHP-PAGINATION.git
   cd SOAP-API-MYSQL-PHP-PAGINATION
   ```

2. **Build and Run the Docker Containers**

   ```sh
   docker-compose build
   docker-compose up -d
   ```

3. **Set Up the Database**

   Ensure your database is set up with a `products` table and some sample data.

   ```sql
   CREATE TABLE products (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       description TEXT,
       price DECIMAL(10, 2) NOT NULL
   );

   INSERT INTO products (name, description, price) VALUES
   ('Product 1', 'Description for product 1', 10.00),
   ('Product 2', 'Description for product 2', 20.00),
   ('Product 3', 'Description for product 3', 30.00);
   ```

4. **Test the SOAP API**

   Use the following `curl` command to test the SOAP API:

   ```sh
   curl -X POST http://localhost:80/ -H "Content-Type: text/xml; charset=utf-8" -H "SOAPAction: urn:example:products#getProducts" -d @request.xml
   ```

#### Sample `request.xml`

```xml
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:example:products">
   <soapenv:Header/>
   <soapenv:Body>
      <urn:getProducts>
         <page>0</page> <!-- Adjust page number as needed -->
         <limit>10</limit> <!-- Adjust limit as needed -->
         <token>YOUR_JWT_TOKEN_HERE</token> <!-- Ensure you have a valid JWT token if needed -->
      </urn:getProducts>
   </soapenv:Body>
</soapenv:Envelope>
```

