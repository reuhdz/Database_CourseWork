-- Homework 2 query statements

Use CPS3740_2018S;

Delimiter //
Create Function fHW2_1_hernareu(a varchar(8), b char(1))
Returns varchar(250)
Begin
Declare sal decimal;
Case b 
	When 'M' Then
		Select Min(salary) into sal From dreamhome.Staff where sex = b and branchno = a;
        If sal = 0 Then 
				return NULL;
			end if;
		return Concat('Male min salary at ', a, ' is: ', sal);
	When 'F' Then
		Select Max(salary) into sal From dreamhome.Staff where sex = b and branchno = a;
		If sal = 0 Then 
			return NULL;
		end if;
		return Concat('Female max salary at ', a, ' is: ', sal);
	Else
		return Concat('No such gender: ', b);
End Case;
End //
Delimiter ;

Drop function fHW2_1_hernareu;

-- Test Cases
-- 1A.
Select fHW2_1_hernareu('B004', 'A') as output;

-- 1B. 
Select fHW2_1_hernareu('B003', 'F') as output;

-- 1C. 
Select fHW2_1_hernareu('B003', 'M') as output;

-- 1D.
Select fHW2_1_hernareu('B009','M') as output;
























