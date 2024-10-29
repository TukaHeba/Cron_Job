# Task Management System 

## Description
This project is a **Task Management System** built with **Laravel 10** that provides a comprehensive interface for managing tasks. It allows users and administrators to perform various operations related to task management. Administrators can perform all CRUD operations on tasks and change their statuses, while authenticated users can view only their assigned tasks and change their statuses. The system employs **advanced Blade template techniques** for better UI management and includes a cron job for sending email notifications about pending tasks.

### Key Features:
- **User Operations**:
  - **View Tasks**: Authenticated users can view their assigned tasks.
  - **Change Task Status**: Users can change the status of their tasks.

- **Admin Operations**:
  - **CRUD for Tasks**: Administrators can create, read, update, and delete tasks.
  - **Change Task Status**: Admins can change the status of any task.

- **Email Notifications**:
  - **Daily Pending Tasks Emails**: 
    - Admins receive an email with all pending tasks daily.
    - Users receive emails with details of their assigned pending tasks daily.

- **Advanced Blade Template Techniques**: Utilizes advanced techniques for better structure and reusability in views.

- **Cron Job**: 
  - Scheduled task for sending emails about pending tasks.

### Technologies Used:
- **Laravel 10**
- **PHP**
- **MySQL**
- **Laravel/UI**
- **XAMPP** 
- **Composer**

---

## Installation

### Prerequisites
- Ensure you have PHP, Composer, Node.js and MySQL installed.
- Set up a Laravel project using Composer.

### Steps to Run the Project:
1. Clone the repository:
   ```bash
   git clone https://github.com/TukaHeba/Cron_Job.git
   cd task-management-system
3. Install Dependencies
   ```bash
   composer install
4. Create Environment File
   ```bash
   cp .env.example .env
   Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Seed the Database
    ```bash
    php artisan db:seed
8. Install npm packages
    ```bash
    npm install
8. Run the 
    ```bash
    npm run dev
8. Run the Application
    ```bash
    php artisan serve
9. Navigate to http://127.0.0.1:8000/ in your browser.

---

## Cron Job
Cron job is used in this task management system to automate the sending of email notifications about pending tasks. It ensure that tasks are processed continuously by checking for any jobs in the queue that need to be executed. This automation helps keep users informed about their tasks without requiring manual intervention.

Here is a brief overview of the code involved:

- **Job Class:** The SendPendingTasksEmail job handles the logic of sending emails.
- **Console Command:** The SchedulePendingTasksEmail command dispatches the job to send pending task emails.
- **Mail Class:** The PendingTasksMail class formats the email to be sent, including the list of tasks and the recipient user

### Steps to Run the Job and Send the Emails:
1. Add your email address to the database either by using a seeder or manually. This will ensure that you receive notifications.
2. Open the app/Console/Kernel.php and edit the following line to make it run every minute to see the results
   ```bash
   $schedule->command('schedule:send-pending-tasks-email')->everyMinute();
3. Start the Queue Worker
   ```bash
   php artisan queue:work
4. Start the Schedule Worker
    ```bash
    php artisan schedule:work
