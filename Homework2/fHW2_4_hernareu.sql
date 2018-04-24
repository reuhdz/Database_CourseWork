use CPS3740_2018S;

Delimiter //
Create Function fHW2_4_hernareu(a varchar(250))
Returns varchar(250)
Begin  
DECLARE names varchar(250) DEFAULT NULL;
If (a is Null or a = '') Then
 Return 'Please input a valid city';
 Else
	Select Group_Concat( Distinct guestname) into names From dreamhome.Guest where guestaddress like CONCAT('%', a ,'%');
    if(names is Not null) Then
		Return names;
	else
		Return 'No results found';
	End IF;
 End IF;

End //

Delimiter ;

Drop function fHW2_4_hernareu;

-- Test Cases
-- 4A.
select fHW2_4_hernareu('London') as output;

-- 4B.
select fHW2_4_hernareu('') as output;
select fHW2_4_hernareu(NULL) as output;

-- 4C.
select fHW2_4_hernareu('Union') as output;