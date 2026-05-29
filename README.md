# 🍽️ Restaurant Management System

A comprehensive full-stack restaurant management solution designed to streamline operations, manage inventory, handle orders, and optimize staff management.

## 📋 Overview

This project is a complete restaurant management system that helps restaurants automate their daily operations including order management, inventory tracking, staff scheduling, and customer relationship management.

## ✨ Features

- **Order Management** - Create, track, and manage customer orders
- **Inventory Management** - Real-time inventory tracking and stock management
- **Menu Management** - Organize and manage restaurant menu items
- **Staff Management** - Employee scheduling, roles, and performance tracking
- **Customer Management** - Customer profiles and order history
- **Reports & Analytics** - Generate insights on sales, inventory, and performance
- **User Authentication** - Secure login system with role-based access control
- **Dashboard** - Comprehensive admin dashboard with real-time updates
- **Receipt Generation** - Automated receipt printing and digital receipts

## 🛠️ Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: Python/Flask (or relevant backend framework)
- **Database**: SQL-based database
- **Additional**: RESTful APIs for seamless integration

## 📁 Project Structure

```
restaurant-management-system/
├── frontend/                 # Frontend files
│   ├── index.html           # Main page
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   └── assets/              # Images and other assets
├── backend/                 # Backend server
│   ├── app.py              # Main application
│   ├── models/             # Database models
│   ├── routes/             # API endpoints
│   ├── controllers/        # Business logic
│   └── requirements.txt    # Python dependencies
├── database/               # Database files
│   └── schema.sql         # Database schema
├── config/                # Configuration files
└── README.md              # This file
```

## 🚀 Installation

### Prerequisites
- Python 3.8 or higher
- SQL Database (MySQL/PostgreSQL)
- Node.js (optional, if using npm)
- pip (Python package manager)

### Backend Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/krishdani/Resturant-Mangement-System.git
   cd Resturant-Mangement-System
   ```

2. **Create a virtual environment**:
   ```bash
   python -m venv venv
   source venv/bin/activate  # On Windows: venv\Scripts\activate
   ```

3. **Install dependencies**:
   ```bash
   pip install -r backend/requirements.txt
   ```

4. **Configure database**:
   - Create a database for the application
   - Update `.env` with database credentials
   - Run migrations:
     ```bash
     python backend/app.py --migrate
     ```

5. **Start the backend server**:
   ```bash
   python backend/app.py
   ```
   The backend will be available at `http://localhost:5000`

### Frontend Setup

1. **Navigate to frontend folder** (if using a separate development server):
   ```bash
   cd frontend
   ```

2. **Open in browser**:
   - Simply open `index.html` in your web browser
   - Or use a local server:
     ```bash
     python -m http.server 8000
     ```
   - Visit `http://localhost:8000`

## 📖 Usage

### Admin Panel
- Access the admin dashboard to manage orders, inventory, and staff
- Generate reports and analytics
- Configure system settings

### Order Management
- Create new orders for customers
- Track order status in real-time
- Print receipts

### Inventory Management
- Monitor stock levels
- Set reorder alerts
- Track supplier information

### Staff Management
- Create and manage employee profiles
- Assign roles and permissions
- View performance metrics

## 🔧 Configuration

Create a `.env` file in the root directory with the following variables:

```env
# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_USER=your_username
DB_PASSWORD=your_password
DB_NAME=restaurant_db

# Server Configuration
SERVER_PORT=5000
DEBUG=True
SECRET_KEY=your_secret_key

# Email Configuration (for notifications)
EMAIL_HOST=smtp.gmail.com
EMAIL_PORT=587
EMAIL_USER=your_email@gmail.com
EMAIL_PASSWORD=your_email_password
```

## 📊 API Endpoints

### Orders
- `GET /api/orders` - Get all orders
- `POST /api/orders` - Create new order
- `GET /api/orders/:id` - Get order details
- `PUT /api/orders/:id` - Update order
- `DELETE /api/orders/:id` - Delete order

### Inventory
- `GET /api/inventory` - Get inventory items
- `POST /api/inventory` - Add inventory item
- `PUT /api/inventory/:id` - Update inventory
- `DELETE /api/inventory/:id` - Remove item

### Staff
- `GET /api/staff` - Get all staff members
- `POST /api/staff` - Add staff member
- `PUT /api/staff/:id` - Update staff
- `DELETE /api/staff/:id` - Remove staff

## 🔐 Security

- User authentication with encrypted passwords
- Role-based access control (RBAC)
- SQL injection prevention using prepared statements
- CORS configuration for API security
- Session management and timeout

## 🧪 Testing

Run tests to ensure everything is working correctly:

```bash
python -m pytest tests/
```

## 📈 Performance Optimization

- Database indexing for faster queries
- Caching mechanisms for frequently accessed data
- Lazy loading of components
- Optimized API responses

## 🤝 Contributing

Contributions are welcome! To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Verify database credentials in `.env`
   - Ensure database server is running
   - Check database name and permissions

2. **Port Already in Use**
   - Change `SERVER_PORT` in `.env`
   - Or kill the process using the port

3. **Missing Dependencies**
   - Run `pip install -r backend/requirements.txt`
   - Ensure Python version is 3.8+

4. **Frontend Not Loading**
   - Check if backend server is running
   - Clear browser cache
   - Verify API endpoints in JavaScript files

## 📝 License

This project is open source and available under the MIT License.

## 📞 Support

For issues, questions, or suggestions:
- Open an issue on [GitHub Issues](https://github.com/krishdani/Resturant-Mangement-System/issues)
- Contact the maintainers
- Check existing documentation

## 🎯 Roadmap

- [ ] Mobile app for staff (React Native)
- [ ] Advanced reporting and analytics
- [ ] Loyalty program integration
- [ ] Online ordering system
- [ ] Payment gateway integration
- [ ] Multi-location support
- [ ] AI-powered demand forecasting
- [ ] Cloud deployment ready

## 👨‍💻 Author

**krishdani** - [GitHub Profile](https://github.com/krishdani)

---

**Last Updated**: 2026-05-29

Built with ❤️ for restaurant management
