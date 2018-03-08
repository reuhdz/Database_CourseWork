/* Problem 1 */
Create view vHW1_1_hernareu as
SELECT fname, position
FROM CPS3740.Staff
Where sex = 'F' AND salary > 15000;

/* Problem 2 */
CREATE view vHW1_2_hernareu as
SELECT city, postcode
FROM CPS3740.Branch
WHERE street LIKE '%ee%'
ORDER BY city;

/* Problem 3 */
CREATE view vHW1_3_hernareu as
SELECT Count(branchNo) as Number_Of_Staff 
FROM CPS3740.Staff s
WHERE branchNo IN (SELECT branchNo FROM CPS3740.Branch WHERE  s.branchNo = Branch.branchNo and city LIKE '%London%');

/* Problem 4 */ 
CREATE view vHW1_4_hernareu as 
SELECT Hotel.hotelname, Room.price
FROM CPS3740.Hotel, CPS3740.Room
WHERE CPS3740.Hotel.hotelno = CPS3740.Room.hotelno and CPS3740.Room.price = (SELECT min(price) FROM CPS3740.Room)
GROUP BY CPS3740.Hotel.hotelname;

/* Problem 5 (Self Join)*/
CREATE view vHW1_5_hernareu as
SELECT e.fname as Staff_Name, e.position as position1, m.fname as Manager_Name, m.position as position2 
FROM CPS3740.Staff e, CPS3740.Staff m
WHERE e.managerno = m.staffno AND e.sex = 'M';

/* Problem 6 */
CREATE view vHW1_6_hernareu as
SELECT city, count(city) 
FROM CPS3740.Branch b, CPS3740.Staff s
WHERE b.branchNo = s.branchNo
GROUP BY b.branchNo			--Using b.city gives you the wrong count
HAVING count(s.branchNo) > 1;

/* Problem 7 */
--4 tables, 3 joining conditions
CREATE view vHW1_7_hernareu as
SELECT g.guestname, h.hotelname, DATEDIFF(b.dateto, b.datefrom) as Number_of_Days, r.price * DATEDIFF(b.dateto, b.datefrom) as amount
FROM CPS3740.Booking b , CPS3740.Guest g, CPS3740.Hotel h, CPS3740.Room r
WHERE b.guestno = g.guestno AND b.dateto IS NOT NULL AND b.hotelno = h.hotelno AND r.hotelno = h.hotelno
GROUP BY Number_of_Days;

/* Problem 8 */
CREATE table Customers_hernareu (
	id int NOT NULL AUTO_INCREMENT,
	name varchar(25) NOT NULL,
	balance float NOT NULL,
	zip varchar(7) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(zip) REFERENCES CPS3740.Zipcode(zipcode));

/* Problem 9 */
INSERT INTO  Customers_hernareu (id, name, balance, zip)
VALUES (1, 'Bob', 10, '07001');

INSERT INTO  Customers_hernareu (name, balance, zip)
VALUES ('Tom', 27, '07005');

INSERT INTO  Customers_hernareu (name, balance, zip)
VALUES ('Grace', 91, '07029');

INSERT INTO  Customers_hernareu (name, balance, zip)
VALUES ('Stacy', 100, '07110');
