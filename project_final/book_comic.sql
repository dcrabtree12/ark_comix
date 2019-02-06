drop database if exists book_comic;
create database if not exists book_comic;
use book_comic;

create table books (
	book_id int unsigned auto_increment,
    book_categories nvarchar(40),
    book_message nvarchar(300),
    primary key (book_id)
);

# Book categories users select from sign-up form.
insert into books (book_categories, book_message)
values ('None', ''),
	   ('Fiction', 'There will be more books for children soon!'),
	   ('Non-Fiction', 'Bring your history books to our store for a discount on all items.'),
       ('Art', 'Craft show will be featured near our store.'),
       ('Mystery', 'Suspense novel coming soon.'),
       ('Action', 'Star Wars collection will be on sale.'),
       ('Romance', 'Romeo and Juliet novels will be featured throughout the end of the month.'),
       ('Horror','The Halloween novel sale is over.'),
       ('Poetry', 'Shakespeare poems are out of stock.');

create table comics (
	comic_id int unsigned auto_increment,
    comic_categories nvarchar(40),
    comic_message nvarchar(300),
    primary key (comic_id)
);

create table categories (
	book_id int unsigned, # Foreign key
    comic_id int unsigned, # Foreign key
    categories nvarchar(40)
);

select * from categories;
insert into categories (book_id, comic_id, categories)

values ('','','');

# Comic categories users select from sign-up form.
insert into comics (comic_categories, comic_message)
values ('None', ''),
	   ('Marvel','Stan Lee will be here the 30th for autographs.'),
       ('DC','Justice League coming to stores soon.'),
       ('Both','All Comics for sale will recieve free shipping.');

create table users (
    user_id int unsigned auto_increment,
	book_id int unsigned, # Foreign key
    comic_id int unsigned, # Foreign key
    first_name nvarchar(40),
    last_name nvarchar(40),
    email TEXT,
    email_password TEXT,
    #date_created datetime default current_timestamp,
    #last_updated timestamp,
	foreign key (book_id) references books (book_id)
		on delete set null,
	foreign key (comic_id) references comics (comic_id)
		on delete set null,
    primary key (user_id)
);

# local variables
set @bookId = (select book_id from books where book_message = 'There will be more books for children soon!');
#set @bookMessage = (select book_id from books where book_message = 'There will be more books for children soon!');
set @comicId = (select comic_id from comics where comic_message = 'Stan Lee will be here the 30th for autographs.');
#set @comicMessage = (select comic_id from comics where comic_message = 'Stan Lee will be here the 30th for autographs.');

insert into users (
	comic_id,
    book_id,
	first_name,
    last_name,
	email,
    email_password)
values (@bookId, @comicId,'Dayla', 'Crabtree', 'example@gmail.com', 'password');

create table membership (
	membership_id int unsigned auto_increment,
    user_id int unsigned, # Foreign key
    discount INT NOT NULL,
    upcomingSales INT NOT NULL,
    recentRelease nvarchar(40),
    foreign key (user_id) references users (user_id)
		on delete set null,
    primary key (membership_id)
);

insert into membership (upcomingSales, discount, recentRelease)

values (10, 10.00, 'Book1'),
	   (30, 50.00, 'Comic'),
       (5, 15.00, 'Book2'),
       (20, 100.00, 'Book3');

create table products (
	product_id int unsigned auto_increment,
    image_id int unsigned, # Foreign key
	productName nvarchar(60),
    price INT NOT NULL,
    description nvarchar(400),
    image longblob,
    quantity int(10) unsigned DEFAULT NULL,
	primary key (product_id)
);

create table images(
	image_id int unsigned not null auto_increment primary key,
    product_id int unsigned,
    filename varchar(255),
    image_type varchar(100),
    image_data longblob,
    foreign key (product_id) references products (product_id)
		on delete set null
);

# join both tables to get data
select * from products p join images i on i.image_id = p.image_id;

insert into products (product_id, productName, price, description, image)

values (1,'Batman',  130.00, 'Special First issue Batman comic.', './images/products/batman.png'),
	   (2,'Mummys', 20.00, 'A book about mumification process and history of King Tut.', './images/products/batman.png'),
	   (3,'The Sacrifice and Other Steam Powered Stories', 50.00, 'Has multiple stories from the Valve company with rifiting artwork.', './images/products/steam.jpg'),
       (4,'Test', 50.00, 'Has multiple stories from the Valve company with rifiting artwork.', './images/products/steam.jpg'),
       (5,'The', 50.00, 'Has multiple stories from the Valve company with rifiting artwork.', './images/products/steam.jpg'),
       (6,'The Sacrifice', 50.00, 'Has multiple stories from the Valve company with rifiting artwork.', './images/products/steam.jpg'),
       (7,'Other', 50.00, 'Has multiple stories from the Valve company with rifiting artwork.', './images/products/steam.jpg'),
       (8,'Calvin and Hobbes', 30.00, 'Description', './images/products/calvin_and_hobbes.png');

create table store (
	store_id int unsigned auto_increment,
    product_id int unsigned,
    image_id  int unsigned,
    #membership_id int unsigned, # Foreign key
   
	#foreign key (membership_id) references membership (membership_id)
		#on delete set null,
    primary key (store_id)
);

insert into store (store_id, product_id, image_id)

values (store_id, product_id, image_id);

show tables;

# Columns for Tables
show columns from books;
show columns from comics;
show columns from users;
show columns from membership;
show columns from products;
show columns from store;

# Select Statements
select * from books;
select * from comics;
select * from users;
select * from membership;
select * from images;
select * from products;
select * from store;
