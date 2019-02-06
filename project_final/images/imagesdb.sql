create database if not exists imagesdb;
use imagesdb;

create table images(
	image_id int unsigned not null auto_increment primary key,
    filename varchar(255),
    image_type varchar(100),
    image_data longblob
);

create table user_products (
	user_product_id int unsigned auto_increment,
    user_image_id int unsigned, # Foreign key
	productName nvarchar(60),
    price INT NOT NULL,
    description nvarchar(400),
    quantity int(10) unsigned DEFAULT NULL,
    foreign key (user_image_id) references images (user_image_id)
		on delete set null,
	primary key (user_product_id)
);
