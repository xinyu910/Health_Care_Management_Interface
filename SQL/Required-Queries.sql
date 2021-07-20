-- Insertion Operation
-- process-insert-Appointment.php

INSERT INTO Appointments (AppointmentID, StartDateTime, EndDateTime, RoomNumber, PHN, DoctorID)
VALUES ('$appointmentID', '$startDateTime', '$endDateTime', '$roomNumber', '$PHN', '$ID');

INSERT INTO SymptomsIdentify (SymptomName, PHN)
VALUES ('$s', '$PHN');

INSERT INTO ConfirmationOfSymptomsInvolvedInAppointment (AppointmentID, SymptomName, PHN, NurseID)
VALUES ('$appointmentID', '$s', '$PHN', '$NurseID');



-- Deletion Operation
-- process-Delete-Doctor.php 

DELETE FROM Doctor WHERE DoctorID = '$id';


-- Update Operation
-- process-update-Doctor.php

update Doctor set DoctorID = '$ID' where DoctorID = '$id';

update Doctor set Name = '$Name' where DoctorID = '$id';

update Doctor set Age = '$Age' where DoctorID = '$id';

update Doctor set Gender = '$Gender' where DoctorID = '$id';

update Doctor set Specialization = '$Specialization' where DoctorID = '$id';



-- Selection 
-- process-filter-Appointment.php
SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D 
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID 
AND A.StartDateTime >='$formattedStartDate' AND A.EndDateTime <= '$formattedEndDate' 
AND A.RoomNumber IN ('$roomNumbers') AND A.PHN IN ('$PHNs') AND A.DoctorID IN ('$doctorIDs');

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName 
FROM Appointments A, Patients P, Doctor D 
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID
AND A.StartDateTime >='$formattedStartDate' 
AND A.RoomNumber IN ('$roomNumbers') AND A.PHN IN ('$PHNs') AND A.DoctorID IN ('$doctorIDs');
	
SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName 
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID
AND A.EndDateTime <= '$formattedEndDate' 
AND A.RoomNumber IN ('$roomNumbers') AND A.PHN IN ('$PHNs') AND A.DoctorID IN ('$doctorIDs');

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName 
FROM Appointments A, Patients P, Doctor D 
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID
AND A.RoomNumber IN ('$roomNumbers') AND A.PHN IN ('$PHNs') AND A.DoctorID IN ('$doctorIDs');



-- Projection
-- process-projection-Appointment.php 

SELECT $string, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID;



-- Join Query
-- Appointment-Join-Name.php 

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID;


-- Aggregation Query
-- process-aggregation-MedicalExam.php

SELECT SUM(Price) AS Cost FROM MedicalExamFee WHERE Type IN ('$ids');



-- Nested Aggregation with Group by
-- process-nested-aggregation-appointment.php

SELECT D.DoctorID, D.Name
FROM Doctor D WHERE D.DoctorID IN (SELECT A.DoctorID 
                                 FROM Appointments A
                                 GROUP BY A.DoctorID 
                          HAVING COUNT(A.StartDateTime > '$formattedStartDate') <= '$maxAppointmentNumber';



-- Division Query
-- process-division.php

SELECT DISTINCT M.Type
FROM MedicalExamsIncludedIn M
WHERE NOT EXISTS (
(SELECT C.PHN FROM ConfirmationOfSymptomsInvolvedInAppointment C WHERE C.SymptomName = '$symptom') 
EXCEPT (SELECT CO.PHN FROM MedicalExamsIncludedIn ME, confirmationofsymptomsinvolvedinappointment CO 
WHERE ME.AppointmentID = CO.AppointmentID AND ME.Type = M.Type));