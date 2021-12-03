CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `province` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `parks_info` (
  `name` mediumtext NOT NULL,
  `puppies` tinyint(1) NOT NULL,
  `description` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` text NOT NULL,
  `province` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avgrating` tinyint(4) NOT NULL,
  `latitude` DECIMAL(18,12) NOT NULL,
  `longitude` DECIMAL(18,12) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `reviews` (
  `parkid` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` mediumtext NOT NULL,
  `rating` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`parkid`)
    REFERENCES parks_info(`id`)
    ON DELETE CASCADE,
  FOREIGN KEY (`userid`)
    REFERENCES users(`id`)
    ON DELETE CASCADE
);

INSERT INTO users (id, name, email, password, address, phone, province, dateofbirth)
VALUES 
  (1, 'George Santos', 'george@santos.com', '$2y$10$6gk4WhMz8l2fvJN.zisH9uM1tSLwAFEqlzrwaw8ulzKp2jrYyqJia', '1280 Main St W, Hamilton', '111-222-3333', 'Ontario', '1998-08-05'),
  (2, 'Michelle Trudeau', 'michellet@gmail.com', '$2y$10$6gk4WhMz8l2fvJN.zisH9uM1tSLwAFEqlzrwaw8ulzKp2jrYyqJia', '1151 Richmond St, London', '111-222-3345', 'Ontario', '1998-03-15'),
  (3, 'Barack Buffet', 'bbuffet@outlook.com', '$2y$10$577K0a1hKbDg41P552ywnuLpehar68oAxwGVBw8550Z5gWWx8OrY2', '75 University Ave W, Waterloo', '111-222-3353', 'Ontario', '1998-02-25'),
  (4, 'Sebastian Colin', 'sebacolin@outlook.com', '$2y$10$4d81HQs//ft5oOukX8xZAuTE8cmVlTHw4ekIercwTTL5AmkzwJJ0y', '200 University Ave W, Waterloo', '289-456-8596', 'Ontario', '2000-01-01'),
  (5, 'James Irving', 'jamesharden123@nets.com', '$2y$10$AOElXmmLgXgzh1/38pF4Suh1r2TFHcZorOnzGcm5O/rf9/PILoTsa', '40 Bay St., Toronto', '289-456-2354', 'Ontario', '1988-02-12');

INSERT INTO parks_info (name, puppies, description, address, city, province, id, avgrating, latitude, longitude)
VALUES
  ('Ajax Dog Park', 1, 'Dog park in Ajax that accepts puppies!', 'Shaw, Westney Northbound', 'Ajax', 'Ontario', 1, 4.5, 43.83396, -79.03352),
  ('Oshawa Dog Park', 1, 'Dog park in Oshawa that accepts puppies!', '915 Grandview St N', 'Oshawa', 'Ontario', 2, 4, 43.928708, -78.834234),
  ('Burlington Dog Park', 0, 'Dog park in Burlington that does not accept puppies.', '1800 King Rd', 'Burlington', 'Ontario', 3, 0, 41.831942, -103.671447),
  ('Milton Dog Park', 0, 'Dog park in Milton that does not accept puppies.', '230 Cedar Hedge Rd', 'Milton', 'Ontario', 4, 3, 38.706304, -85.317687),
  ('Oakville Dog Park', 1, 'Dog park in Oakville that accepts puppies!', 'Sherwood Heights Dr', 'Oakville', 'Ontario', 5, 0, 43.502967, -79.668193),
  ('Mississauga Dog Park', 1, 'Dog park in Mississauga that accepts puppies!', '2715 Meadowvale Blvd', 'Mississauga', 'Ontario', 6, 3, 43.607812, -79.773392),
  ('Brampton Dog Park', 0, 'Dog park in Brampton that does not accept puppies.', '1030 Williams Pkwy', 'Brampton', 'Ontario', 7, 0, 43.717576, -79.749628),
  ('Hamilton Dog Park', 0, 'Dog park in Hamilton that does not accept puppies.', '297 First Rd W, Hamilton', 'Hamilton', 'Ontario', 8, 0, 31.70311, -98.125599),
  ('Markham Dog Park', 1, 'Dog park in Markham that accepts puppies!', 'Markham Road and, Steeles Ave E', 'Markham', 'Ontario', 9, 5, 43.836523, -79.251242),
  ('Orangeville Dog Park', 1, 'Dog park in Orangeville that accepts puppies!', '673067 Hurontario St', 'Orangeville', 'Ontario', 10, 2, 43.953195, -80.088803);

INSERT INTO reviews (parkid, title, description, rating, id, userid)
VALUES
  (1, 'Great park for puppies', 'My puppy had lots of fun.', 4, 1, 1),
  (1, 'Awesome park for puppies', 'Nice view.', 5, 2, 2),
  (2, 'Best park out there', 'Allows puppies!', 5, 3, 1),
  (2, 'Average park', 'Nothing special.', 3, 4, 2),
  (4, 'Good, wish they allowed puppies', 'See title.', 4, 5, 3),
  (4, 'Aggresive dogs', 'Avoid at all costs.', 2, 6, 4),
  (6, 'Great park for puppies', 'My puppy had lots of fun.', 5, 7, 3),
  (6, 'Terrible park for puppies', 'Bad view.', 1, 8, 4),
  (9, 'Best park out there', 'Allows puppies!', 5, 9, 5),
  (10, 'Average park', 'Nothing special.', 2, 10, 5);


