# Car Rental

Simple car rental booking web

# Installation

```sh
docker-compose up -d
```

## PHPMYADMIN

link: [phpmyadmin](http://localhost:8081).

### Requirements
- Login and register feature, store the user information to the database.
- After logged in, the UI will show options which are: choose vehicle and add feedback
- If the user choose add feedback, it will take the user to two options, either complaint or suggestion. If any is pressed, show a text box to allow the user to write feedback. And the feedback can be displayed when the renter view vehicles.
- If the user choose on vehicle, a bunch of vehicle will be displayed (it's dummy but they need to be powered either using clean energy or electrical enery like: Tesla, Scooters, or any other options)
- After the user press checkout, it will navigate to checkout page to calculate total cost and show payment options
- Payment options: "pay online" or "pay cash"
- Then display the receipt that has total amount and info about the choosen vehicle

### TODO
- [x] Init environment
- [ ] Design database
- [x] Home page
- [x] Login page & validation
- [ ] Register page & validation
- [ ] Onboarding page: rent or feedback
- [ ] List of all cars
- [ ] Check availability page
- [ ] Checkout page
- [ ] Generate invoice
- [ ] Feedback page
