# Dockerfile

This is a Dockerfile to build XAMPP based on ubuntu:16.04.

### Build Image From Dockerfile

First, using command `git clone` to clone this project.

            $ git clone https://github.com/fasiahmed/teamcalendar.git

            Using (SSH) $ git clone git@github.com:fasiahmed/teamcalendar.git         

Second, buildng XAMPP image form Dockerfile, you can use tag `-t` to name this image.

    $ docker build -t xampp/fullcalender .

### Useage
[using Docker hub]:
 
            Pull this image from Docker Hub.
            $ docker pull fasi/fullcalender
           
            Run the docker container.
             $ docker run -d -p 80:80 -p 443:443 -p 3306:3306 fasi/fullcalender

[using the Dockerfile]
- Build the docker image using Dockerfile.
    $ docker build -t XAMPP/fullcalender .  
- Now you have a xampp image,and using command `docker run` to run , and use tag `-v` to mount on your folder, tag `-p` can forward the port `80` (HTTP) , `443` (HTTPS) , and `3306` (MariaDB/MySQL) .

The path `/opt/lampp/htdocs` is the web root directory , mount it so you can edit your website easily.

    $ docker run -d -v /to/your/path:/opt/lampp/htdocs -p 80:80 -p 443:443 -p 3306:3306 XAMPP/fullcalender

    or you can directly run the below command where all the required calendar files are shared in this image    

The path `/opt/lampp/htdocs` is the web root directory , mount it, let you edit the website easily.

### Access Your Contaier

Usig the command `docker exec -it fasi/fullcalender bash` to run `bash` in the live container, and you can use command `mysql`, `php`... without `cd /opt/lampp/bin` , the path has been added in `/root/.bashrc`.

 [Run at browser]: http://localhost/NexintoCalendar/teamCalendar.html

### Create database Tables
[update the password]: UPDATE mysql.user SET Password=PASSWORD('password') WHERE User='root'; FLUSH PRIVILEGES;
[login into the database]:  mysql -uroot -p
                            password: password
[Use the test database]: use test;
[create the tables]:
                      create table employee (
                        empName varchar(30),
                        empID int(4) not null,
                        primary key (empID)
                        );

MariaDB [test]> desc employee;
+---------+-----------------+------+-----+---------+-------+
| Field   | Type            | Null | Key | Default | Extra |
+---------+-----------------+------+-----+---------+-------+
| empName | varchar(30)     | YES  |     | NULL    |       |
| empID   | int(3) unsigned | NO   | PRI | NULL    |       |
+---------+-----------------+------+-----+---------+-------+

create table empEvents (
  empName varchar(30),
  title varchar(30),
  start date,
  end date,
  Description varchar(30),
  empID int(3),
  noHours int(4),
  foreign key (empID) references employee(empID)
  );

MariaDB [test]> desc empEvents;
+-------------+-----------------+------+-----+---------+-------+
| Field       | Type            | Null | Key | Default | Extra |
+-------------+-----------------+------+-----+---------+-------+
| empName     | varchar(30)     | YES  |     | NULL    |       |
| title       | varchar(30)     | YES  |     | NULL    |       |
| start       | date            | YES  |     | NULL    |       |
| end         | date            | YES  |     | NULL    |       |
| Description | varchar(30)     | YES  |     | NULL    |       |
| empID       | int(3) unsigned | NO   | MUL | 0       |       |
| noHours     | int(4)          | YES  |     | NULL    |       |
+-------------+-----------------+------+-----+---------+-------+

### known problem
If the calendar did not show at the specified url under the browser. Please enter into the docker container
$ docker exec -it <containerID> /bin/bash
$ cd /opt/lampp/ctlscript.sh start   ( This will start the mysql, httpd and php if they have not started properly )

### Description of the Calendar
[ Add an Event]
- Click on any of the calendar day. A popup which ask you to enter the following details.
    - Event : Select an Event.
    - who : The values in the drop-down list are populated from the database when you change the event. So to get the employee names in the drop-down list you should enter the records in the employee table which you have create above.
    - Description: You can give the description of the event   
    - start and end Date: select the start and end date of the event.
- Click on Add Event button to add the event

[ Delete an Event]
- Click on the Event. A popup which ask you to delete an event
- Click on Delete Event button to delete the event

[ Modify an Event or Resize the event ]
- Resize is possible only at the end of the event display.
- Click on Event and drag from the end of event.
- Drag the event only when you see arrow symbol (->)

[ Display the Holidays in the calendar ]
- The Holidays are fetch from listofHoliday.json file which are display as red in the calendar.
