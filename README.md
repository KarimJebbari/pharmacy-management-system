# Pharmacy Management System

A pharmacy management system developed with Laravel, MySQL, Bootstrap, CSS, and a bit of AJAX. 
The system allows pharmacists to manage medications, monitor stock and expiration, and handle customer orders efficiently.


## Key Features

- Pharmacist login page to manage medications.
- Real-time display of medications in the customer purchase page.
- Customers can send purchase requests that appear directly for the pharmacist.
- Alerts for medications nearing expiration.
- Ability to create awareness articles for customers about diseases and proper medications.
- Automated email requests to suppliers when medication stock runs out.

### Pharmacist Dashboard

This is the first page that appears after the pharmacist logs in.  
It provides a complete overview of the medications previously added by the pharmacist and allows the following actions:

- View the list of all medications.
- Edit or delete any medication.
- See alerts for medications that are expiring soon (within 30 days or less).
- Use the search bar to quickly find medications by name or price.

![Pharmacist Dashboard Screenshot](docs/screenshots/dashboard.png)
![Pharmacist Update Screenshot](docs/screenshots/update.png)

### Orders Management Page

This page allows the pharmacist to view and manage all the medication orders sent by customers.  
Each order contains detailed information, including:

- The customer’s full name, address, and phone number.  
- The list of ordered medications.  
- A required medical prescription (for controlled or dangerous medications).  
- The possibility for the pharmacist to **accept** or **reject** the order after contacting the customer.

Once an action is taken, the order status is updated accordingly in the system.

![Orders Management Screenshot](docs/screenshots/orders.png)
