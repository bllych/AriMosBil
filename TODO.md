# TODO List for Basketball Court & Coach Booking Web Application

## 1. Database Setup
- [ ] Create `schema_and_seed.sql` with all required tables (users, courts, court_times, coaches, coach_times, bookings) and seed data.

## 2. Assets and Front-end Improvements
- [ ] Create `assets/` directory structure (css/, js/).
- [ ] Create `assets/js/slideshow.js` for improved slideshow behavior (fade transition, pause on hover, arrows, dots, accessibility).
- [ ] Create `assets/js/admin-modals.js` for modal handling in admin pages.
- [ ] Update `assets/css/style.css` (or extend Home.css) to include responsive styles for 4 cards, modals, reusing existing blue color palette.

## 3. Homepage Updates
- [ ] Update `index.php` to PHP: connect to DB, fetch 4 courts for cards, keep slideshow markup intact, add PHP logic for logged-in users.

## 4. Authentication System
- [ ] Create `signup.php` with form validation, password hashing, and DB insertion.
- [ ] Create `login.php` with session-based auth, password verification.
- [ ] Create `logout.php` to destroy session.
- [ ] Add session checks to protect admin pages (role='admin').

## 5. Public Pages
- [ ] Create `booking.php` for logged-in users: select court, optional coach, date/time, server-side availability check.
- [ ] Create `pages/courts.php` to list all courts.
- [ ] Create `pages/coaches.php` to list all coaches.

## 6. Admin CRUD Pages
- [ ] Create `admin/dashboard.php` as admin homepage.
- [ ] Create `admin/users.php` with list, add/edit/delete modals.
- [ ] Create `admin/courts.php` with list, add/edit/delete, modal for time slots.
- [ ] Create `admin/coaches.php` with card view, add/edit/delete, modal for availability.
- [ ] Create `admin/bookings.php` to view and manage bookings (confirm/cancel).

## 7. Process Endpoints
- [ ] Create `process/add_booking.php` for booking insertion with conflict checks.
- [ ] Create `process/add_user.php`, `process/edit_user.php`, `process/delete_user.php`.
- [ ] Create similar for courts, coaches, bookings (add, edit, delete endpoints).

## 8. Documentation
- [ ] Create `README.md` with file placement, SQL import instructions, required PHP extensions (pdo_mysql, openssl).

## 9. Testing and Final Touches
- [ ] Test full application: signup/login, booking flow, admin CRUD, slideshow improvements.
- [ ] Ensure responsive design, accessibility, and no conflicts with existing markup.
- [ ] Add comments in code for auth checks, prepared statements, CSRF hints.
