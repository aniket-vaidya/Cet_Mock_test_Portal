# 📘 Online Test & Performance Analysis System

[![License](https://img.shields.io/badge/License-Apache_2.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)

An intelligent web-based platform designed to streamline exam preparation through detailed performance insights and interactive analytics.

[View Demo](#) | [Report Bug](https://github.com/aniket-vaidya/Cet_Mock_test_Portal/issues) | [Request Feature](https://github.com/aniket-vaidya/Cet_Mock_test_Portal/issues)

---

## 📝 Description

The **Online Test & Performance Analysis System** is a robust portal built using **PHP** and **MySQL**. It goes beyond simple testing by providing users with deep-dive analytics, including accuracy tracking, section-wise breakdowns, and visual progress reports. 

Whether for competitive exams or internal training, this system helps learners identify knowledge gaps and improve their scores through data-driven feedback.

---

## 🚀 Key Features

* 🔐 **Secure Authentication** – User registration and login with session management.
* 👥 **Role-Based Access** – Dedicated dashboards for Admins (manage tests) and Users (take tests).
* 📊 **Visual Analytics** – Interactive charts powered by **Chart.js** for performance trends.
* 📈 **Granular Analysis** – Section-wise accuracy and strength/weakness identification.
* 📘 **Instant Feedback** – Detailed question solutions provided post-test.
* 📄 **Exportable Reports** – Download performance summaries as PDF files.

---

## 🛠️ Tech Stack

| Component | Technology | Usage |
| :--- | :--- | :--- |
| **Backend** | PHP | Server-side logic & API handling |
| **Database** | MySQL | Relational data storage |
| **Frontend** | HTML5, CSS3, JS | Responsive UI components |
| **Charts** | Chart.js | Dynamic data visualization |
| **PDF** | FPDF / TCPDF | Report generation |

---

## ⚙️ Installation & Setup

Follow these steps to get your local development environment running:

1.  **Clone the Repository**
    ```bash
    git clone [https://github.com/aniket-vaidya/Cet_Mock_test_Portal.git](https://github.com/aniket-vaidya/Cet_Mock_test_Portal.git)
    ```
2.  **Prepare the Environment**
    - Move the project folder to your local server directory (e.g., `htdocs` for XAMPP).
    - Start **Apache** and **MySQL** via the XAMPP Control Panel.
3.  **Database Configuration**
    - Open `phpMyAdmin` and create a new database.
    - Import the provided `.sql` file from the `/database` folder.
    - Update `config.php` with your database credentials:
    ```php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "your_db_name";
    ```
4.  **Launch**
    - Navigate to `http://localhost/Cet_Mock_test_Portal` in your browser.

---

## 📊 Performance Workflow

1.  **Attempt:** User takes a timed or open-ended mock test.
2.  **Evaluate:** System processes answers against the database in real-time.
3.  **Analyze:** Logic calculates accuracy percentages and section scores.
4.  **Visualize:** Data is pushed to Chart.js to render performance graphs.

---

## 🛡️ Security Best Practices

To ensure data integrity, this project implements:
* **Prepared Statements:** To prevent SQL Injection attacks.
* **Password Hashing:** Utilizing `password_hash()` for secure credential storage.
* **Session Validation:** Protecting sensitive routes from unauthorized access.

---

## 📌 Future Roadmap

- [ ] ⏱️ **Advanced Timer:** Per-question time tracking.
- [ ] 🏆 **Global Leaderboard:** Compare scores with other students.
- [ ] 🤖 **AI Recommendations:** Suggest topics based on weak performance areas.
- [ ] 📱 **Mobile App:** Transition to a cross-platform mobile experience.

---

## 📄 License

Distributed under the **Apache License 2.0**. See `LICENSE` for more information.

---

## 👨‍💻 Author

**Aniket Vaidya**
* GitHub: [@aniket-vaidya](https://github.com/aniket-vaidya)
* LinkedIn: [@aniket-vaidya](www.linkedin.com/in/aniket-vaidya-75b270289)

---
*Developed with ❤️ for better learning.*
