# Medical Centre Web App
## About
This was a project for one of my classes.
The site is made for a medical centre that has laboratories, medical offices, capacity to hospitalize and to perform different operations.</br></br>
**Users** are split in **3 categories: pacient, doctor and admin**. Each have differnt facilities listed below.<br>
Made using **bootstrap, phpmailer, fpdf and fullcalendar.io**</br>
**Acess to specific pages is restricted** with session variables; when trying to access a page that isn't made for the current user's type either a custom error is displayed (ex. try to login first) or they are redirected to homepage. </br>
Regarding backend, I transferd an Oracle SQL database to MySql and modified it. You can find the ERD [here](https://github.com/NMDMaria/Medical_centre_web_app/blob/main/images/schema1.jpg).</br></br>
<img src="https://i.gyazo.com/1d4a56de334122752bb29ffd40c05ce4.png" height="80%" width="80%"></br> </br>

## Facilities
Any public form is secured with a **CAPTCHA** check. **Login** can be made with both username and email. </br> When registering an **welcome email** will be sent to the email introduced; also there's an option to **request** making an **doctor account**, which needs to be **verified by an admin**, when it is veried an email will be sent so the user can start using their account.</br></br>
***Pacient*** can:
- See their **calendar with appointments**, scroll through it
- **Cancel** an appointment
- **Make** an appointment (maximum 2 hours, minimum 30 minutes that is put automatically and within the working hours)
- See their **prescription** history and the **pdf document** coresponding to it
- Edit their profile</br>

***Doctor*** can:
- See their **calendar with appointments**
- Add details regarding the procedures when made.</br>
    There are **3 types of procedures**: checkup, operation and prelevation of biological samples.</br>
    - ***Checkup***: a **diagnostic** can be made from the list displayed and if there's a diagnostic, add **treatments** - medicine name, number of days to be taken and the quantity/day - and/or add a **reccomandation** to visit another doctor of a specific speciality.</br>
    - **Operation**: choose the operation type.</br>
    - **Tests**: select the type of the samples prelevated, maximum 4 (one of each type)</br>

***Admin*** can:
- Make another admin account
- **Validate/reject requests** regarding doctor profiles, either creating or associating an employee with an account and adding the required information (ex. salary, hiring date) 
## Screenshots
### Login and register pages
<img src="https://i.gyazo.com/2674f2161c3fd06772adcd24d5b9f30f.png" width="50%"><img src="https://i.gyazo.com/426ca0c485fd2eb87c1f9ef98a31944e.png" width="50%"></br> </br>
### Making a profile
<img src="https://i.gyazo.com/3ecc8b061813076fce1e29021934626a.png"></br></br>
### Requesting a doctor profile and profile view
<img src="https://i.gyazo.com/3f3d1711d38cc7d861deb3e32764a079.png" height="600" width="500"><img src="https://i.gyazo.com/fa813c40d05e9966e29d00fc837f88d8.png" width="500" height="400"></br></br>
### Choosing and viewing prescriptions
<img src="https://i.gyazo.com/bb2684535ae22ca15515db403f084f3c.png" width="50%"></br> </br>
### Viewing and making appointments
<img src="https://i.gyazo.com/3d195b644a11f3691b281741b8dcbf8d.png"><img src="https://i.gyazo.com/5bc5c2a422456751a9e5694b113003f1.png"></br></br>
### Admin dashboard
<img src="https://i.gyazo.com/48b3068617290e4e5665aede138a8903.png"><img src="https://i.gyazo.com/eab8e8e9f764e4da4ae64d13af5c224f.png"></br> </br>
