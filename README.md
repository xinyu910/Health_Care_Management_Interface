# Health_Care_Management_Interface
Our project models a healthcare booking system that can be utilized by a university to schedule appointments between patients and doctors. Using a relational database management system (RDBMS) structure to organize data, with MySQL and PHP to support the backend programming logic, and HTML and CSS for the front-end design, users can interact with the RDBMS in 4 primary ways: viewing, inserting, updating and deleting records. 

Users can view (some can do SELECTION/PROJECTION on) specified records of doctors, patients, medical exams and medical exam records, and some can also specify which attributes of the relations they want to view. The RDBMS provides INSERT, UPDATE and DELETE functionality (such as for doctors or appointments) to edit the records in the database. 

Our RDBMS also provides JOIN functionality, allowing users to find patient names or doctor names, or symptoms or supervising nurses, for corresponding appointments (using JOIN between Appointments, Doctors and Patients, or Appointments, ConfirmationOfSymptomsInvolvedInAppointment
 and Nurses).

The total costs of selected medical exams can also be calculated (AGGREGATION on MedicalExamFee). 

The NESTED AGGREGATION between Doctor and Appointment functionality outputs the doctors who have fewer than certain appointments after a certain date. 

Finally, users can also query which medical exams need to be taken for certain symptoms (DIVISION between MedicalExamsIncludedIn and ConfirmationOfSymptomsInvolvedInAppointment). 

In line with these query capabilities, the RDBMS is currently set up such that the intended user would be a healthcare administrator who manages the database system.
