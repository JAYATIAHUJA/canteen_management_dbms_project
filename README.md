# Canteen Management DBMS Project

A web-based Canteen Management System for efficiently handling food orders, menu management, and administrative tasks. Built with PHP and MySQL, this project provides both a user-facing food ordering interface and an admin dashboard for managing categories, foods, and orders.

---

## Features

### User Side
- **Browse Menu:** View food categories and featured dishes.
- **Search Foods:** Quickly find foods using the search bar.
- **Order Online:** Place orders for available foods.
- **Responsive UI:** Clean and modern interface for easy navigation.

### Admin Side
- **Admin Authentication:** Secure login/logout for admins.
- **Dashboard:** Overview of categories, foods, orders, and revenue.
- **Category Management:** Add, update, delete, and manage food categories.
- **Food Management:** Add, update, delete, and manage food items.
- **Order Management:** View, update, and track customer orders.
- **Admin Management:** Add, update, and delete admin users.
- **Password Management:** Update admin passwords securely.

---

## Project Structure

```
canteen_management/
│
├── admin/                # Admin dashboard and management pages
│   ├── add-admin.php
│   ├── manage-admin.php
│   ├── manage-category.php
│   ├── manage-food.php
│   ├── manage-order.php
│   └── ... (other admin features)
│
├── config/               # Configuration files
│   └── constants.php
│
├── css/                  # Stylesheets
│   ├── admin.css
│   └── style.css
│
├── images/               # Image assets
│
├── partials-front/       # Frontend reusable components
│   ├── menu.php
│   └── footer.php
│
├── index.php             # Main landing page (user side)
├── foods.php             # All foods listing
├── order.php             # Food order form
├── food-search.php       # Search results
├── category-foods.php    # Foods by category
├── categories.php        # Category listing
│
├── database_setup.sql    # SQL script to set up the database
└── README.md             # Project documentation
```

---

## Database Setup

1. **Create the Database:**
   - Import the `database_setup.sql` file into your MySQL server.
   - This will create the database, tables, and a default admin user:
     - **Username:** `admin`
     - **Password:** `admin123`

2. **Database Tables:**
   - `tbl_admin`: Admin users
   - `tbl_category`: Food categories
   - `tbl_food`: Food items
   - `tbl_order`: Customer orders

---

## Installation & Setup

1. **Clone the Repository:**
   ```bash
   git clone <repository-url>
   ```

2. **Configure Database Connection:**
   - Edit `config/constants.php` to set your database host, username, password, and database name.

3. **Set Up Web Server:**
   - Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Ensure PHP and MySQL are running.

4. **Import Database:**
   - Use phpMyAdmin or MySQL CLI to import `database_setup.sql`.

5. **Access the Application:**
   - User Side: `http://localhost/canteen_management/index.php`
   - Admin Side: `http://localhost/canteen_management/admin/login.php`

---

## Usage

- **User Side:** Browse menu, search for foods, and place orders.
- **Admin Side:** Log in as admin to manage categories, foods, orders, and other admins.

---

## Customization

- **Images:** Add your food and category images in the `images/` directory.
- **Styles:** Modify `css/style.css` and `css/admin.css` for custom styles.

---

## License

This project is for educational purposes.


