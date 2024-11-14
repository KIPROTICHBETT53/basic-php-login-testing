# Basic PHP E-Commerce Application

This is a simple e-commerce web application built with PHP and MySQL. It allows users to register, log in, browse featured products, and place orders. The application includes essential features such as user authentication, product listing, and order management.

## Features

- **User Registration and Login**: Users can register and log into the application.
- **Product Display**: Displays a list of featured products available for order.
- **Order Placement**: Allows users to place orders for products.
- **Order History**: Users can view their order history on the `orders.php` page.

## Prerequisites

Before you begin, ensure you have the following installed:

- **XAMPP** (or similar software like **WAMP** or **MAMP**) to run a local PHP server and MySQL database.
- **Web Browser** to access the application.

## Installation and Setup

1. **Clone the Repository**: Clone or download this project to your local machine.

    ```bash
    git clone https://github.com/KIPROTICHBETT53/ecommerce_app.git
    ```

2. **Start XAMPP**: Open XAMPP and start the **Apache** and **MySQL** modules.

3. **Database Setup**:
   - Open [phpMyAdmin](http://localhost/phpmyadmin) in your browser.
   - Create a new database, for example, `ecommerce_db`.
   - Import the `ecommerce_db.sql` file (if provided) to create necessary tables such as `users`, `products`, and `orders`.

4. **Database Configuration**:
   - Open `db_connection.php`.
   - Update the database credentials to match your local setup:

     ```php
     $servername = "localhost";
     $username = "root";
     $password = ""; // Default for XAMPP
     $dbname = "ecommerce_db";
     ```

5. **Run the Application**:
   - Place the project folder in the `htdocs` directory of your XAMPP installation.
   - Open [http://localhost/ecommerce-app](http://localhost/ecommerce-app) in your browser.

## File Structure

- `index.php` - Main page displaying the welcome message and featured products.
- `register.php` - User registration page.
- `login.php` - User login page.
- `logout.php` - Logs the user out of the application.
- `products.php` - Displays the product list with an option to place an order.
- `orders.php` - Displays the user’s order history and processes new orders.
- `db_connection.php` - Database connection file.
- `css/style.css` - Styles for the application.

## Usage

1. **Register**:
   - Navigate to the [Register Page](http://localhost/ecommerce-app/register.php) to create a new account.
   
2. **Login**:
   - Log into the application using your registered credentials.
   
3. **Browse Products**:
   - Go to the [Products Page](http://localhost/ecommerce-app/products.php) to view the available products.
   
4. **Place an Order**:
   - Click the "Order" button next to a product to place an order.

5. **View Orders**:
   - Access your order history by navigating to the `orders.php` page.

## Important Notes

- **Session Management**: Ensure that sessions are properly started at the beginning of each page that requires user authentication (e.g., `session_start();`).
- **Security**: This is a basic application and may lack security features necessary for a production environment (such as input validation, password hashing, prepared statements, etc.). Additional security measures are recommended for a fully-fledged application.
- **Error Handling**: Basic error handling is implemented. Enable error reporting in your development environment to help troubleshoot any issues.

## Troubleshooting

- **Database Errors**: Ensure the database connection settings in `db_connection.php` are correct and that the `ecommerce_db` database has been created.
- **Product Not Selected Error**: If you encounter an error stating "No product selected," make sure the `product_id` is properly passed in the order form on the products page.
- **Session Issues**: If login or session issues occur, ensure that sessions are correctly started and that session variables like `user_id` are set upon successful login.

## License

This project is open-source and free to use. Modify and adapt it as needed for your own purposes.

---

Feel free to reach out with any questions or suggestions!
