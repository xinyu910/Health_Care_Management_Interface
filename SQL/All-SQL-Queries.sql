-- Aggregation-MedicalExam.php
select Type from MedicalExamFee;

-- Appointment-Join-Name.php 

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID;

-- Appointment-Join-Symptom-Nurse-No-Name.php

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, C.SymptomName AS Symptom, 
N.NurseName, N.NurseID
FROM Appointments A, ConfirmationOfSymptomsInvolvedInAppointment C, Nurses N
WHERE A.PHN = C.PHN AND A.AppointmentID = C.AppointmentID AND C.NurseID = N.NurseID;

-- Appointment-Join-Symptom-Nurse.php

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, 
P.Name AS PatientName, D.Name AS DoctorName, C.SymptomName AS Symptom, N.NurseName, N.NurseID
FROM Appointments A, ConfirmationOfSymptomsInvolvedInAppointment C, Nurses N, Doctor D, Patients P
WHERE A.PHN = C.PHN AND A.AppointmentID = C.AppointmentID AND C.NurseID = N.NurseID AND A.PHN = P.PHN AND A.DoctorID = D.DoctorID;

-- Appointment.php (view the appointments)

SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID;

-- delete-Appointment.php (delete the appointments)
select AppointmentID from Appointments;

-- delete-Doctor.php (view Doctors to delete)

select DoctorID from Doctor;

-- division.php (view current symptoms)

select DISTINCT SymptomName from SymptomsIdentify;

-- Doctor.php (view Doctors)

SELECT *FROM Doctor;

-- Filter-Appointment.php 

select DISTINCT RoomNumber from Room;

select DISTINCT PHN, Name from Patients;

select DISTINCT DoctorID, Name from Doctor;

-- insert-Appointment.php

select DISTINCT RoomNumber from Room;

select DISTINCT PHN, Name from Patients;

select DISTINCT DoctorID, Name from Doctor;

select NurseID, NurseName from Nurses;


-- insert-MedicalExamRecord.php

select AppointmentID from Appointments;

select Type from MedicalExamFee;

-- MedicalExamRecord.php

SELECT * FROM MedicalExamsIncludedIn;

-- MedicalExams.php

SELECT * FROM MedicalExamFee;

-- Patients.php

SELECT * FROM Patients P, Students S WHERE P.PHN = S.StudentPHN;

SELECT * FROM Patients P, FacultyStaff F WHERE P.PHN = F.FacultyPHN;

SELECT * FROM Patients P, GeneralPublic G WHERE P.PHN = G.PublicPHN;

-- process-aggregation-MedicalExam.php

SELECT SUM(Price) AS Cost FROM MedicalExamFee WHERE Type IN ('$ids');

-- process-delete-Appointment.php
SELECT C.SymptomName, C.PHN 
FROM ConfirmationOfSymptomsInvolvedInAppointment C, Appointments A 
WHERE A.AppointmentID = '$id' AND C.AppointmentID = '$id'
AND C.PHN = A.PHN;

SELECT C.SymptomName, C.PHN FROM ConfirmationOfSymptomsInvolvedInAppointment C, Appointments A
WHERE C.AppointmentID = A.AppointmentID AND C.PHN = '$PHN' AND C.SymptomName = '$s' AND C.AppointmentID <> '$id';

DELETE FROM SymptomsIdentify WHERE SymptomName = '$s' AND PHN = '$PHN';

DELETE FROM appointments WHERE AppointmentID = '$id';

-- process-Delete-Doctor.php 

DELETE FROM Doctor WHERE DoctorID = '$id';

-- process-Delete-Faculty.php 
-- process-Delete-Public.php 
-- process-Delete-Student.php 

DELETE FROM Patients WHERE PHN = '$id';

-- process-delete-MedicalExam.php

DELETE FROM MedicalExamFee WHERE Type = '$id';

-- process-delete-MedicalExamRecord.php 

DELETE FROM MedicalExamsIncludedIn WHERE TestID = '$id';


-- process-division.php

SELECT DISTINCT M.Type
FROM MedicalExamsIncludedIn M
WHERE NOT EXISTS (
(SELECT C.PHN FROM ConfirmationOfSymptomsInvolvedInAppointment C WHERE C.SymptomName = '$symptom') 
EXCEPT (SELECT CO.PHN FROM MedicalExamsIncludedIn ME, confirmationofsymptomsinvolvedinappointment CO 
WHERE ME.AppointmentID = CO.AppointmentID AND ME.Type = M.Type));


-- process-filter-Appointment.php
SELECT RoomNumber FROM Room;

SELECT PHN FROM Patients;

SELECT DoctorID FROM Doctor;

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

-- process-insert-Appointment.php
INSERT INTO Appointments (AppointmentID, StartDateTime, EndDateTime, RoomNumber, PHN, DoctorID)
VALUES ('$appointmentID', '$startDateTime', '$endDateTime', '$roomNumber', '$PHN', '$ID');

INSERT INTO SymptomsIdentify (SymptomName, PHN)
VALUES ('$s', '$PHN');

SELECT * FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$s'

INSERT INTO ConfirmationOfSymptomsInvolvedInAppointment (AppointmentID, SymptomName, PHN, NurseID)
VALUES ('$appointmentID', '$s', '$PHN', '$NurseID');

-- process-insert-Doctor.php 

INSERT INTO Doctor (DoctorID, Name, Age, Gender, Specialization)
VALUES ('$DoctorID', '$Name', '$Age', '$Gender', '$Specialization');
INSERT INTO Doctor (DoctorID, Name, Gender, Specialization)
VALUES ('$DoctorID', '$Name', '$Gender', '$Specialization');

-- process-insert-Faculty.php 

INSERT INTO Patients (PHN, Name, Gender, Address, PhoneNumber, Age)
VALUES ('$PHN', '$Name', '$Gender', '$Address', '$PhoneNumber', '$Age');

INSERT INTO Patients (PHN, Name, Gender, Address, Age)
VALUES ('$PHN', '$Name', '$Gender', '$Address', '$Age');

INSERT INTO FacultyStaff (FacultyPHN, FacultyNumber) VALUES ('$PHN','$Faculty')

-- process-insert-MedicalExam.php 

INSERT INTO MedicalExamFee (Type, Price)
VALUES ('$Type', '$Price');


-- process-insert-MedicalExamRecord.php

INSERT INTO MedicalExamsIncludedIn (TestID, AppointmentID, Results, Type)
VALUES ('$ExamID', '$AppointmentID', '$Result', '$Type');


-- process-insert-Public.php

INSERT INTO Patients (PHN, Name, Gender, Address, PhoneNumber, Age)
VALUES ('$PHN', '$Name', '$Gender', '$Address', '$PhoneNumber', '$Age');

INSERT INTO Patients (PHN, Name, Gender, Address, Age)
VALUES ('$PHN', '$Name', '$Gender', '$Address', '$Age');

INSERT INTO GeneralPublic (PublicPHN, SSN) VALUES ('$PHN','$SSN')

-- process-insert-Student.php

INSERT INTO Patients (PHN, Name, Gender, Address, PhoneNumber, Age)
VALUES ('$PHN', '$Name', '$Gender', '$Address', '$PhoneNumber', '$Age');

INSERT INTO Patients (PHN, Name, Gender, Address, Age)
VALUES ('$PHN', '$Name', '$Gender', '$Address', '$Age');

INSERT INTO Students (StudentPHN, StudentNumber) VALUES ('$PHN','$Student');


-- process-nested-aggregation-appointment.php

SELECT D.DoctorID, D.Name
FROM Doctor D WHERE D.DoctorID IN (SELECT A.DoctorID 
                                 FROM Appointments A
                                 GROUP BY A.DoctorID 
                          HAVING COUNT(A.StartDateTime > '$formattedStartDate') <= '$maxAppointmentNumber');


-- process-projection-Appointment.php 

SELECT $string, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID;

--process-update-appointment

update Appointments set StartDateTime = '$AppointmentStartDate' where AppointmentID = '$id';

update Appointments set EndDateTime = '$AppointmentEndDate' where AppointmentID = '$id';

update Appointments set RoomNumber = '$RoomNumber' where AppointmentID = '$id';

update Appointments set PHN = '$PHN' where AppointmentID = '$id';

update Appointments set DoctorID = '$DoctorID' where AppointmentID = '$id';

update ConfirmationOfSymptomsInvolvedInAppointment set NurseID = '$NurseID' where AppointmentID = '$id' AND PHN = '$PHN';

SELECT * FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$s';

INSERT INTO SymptomsIdentify (SymptomName, PHN) VALUES ('$s', '$PHN');

INSERT INTO ConfirmationOfSymptomsInvolvedInAppointment (AppointmentID, SymptomName, PHN, NurseID)
VALUES ('$id', '$s', '$PHN', '$NurseID');

update SymptomsIdentify set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d';

update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id';

DELETE FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$d';

--process-update-doctor.php

update Doctor set Name = '$Name' where DoctorID = '$id';

update Doctor set Age = '$Age' where DoctorID = '$id';

update Doctor set Gender = '$Gender' where DoctorID = '$id';

update Doctor set Specialization = '$Specialization' where DoctorID = '$id';

--process-update-Faculty
--process-update-Public.php
--process-update-Student.php

update Patients set PhoneNumber = '$PhoneNumber' where PHN = '$id';

update Patients set PhoneNumber = NULL where PHN = '$id';

UPDATE Patients SET PHN = '$PHN' where PHN = '$id';

update Patients set Name = '$Name' where PHN = '$id';

update Patients set Age = '$Age' where PHN = '$id';

update Patients set Gender = '$Gender' where PHN = '$id';

update Patients set Address = '$Address' where PHN = '$id';

update FacultyStaff set FacultyNumber  = '$FacultyNumber' where FacultyPHN = '$id';

update GeneralPublic set SSN  = '$SSN' where PublicPHN = '$id';

update Students set StudentNumber  = '$StudentNumber' where StudentPHN = '$id';

--process-update-medicalexam

update MedicalExamFee set Price = '$Price' where Type = '$id';

update MedicalExamFee set Type = '$Type' where Type = '$id';

--process-update-medicalexamrecord

update MedicalExamsIncludedIn set TestID = '$TestID' where TestID = '$id';

update MedicalExamsIncludedIn set Results = '$Result' where TestID = '$id';

update MedicalExamsIncludedIn set AppointmentID = '$AppointmentID' where TestID = '$id';

update MedicalExamsIncludedIn set Type = '$Type' where TestID = '$id';


-- update-Appointment2.php

select StartDateTime, EndDateTime, RoomNumber, PHN, DoctorID from Appointments WHERE AppointmentID = '$id';

select NurseID from ConfirmationOfSymptomsInvolvedInAppointment WHERE AppointmentID = '$id' AND PHN = '$defaultPatientPHN';

select SymptomName from ConfirmationOfSymptomsInvolvedInAppointment WHERE AppointmentID = '$id' AND PHN = '$defaultPatientPHN';

select DISTINCT RoomNumber from Room;

select DISTINCT PHN, Name from Patients;

select DISTINCT DoctorID, Name from Doctor;

select NurseID, NurseName from Nurses;

-- update-Appointment.php

select AppointmentID from Appointments;

-- update-Doctor.php

SELECT * FROM Doctor WHERE DoctorID = '$id';

-- update-MedicalExam.php

SELECT * FROM MedicalExamFee WHERE Type = '$id';


-- update-medicalExamRecord.php

SELECT * FROM MedicalExamsIncludedIn WHERE TestID = '$id';

--update-Faculty.php
--update-Public.php
--update-Student.php

SELECT * FROM Patients WHERE PHN = '$id';

SELECT FacultyNumber FROM FacultyStaff WHERE FacultyPHN = '$id';

SELECT SSN FROM GeneralPublic WHERE PublicPHN = '$id';

SELECT StudentNumber FROM Students WHERE StudentPHN = '$id';



