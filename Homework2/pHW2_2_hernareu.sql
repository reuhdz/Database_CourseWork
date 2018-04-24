use CPS3740_2018S;

Delimiter //
Create Procedure pHW2_2_hernareu(a CHAR(20)) 
Begin
If (a is NULL or a = '') Then
Select "Please input a valid hotel name." as message;
Else 
Select r.type, count(b.roomno) 
From dreamhome.Room r, dreamhome.Booking b 
Where r.hotelno = (Select hotelno From dreamhome.Hotel where hotelname = a) and r.roomno = b.roomno 
Group by  r.type;
End IF;
END //

Delimiter ;

Drop procedure pHW2_2_hernareu;

-- Test Cases
-- 2A.
Call pHW2_2_hernareu('Grosvenor');

-- 2B. 
Call pHW2_2_hernareu(NULL);
Call pHW2_2_hernareu('');
