# Basketball Court & Coach Booking Web Application

A complete PHP + MySQL web application for booking basketball courts and coaches.

## Features

- User registration and login with secure password hashing
- Court and coach booking system
- Admin dashboard for managing users, courts, coaches, and bookings
- Responsive design with modern UI
- Session-based authentication
- Server-side validation and prepared statements for security

## Installation

1. **Prerequisites:**
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Web server (Apache/Nginx) or PHP built-in server

2. **Database Setup:**
   - Create a MySQL database named `basketball_booking`
   - Import the `schema_and_seed.sql` file:
     ```bash
     mysql -u your_username -p basketball_booking < schema_and_seed.sql
     ```

3. **Configuration:**
   - Update database credentials in `config.php`:
     ```php
     define('DB_USER', 'your_db_username');
     define('DB_PASS', 'your_db_password');
     ```

4. **File Structure:**
   Place files in your web server's document root:
   ```
   /
   ├── index.php
   ├── config.php
   ├── login.php
   ├── signup.php
   ├── logout.php
   ├── booking.php
   ├── schema_and_seed.sql
   ├── README.md
   ├── Home.css
   ├── scripthome.js
   ├── assets/
   │   ├── css/
   │   │   └── style.css
   │   └── js/
   │       ├── slideshow.js
   │       └── admin-modals.js
   ├── pages/
   │   ├── courts.php
   │   └── coaches.php
   ├── admin/
   │   ├── dashboard.php
   │   ├── users.php
   │   ├── courts.php
   │   ├── coaches.php
   │   └── bookings.php
   └── process/
       ├── add_booking.php
       ├── add_user.php
       ├── edit_user.php
       └── delete_user.php
   ```

5. **Permissions:**
   - Ensure the web server has write permissions for session handling
   - Make sure PHP can connect to MySQL

## Usage

1. **Access the application:**
   - Open `index.php` in your web browser

2. **Default Admin Account:**
   - Username: `admin`
   - Password: `password`

3. **User Registration:**
   - Click "Login" and then "Sign up now" to create a new account

4. **Booking:**
   - Log in as a user
   - Click "Book Now" on any court card
   - Select date, time slot, and optional coach
   - Submit booking

5. **Admin Features:**
   - Log in as admin
   - Access admin dashboard from navigation
   - Manage users, courts, coaches, and bookings via modals

## Security Notes

- All database queries use prepared statements to prevent SQL injection
- Passwords are hashed using `password_hash()` with bcrypt
- Session-based authentication protects admin pages
- Server-side validation prevents invalid data submission
- CSRF protection recommended for production (add tokens to forms)

## Required PHP Extensions

- `pdo_mysql` or `mysqli` for database connectivity
- `openssl` for password hashing
- `session` for session management

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Responsive design works on mobile and desktop

## Troubleshooting

1. **Database connection errors:**
   - Check database credentials in `config.php`
   - Ensure MySQL server is running
   - Verify database name and user permissions

2. **Session issues:**
   - Check PHP session configuration
   - Ensure write permissions for session save path

3. **File not found errors:**
   - Verify all files are in correct directories
   - Check file permissions

## Development Notes

- The slideshow markup in `index.php` is preserved as requested
- Color palette from existing CSS is reused throughout
- Admin modals use plain JavaScript for accessibility
- Booking system checks availability server-side to prevent conflicts

## License

This project is for educational purposes. Modify and use as needed.
