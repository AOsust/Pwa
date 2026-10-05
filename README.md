# El Confidencial

El Confidencial is a dynamic news publishing web application developed using PHP, MySQL, HTML and CSS.

The application allows users to browse news articles by category, while authenticated administrators can create, edit, archive and delete articles through an administration interface.

This project was developed as part of my studies in Information Technology and demonstrates practical experience with backend development, relational databases, authentication, CRUD operations, file uploads and dynamic web content.

## About the Project

The main goal of the project was to develop a functional news portal with a database-driven backend and an administration system for managing published content.

The application consists of a public news portal and an administration section.

Visitors can browse available articles and categories. Registered users can create accounts and log in, while users with administrator privileges have access to the content management functionality.

## Main Features

### News Portal

The public part of the application provides:

- News homepage
- Article listing
- Individual article pages
- News categories
- Europa category
- Teknautas category
- Article summaries
- Publication dates
- Article images
- Archived articles
- Responsive article layout

### User Registration

The application provides a registration system where users enter:

- First name
- Last name
- Username
- Password
- Password confirmation

The registration process checks whether the username already exists and verifies that the two entered passwords match.

Passwords are stored using PHP's `password_hash()` function rather than as plain text.

### User Login

The login system provides:

- Username authentication
- Password verification
- PHP session management
- Access level handling
- Logout functionality

After successful authentication, the application creates a session containing the user's username and access level.

### Administration Panel

Users with administrator privileges have access to the administration panel.

Administrators can:

- View all news articles
- Create new articles
- Edit existing articles
- Delete articles
- Change article titles
- Edit article summaries
- Edit article content
- Change publication dates
- Change article categories
- Upload new article images
- Replace existing images
- Archive articles

## CRUD Functionality

The project implements CRUD operations for news articles.

Create

Administrators can create new articles through the article submission form.

Read

Articles are retrieved from the MySQL database and displayed dynamically on the website.

Update

Administrators can modify existing articles, including their title, summary, content, category, publication date, archive status and image.

Delete

Administrators can remove articles from the database through the administration panel.

## Authentication and Authorization

The application uses PHP sessions for authentication and access control.

After login, the user's username and access level are stored in the session.

The administration page checks whether the user is authenticated and whether the user has administrator privileges before allowing access.

Example:

```php
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
    header("Location: login.php");
    exit;
}
