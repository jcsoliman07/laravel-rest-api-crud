
# Laravel REST API CRUD

A simple REST API built with **Laravel** for performing **CRUD operations** on products. This project uses **Repository Pattern**, **ApiResponse trait**, and includes **error handling** with database transactions.

---

## Summary

🎉 This project allows you to:

- **Create** new products
- **Read** product details or list all products
- **Update** product information
- **Delete** products
- Use proper API responses with `sendResponse` and `sendError`
- Handle errors gracefully using **rollback** on exceptions
- Separate business logic using **Repository Pattern**
- Test all endpoints using **Postman**

Next steps could include:

- Extending the API to other resources
- Implementing authentication and authorization
- Optimizing responses with pagination and filters

---

## Requirements

- PHP >= 8.0  
- Composer  
- Laravel 10  
- MySQL or any other supported database  
- Postman (for API testing)  

---

## Installation & Setup

1. **Clone the repository**

```bash
git clone https://github.com/jcsoliman07/laravel-rest-api-crud.git
cd laravel-rest-api-crud
```

2. **Install dependencies**

```bash
composer install
```

3. **Copy `.env` file and configure environment variables**

```bash
cp .env.example .env
```

Update the `.env` file with your database configuration:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. **Generate application key**

```bash
php artisan key:generate
```

5. **Run migrations**

```bash
php artisan migrate
```

6. **Run the application**

```bash
php artisan serve
```

By default, your API will be accessible at:  
```
http://127.0.0.1:8000
```

---

## API Endpoints

All API endpoints are prefixed with `/api`.  

| Method | Endpoint          | Description                | Body / Params                        |
|--------|-----------------|----------------------------|--------------------------------------|
| GET    | `/api/products`  | Get all products           | None                                 |
| GET    | `/api/products/{id}` | Get a single product by ID | URL param: `id`                      |
| POST   | `/api/products`  | Create a new product       | form-data: `name`, `price`, `description` |
| PUT    | `/api/products/{id}` | Update a product by ID     | URL param: `id`, form-data: `name`, `price`, `description` |
| DELETE | `/api/products/{id}` | Delete a product by ID     | URL param: `id`                      |

---

## Sample API Response

### Success

```json
{
  "success": true,
  "message": "Product retrieved successfully",
  "data": {
    "id": 1,
    "name": "Sample Product",
    "price": 100,
    "description": "This is a sample product",
    "created_at": "2025-08-14T12:00:00",
    "updated_at": "2025-08-14T12:00:00"
  }
}
```

### Error

```json
{
  "success": false,
  "message": "Product not found",
  "data": null
}
```

---

## Postman Setup (form-data)

1. Open **Postman**.
2. Create a **new collection**, e.g., `Laravel REST API CRUD`.
3. Add the following requests to the collection:

- **Get All Products**  
  - Method: GET  
  - URL: `http://127.0.0.1:8000/api/products`  

- **Get Product by ID**  
  - Method: GET  
  - URL: `http://127.0.0.1:8000/api/products/{id}`  

- **Create Product**  
  - Method: POST  
  - URL: `http://127.0.0.1:8000/api/products`  
  - Body: **form-data**  
    | Key          | Value                  | Type   |
    |--------------|-----------------------|--------|
    | `name`       | New Product           | Text   |
    | `price`      | 150                   | Text   |
    | `description`| Product description here | Text   |

- **Update Product**  
  - Method: PUT  
  - URL: `http://127.0.0.1:8000/api/products/{id}`  
  - Body: **form-data**  
    | Key          | Value                  | Type   |
    |--------------|-----------------------|--------|
    | `name`       | Updated Product       | Text   |
    | `price`      | 200                   | Text   |
    | `description`| Updated description here | Text   |

- **Delete Product**  
  - Method: DELETE  
  - URL: `http://127.0.0.1:8000/api/products/{id}`  

4. Test each request and verify responses.

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Controller.php           # Base controller
│   │   └── ProductController.php    # Handles product API endpoints
│   ├── Requests/
│   │   ├── StoreProductRequest.php  # Validates creating products
│   │   └── UpdateProductRequest.php # Validates updating products
│   └── Resources/
│       └── ProductResource.php      # Formats API responses for products
├── Interfaces/
│   └── ProductRepositoryInterface.php # Defines repository methods for products
├── Models/
│   ├── Product.php                   # Product model
│   └── User.php                      # User model (possibly for authentication)
├── Policies/
│   └── (currently empty)             # Can be used for authorization
├── Providers/
│   ├── AppServiceProvider.php        # Default Laravel provider
│   └── RepositoryServiceProvider.php # Binds interfaces to repository implementations
├── Repositories/
│   └── ProductRepository.php         # Implementation of product repository
└── Traits/
    └── ApiResponse.php               # Handles standard API response format

```

---

## Notes

- All operations use **database transactions** to ensure data integrity.
- Responses follow a **standard JSON format** using `ApiResponse` trait.
- Repository pattern helps separate **data access logic** from controllers for cleaner code.

---

## Next Steps

- Add **user authentication** (Laravel Sanctum or Passport)
- Add **pagination**, **search**, or **filters** for large datasets
- Extend API to handle **categories**, **orders**, or other resources

---

## Author

**Jomar Soliman**  
GitHub: [jcsoliman07](https://github.com/jcsoliman07)
