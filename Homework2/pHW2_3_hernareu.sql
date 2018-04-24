use CPS3740_2018S;

Delimiter //
Create procedure pHW2_3_hernareu(IN a varchar(20), Out t varchar(250))
Begin
 Declare result varchar(250) Default NULL;
 If (a is Null or a = '') Then
 Select "Please input a valid city." into result;
 Set t = result;
 Else
	Select Group_Concat( Distinct guestname) into result From dreamhome.Guest where guestaddress like CONCAT('%', a ,'%');
	Set t = result;
    if(t is Not null) Then
		Select result;
	else
		Select concat("NO people found for city: ", a) into result;
        Set t = result;
	End IF;
 End IF;
    
End//

Delimiter ;

Drop procedure pHW2_3_hernareu;

-- Test Cases
-- 3A.
Call pHW2_3_hernareu(Null,@result);
Select @result;

Call pHW2_3_hernareu('',@result);
Select @result;

-- 3B.
Call pHW2_3_hernareu('London',@result);
Select @result;

-- 3C.
Call pHW2_3_hernareu('xyz',@result);
Select @result;











