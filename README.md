# College Management System

A comprehensive web-based application for managing college operations, including student data, staff details, courses, and more. Built using PHP and MySQL.

## 🚀 Features

### Admin Module
- **Dashboard**: Overview of total students, staff, courses, and feedback.
- **Staff Management**: Add, update, and manage staff members.
- **Student Management**: Add, update, and manage student records.
- **Course Management**: Create and manage courses.
- **Notice Board**: Post notices for staff and students.
- **Feedback & Articles**: View feedback and articles submitted by users.

### Staff Module
- **Mark Management**: Enter and update student marks.
- **Leave Management**: Apply for leave and view status.
- **Profile**: Manage personal profile details.

### Student Module
- **View Marks**: Check academic performance.
- **View Notices**: Stay updated with college announcements.
- **Feedback**: Submit feedback to the administration.

## 🛠️ Technologies Used
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP / Apache

## ⚙️ Installation & Setup

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/dhruvakedlaya/College-Management-System.git
    ```

2.  **Set up the Web Server**
    - Install [XAMPP](https://www.apachefriends.org/index.html) or any PHP local server.
    - Move the project folder to the `htdocs` directory (usually `C:\xampp\htdocs\`).

3.  **Configure the Database**
    - Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
    - Create a new database named `cms`.
    - Import the SQL file located at: `database/cms (8).sql`.

4.  **Run the Application**
    - Open your browser and navigate to:
      ```
      http://localhost/College_Management_System/
      ```

## 📝 Usage
- **Login**: Use the login page to access Admin, Staff, or Student dashboards.
- **Database Connection**: Default connection settings are in PHP files (e.g., `index.php`):
    - Host: `localhost`
    - User: `root`
    - Password: `""` (Empty)
    - Database: `cms`

## 🤝 Contributing
Contributions are welcome! Please fork the repository and create a pull request.
