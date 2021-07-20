DROP TABLE IF EXISTS ConfirmationOfSymptomsInvolvedInAppointment;
DROP TABLE IF EXISTS Uses;
DROP TABLE IF EXISTS MedicalExamsIncludedIn;
DROP TABLE IF EXISTS MedicalExamFee;
DROP TABLE IF EXISTS Nurses;
DROP TABLE IF EXISTS SymptomsIdentify;
DROP TABLE IF EXISTS Appointments;
DROP TABLE IF EXISTS EquipmentHas;
DROP TABLE IF EXISTS Room;
DROP TABLE IF EXISTS TakeAndSupervises;
DROP TABLE IF EXISTS MedicineFee;
DROP TABLE IF EXISTS Doctor;
DROP TABLE IF EXISTS Medicine;
DROP TABLE IF EXISTS Students;
DROP TABLE IF EXISTS FacultyStaff;
DROP TABLE IF EXISTS GeneralPublic;
DROP TABLE IF EXISTS Patients;

CREATE TABLE IF NOT EXISTS Patients(
PHN Integer PRIMARY KEY,
Name varchar(30) NOT NULL, 
Gender varchar(10) NOT NULL, 
Address varchar(50) NOT NULL, 
PhoneNumber Integer UNIQUE DEFAULT NULL,
Age Integer NOT NULL);

CREATE TABLE IF NOT EXISTS Students(
StudentPHN Integer PRIMARY KEY,
StudentNumber Integer UNIQUE NOT NULL,
FOREIGN KEY (StudentPHN) REFERENCES Patients(PHN) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS FacultyStaff(
FacultyPHN Integer PRIMARY KEY,
FacultyNumber Integer UNIQUE NOT NULL,
FOREIGN KEY (FacultyPHN) REFERENCES Patients(PHN) ON DELETE CASCADE ON UPDATE CASCADE); 

CREATE TABLE IF NOT EXISTS GeneralPublic(
PublicPHN Integer PRIMARY KEY,
SSN Integer UNIQUE DEFAULT NULL,
FOREIGN KEY (PublicPHN) REFERENCES Patients(PHN) ON DELETE CASCADE);

CREATE TABLE IF NOT EXISTS Medicine(
MedicineID Integer PRIMARY KEY, 
MedicineName varchar(20) NOT NULL, 
Brand varchar(20));  

CREATE TABLE IF NOT EXISTS Doctor(
DoctorID Integer PRIMARY KEY, 
Name varchar(30) NOT NULL,
Age int DEFAULT NULL, 
Gender varchar(10) NOT NULL, 
Specialization varchar(20) DEFAULT NULL); 

CREATE TABLE IF NOT EXISTS MedicineFee(
Dosage Integer, 
MedicineID Integer, 
Price Real NOT NULL, 
PRIMARY KEY(Dosage, MedicineID), 
FOREIGN KEY (MedicineID) REFERENCES Medicine(MedicineID) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS TakeAndSupervises(
Dosage Integer, 
MedicineID Integer,  
PHN Integer, 
DoctorID Integer NOT NULL,
PRIMARY KEY (MedicineID, PHN),
FOREIGN KEY (MedicineID) REFERENCES Medicine(MedicineID) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (PHN) REFERENCES Patients(PHN) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (DoctorID) REFERENCES Doctor(DoctorID) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (Dosage) REFERENCES MedicineFee(Dosage) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS Room(
RoomNumber Integer PRIMARY KEY); 

CREATE TABLE IF NOT EXISTS EquipmentHas(
EquipmentID Integer PRIMARY KEY,
EquipmentName varchar(50), 
RoomNumber Integer,
FOREIGN KEY (RoomNumber) REFERENCES Room(RoomNumber) ON DELETE SET NULL ON UPDATE CASCADE);


CREATE TABLE IF NOT EXISTS Appointments(
AppointmentID Integer PRIMARY KEY, 
StartDateTime DateTime,  
EndDateTime DateTime, 
RoomNumber Integer NOT NULL,
PHN Integer NOT NULL, 
DoctorID Integer NOT NULL, 
FOREIGN KEY (RoomNumber) REFERENCES Room(RoomNumber) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (PHN) REFERENCES Patients(PHN) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (DoctorID) REFERENCES Doctor(DoctorID) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS SymptomsIdentify(
SymptomName varchar(40), 
PHN Integer, 
PRIMARY KEY(SymptomName, PHN),
FOREIGN KEY (PHN) REFERENCES Patients(PHN) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS Nurses(
NurseID Integer PRIMARY KEY,
NurseName varchar(30) NOT NULL, 
Gender varchar(10));

CREATE TABLE IF NOT EXISTS MedicalExamFee(
Type varchar(20) PRIMARY KEY, 
Price real NOT NULL);

CREATE TABLE IF NOT EXISTS MedicalExamsIncludedIn(
TestID Integer PRIMARY KEY,
AppointmentID Integer NOT NULL,
Results varchar(300) NOT NULL, 
Type varchar(20) NOT NULL,
FOREIGN KEY (AppointmentID) REFERENCES Appointments(AppointmentID) ON DELETE CASCADE,
FOREIGN KEY (Type) REFERENCES MedicalExamFee(Type) ON DELETE CASCADE);


CREATE TABLE IF NOT EXISTS Uses(
EquipmentID Integer,
TestID Integer,
PRIMARY KEY(EquipmentID, TestID),
FOREIGN KEY (EquipmentID) REFERENCES EquipmentHas(EquipmentID) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (TestID) REFERENCES MedicalExamsIncludedIn(TestID) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS ConfirmationOfSymptomsInvolvedInAppointment(
AppointmentID Integer, 
SymptomName varchar(30), 
PHN Integer, 
NurseID Integer NOT NULL,
PRIMARY KEY(AppointmentID, SymptomName, PHN),
FOREIGN KEY (AppointmentID) REFERENCES Appointments(AppointmentID) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (SymptomName, PHN) REFERENCES SymptomsIdentify(SymptomName, PHN) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (NurseID) REFERENCES Nurses(NurseID) ON DELETE CASCADE ON UPDATE CASCADE);


INSERT INTO Patients
VALUES
(3333666, "Cristina", "F", "781 80a Ave.", 778214778, 12),
(2222111, "Angela", "F", "5781 Bardes St.", 778435968, 30), 
(3555664, "Justin", "M", "6890 Main St.", 778948337, 50),
(3332543, "Xinyu", "F", "78922 Dunbar Ave.", 778999958, 2), 
(4563542, "Jack", "M", "8957 Cambie St.", 778904983, 79),
(7892046, "Cristine", "F", "791 80a Ave.", 778955403, 29),
(5629461, "Chris", "M", "5781 Fraser St.", 778112345, 28), 
(2340253, "Mark", "M", "6790 Main St.", 778900846, 40),
(5702541, "Sarah", "F", "782 Dunbar St.", 604277384, 50),
(3255621, "Karen", "M", "8657 Cambie St.", 604555684, 30), 
(1249269, "Emily", "F", "78 Toronto Ave.", 604985294, 6),
(2560047, "Aiden", "M", "5781 Manitoba St.", 604883728, 12), 
(3959003, "Victor", "M", "68 Rupert St.", 604928475, 18), 
(6303640, "Tomas", "M", "72 Quebec Ave.", 604234523, 24), 
(456354332, "Jason", "M", "87 Acadia St.", 604598101, 30); 


INSERT INTO Students
VALUES
(3333666, 75876581), 
(2222111, 76391549),
(3555664, 64926401),
(3332543, 54921942),
(4563542, 74927401);


INSERT INTO FacultyStaff
VALUES
(7892046, 5677924), 
(5629461, 8888888), 
(2340253, 9999999), 
(5702541, 2351252),
(3255621, 7594049);


INSERT INTO GeneralPublic
VALUES
(1249269, 46937294), 
(2560047, 34691925), 
(3959003, 35691294), 
(6303640, 46952819),
(456354332, 53719495);


INSERT INTO Medicine
VALUES
(122333, "Rabeprazole", "XOOT"),
(23311, "Amxolin", "YOOT"),
(22333, "Tylenol", "ZEETE"),
(444333, "Ibuprofen", "ADVIL"), 
(112233, "Ibuprofen", "MOTRIN IB");

INSERT INTO Doctor
VALUES
(566666, "Martin Hertz", 34, "M","Internal Medicine"),
(54443, "Amanda Johnson", 42, "F", "Oncology"),
(44444, "Charon Styx", 65, "M", "Palliative Care"),
(33333, "Doug Dimmadome", 50, "M", "General Surgery"), 
(34421, "Mindy Crawford", 32, "F", "Pediatrician");

INSERT INTO Doctor (DoctorID, Name, Gender, Specialization)
VALUES
(124523, "Peter Pan", "M", "Cardiology");

INSERT INTO MedicineFee
VALUES
(11, 122333, 20),
(22, 23311, 10),
(34, 22333, 30),
(50, 444333, 30),
(90, 112233, 20);

INSERT INTO TakeAndSupervises
VALUES
(11, 122333, 6303640, 566666),
(22, 23311, 1249269, 54443),
(34, 22333, 3332543, 44444),
(50, 444333, 456354332, 33333),
(90, 112233, 4563542, 34421),
(50, 444333, 4563542, 34421),
(34, 22333, 4563542, 34421),
(22, 23311, 4563542, 34421),
(11, 122333, 4563542, 34421);

INSERT INTO Room
VALUES
(100),
(333),
(221),
(345),
(123);

INSERT INTO EquipmentHas
VALUES
(2330, "Eye Machine", 100),
(2220, "Ear Machine" , 333),
(1223, "Ultrasound", 221),
(3049, "Blood Pressure Machine", 345),
(49572, "X-ray Machine", 123);

INSERT INTO Appointments
VALUES
(123, '2021-05-21 15:00:00', '2021-05-21 15:30:00', 100, 6303640, 566666),
(222, '2022-04-01 16:20:00', '2022-04-01 16:50:00', 333, 1249269, 54443),
(333, '2022-01-20 14:00:00', '2022-01-20 14:40:00', 221, 3332543, 44444),
(444, '2000-06-17 17:00:00', '2000-06-17 17:30:00', 345, 456354332, 33333),
(555, '2011-05-29 11:00:00', '2011-05-29 11:40:00', 123, 4563542, 34421),
(666, '2021-05-30 11:00:00', '2021-05-30 13:40:00', 333, 2222111, 566666);


INSERT INTO SymptomsIdentify
VALUES
("Eye discomfort", 6303640),
("Missed Period", 1249269),
("Headache", 3332543),
("Chest Pain", 456354332),
("Diarrhea", 4563542),
("Diarrhea", 2222111);

INSERT INTO Nurses
VALUES
(0002, "Julie Kim", "F"),
(1245, "Sam Park", "F"),
(3245, "Sally Smith", "F"),
(44312, "John Parker", "M"),
(098, "Quinn De", "M");

INSERT INTO MedicalExamFee
VALUES
("Eye exam", 2.22),
("Ultrasound", 10),
("Stool Test", 30.90),
("X-ray", 10.20),
("Blood Test", 8.0),
("Cat Scan", 60.40);

INSERT INTO MedicalExamsIncludedIn
VALUES
(123, 123, "Pink Eye", "Eye exam"),
(222, 222, "pregnant", "Ultrasound"),
(344, 333, "Not sick", "Cat Scan"),
(111, 444, "Broken Ribs", "X-ray"),
(300, 555, "Food Poisoning", "Stool Test"),
(177, 123, "Normal", "Blood Test"),
(188, 222, "hCG in blood", "Blood Test"),
(199, 333, "Normal", "Blood Test"),
(200, 444, "Normal", "Blood Test"),
(322, 555, "Inflammation ", "Blood Test"),
(302, 666, "Infection by bacteria", "Stool Test"),
(304, 666, "Inflammation ", "Blood Test");

INSERT INTO Uses
VALUES
(2330,123),
(2220,222),
(1223, 344),
(3049, 111),
(49572, 300);

INSERT INTO ConfirmationOfSymptomsInvolvedInAppointment
VALUES
(123, "Eye discomfort", 6303640, 0002),
(222, "Missed Period", 1249269,1245),
(333, "Headache", 3332543, 3245),
(444, "Chest Pain", 456354332, 44312),
(555, "Diarrhea", 4563542, 098),
(666, "Diarrhea", 2222111, 098);




