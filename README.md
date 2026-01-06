# Web Cinema - Movie Ticket Booking System

A comprehensive web-based movie ticket booking platform with AI-powered chatbot, multiple payment gateways, and complete admin management system.

## 📋 Table of Contents

1. [Project Overview](#project-overview)
2. [Features](#features)
3. [Technology Stack](#technology-stack)
4. [Installation & Setup](#installation--setup)
5. [Development Environment](#development-environment)
6. [Database Schema](#database-schema)
7. [API Documentation](#api-documentation)
8. [Testing](#testing)
9. [Deployment](#deployment)
10. [Contributing](#contributing)

## 🎯 Project Overview

Web Cinema is a modern movie ticket booking platform that allows users to:
- Browse movies currently showing and coming soon
- Book tickets with seat selection
- Make payments via multiple gateways (VNPay, MoMo)
- Interact with AI-powered chatbot for movie recommendations
- Manage bookings and user profiles
- Admin panel for movie and user management

## ✨ Features

### User Features
- **Movie Browsing**: View current and upcoming movies with detailed information
- **Seat Selection**: Interactive seat map with real-time availability
- **Payment Processing**: Multiple payment options (VNPay, MoMo)
- **AI Chatbot**: Get movie recommendations and booking assistance
- **User Authentication**: Secure login and registration system
- **Booking History**: Track and manage past bookings

### Admin Features
- **Movie Management**: Add, edit, delete movie information
- **User Management**: Manage user accounts and permissions
- **Booking Oversight**: Monitor and manage all bookings
- **Analytics Dashboard**: View system statistics and reports

## 🛠 Technology Stack

### Backend
- **Framework**: CodeIgniter 3.x
- **Language**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Server**: Apache/Nginx

### Frontend
- **HTML5**: Semantic markup and structure
- **CSS3**: Responsive design with Bootstrap
- **JavaScript**: jQuery for interactivity
- **AJAX**: Asynchronous data loading

### AI Integration
- **Google Gemini AI**: Primary AI service for chatbot
- **Context Injection**: Real-time data integration
- **Prompt Engineering**: Intelligent response generation

### Payment Gateways
- **VNPay**: Vietnamese payment gateway
- **MoMo**: Mobile money payment service

### Additional Services
- **Cloudinary**: Image storage and optimization
- **Composer**: PHP dependency management

## 📦 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)

### Local Development Setup

1. **Clone Repository**
   ```bash
   git clone https://github.com/your-username/web-cinema.git
   cd web-cinema
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Database Setup**
   ```bash
   # Import database schema
   mysql -u root -p < Database/movie_ticket_db.sql

   # Import additional tables if needed
   mysql -u root -p < Database/add_foreign_key_payment_tables.sql
   ```

4. **Configuration**
   ```bash
   # Copy configuration files
   cp application/config/database.php.example application/config/database.php

   # Edit database configuration
   nano application/config/database.php
   ```

5. **Web Server Configuration**
   - Ensure Apache/Nginx is configured to serve from project root
   - Enable mod_rewrite for clean URLs
   - Set proper file permissions

6. **Access Application**
   - Open browser and navigate to `http://localhost/web-cinema`
   - Admin panel: `http://localhost/web-cinema/admin`

## 💻 Development Environment and Tools

### 3.1.1 Hardware Requirements

#### Development Machines
- **Minimum Requirements**: Computers or laptops capable of handling web design and development tasks
- **RAM**: At least 8GB RAM recommended for running local servers and IDEs simultaneously
- **Processor**: Multi-core processor (Intel i5/AMD Ryzen 5 or higher)
- **Storage**: 256GB SSD minimum for faster loading and better performance

#### Display
- **Resolution**: Screens with standard resolution (1920x1080 or higher) to test responsive design
- **Multiple Monitors**: Recommended for simultaneous coding and testing

### 3.1.2 Software and Tools

#### Web Server Environment
- **XAMPP/AppServ**: Local web server environment providing:
  - Apache HTTP Server for hosting web applications
  - PHP runtime environment for server-side scripting
  - MySQL database server for data storage and retrieval
  - phpMyAdmin for database management interface
- **Purpose**: Testing and debugging the application before deployment to production

#### Database Management System
- **MySQL**: Relational database management system selected for:
  - Storing user accounts and authentication data
  - Managing movie information and metadata
  - Handling booking transactions and seat reservations
  - Supporting efficient data retrieval and querying operations

#### Integrated Development Environment (IDE)
- **Visual Studio Code**: Primary code editor featuring:
  - Syntax highlighting for PHP, HTML, CSS, JavaScript, and SQL
  - Integrated terminal for running commands
  - Extension support for enhanced development workflow
  - Git integration for version control
- **Alternative Tools**: Sublime Text, Atom, or PhpStorm

#### Frameworks & Libraries

##### Backend Framework
- **CodeIgniter Framework**: PHP-based MVC framework providing:
  - Model-View-Controller architectural pattern
  - Built-in security features and input validation
  - Database abstraction and query builder
  - Session management and user authentication
  - URL routing and clean URL structure

##### Frontend Technologies
- **HTML5**: Semantic markup and structure
- **CSS3**: Styling and responsive design with media queries
- **JavaScript**: Client-side interactivity and dynamic content
  - **jQuery**: DOM manipulation and AJAX requests
  - **Bootstrap**: Responsive grid system and UI components

#### Additional Development Tools

##### Version Control
- **Git**: Distributed version control system
- **GitHub/GitLab**: Remote repository hosting and collaboration

##### API Testing
- **Postman**: REST API testing and documentation
- **Browser Developer Tools**: Built-in debugging and testing

##### Image Processing
- **Cloudinary**: Cloud-based image storage and manipulation service

### 3.1.3 Development Workflow

#### Local Development Setup
1. Install XAMPP/AppServ on development machine
2. Clone project repository from Git
3. Import database schema from SQL files
4. Configure database connection settings
5. Start Apache and MySQL services
6. Access application via localhost

#### Testing Environment
- **Unit Testing**: PHPUnit for backend testing
- **Browser Testing**: Cross-browser compatibility testing
- **Mobile Testing**: Responsive design testing on various devices
- **Performance Testing**: Load testing and optimization

#### Production Deployment
- **Web Hosting**: Shared/VPS hosting with PHP and MySQL support
- **Domain Configuration**: DNS setup and SSL certificate installation
- **Database Migration**: Production database setup and data migration
- **Environment Configuration**: Production-specific settings and optimizations

## 🗄️ Database Schema

### Core Tables
- **users**: User account information
- **movies**: Movie details and metadata
- **bookings**: Ticket booking records
- **calendar**: Show schedules and pricing
- **rooms**: Cinema room information

### Payment Tables
- **momo**: MoMo payment transactions
- **vnpay**: VNPay payment transactions

### Additional Tables
- **comments**: User comments on movies
- **comment_sentiment**: AI-generated sentiment analysis

## 🔌 API Documentation

### Chatbot API
- **Endpoint**: `/chatbot/chat`
- **Method**: POST
- **Purpose**: Handle AI chatbot conversations

### Payment APIs
- **VNPay Integration**: Secure payment processing
- **MoMo Integration**: Mobile wallet payments

## 🧪 Testing

### Manual Testing
- User interface testing across different browsers
- Payment flow validation
- Booking process verification

### Automated Testing (Future Implementation)
- Unit tests for models and controllers
- Integration tests for payment flows
- UI automation tests

## 🚀 Deployment

### Production Requirements
- **Web Server**: Apache/Nginx with PHP-FPM
- **Database**: MySQL 5.7+ or MariaDB 10.0+
- **SSL Certificate**: HTTPS enforcement
- **Domain**: Registered domain name

### Deployment Steps
1. Upload files to production server
2. Configure production database
3. Set up environment variables
4. Configure web server
5. Test all functionality
6. Enable SSL certificate

## 🤝 Contributing

### Development Guidelines
1. Follow PSR coding standards
2. Use meaningful commit messages
3. Create feature branches for new developments
4. Submit pull requests for code review

### Code Style
- Use 4 spaces for indentation
- Follow CodeIgniter naming conventions
- Add PHPDoc comments for functions and classes

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

**Web Cinema** - Bringing cinema experience to your fingertips! 🎬


