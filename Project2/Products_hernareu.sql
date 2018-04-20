use CPS3740_2018S;

Create table Products_hernareu (
	id int AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    sell_price float NOT NULL,
    cost float NOT NULL,
    quantity int NOT NULL,
    user_id int NOT NULL,
    vendor_id int NOT NULL,
    primary key(id),
    foreign key (user_id) references CPS3740.Users(id),
    foreign key (vendor_id) references CPS3740.Vendors(V_Id)
);

insert into Products_hernareu (name, description, sell_price, cost, quantity,user_id, vendor_id) 
Values ('Tom Sawyer', 'book', 17, 4, 1902, 9, 1008);

Drop table Products_hernareu;

Select * From Products_hernareu;