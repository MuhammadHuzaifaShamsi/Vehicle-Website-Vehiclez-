dbname: `vehiclez`


-----------TABLES---------------

1=== `admin_cred` === (can only be manually filled with values)
sr_no (int)
admin_name (varchar)=100
admin_pass (varchar)=150

2== `carousel` ===  (ideal size: 1920 x 590 px)
sr_no (int) AI (auto increment)
image (varchar)=100

3== `contact_details` ===
sr_no (int) AI 
address (varchar)=300
gmap (varchar)=300
pn1 (varchar)=50
pn2 (varchar)=50
email (varchar)=150
fb (varchar)=250
insta (varchar)=250
tw (varchar)=250
iframe (varchar)=300

4== `facilities` ===
sr_no (int) AI
icon (varchar)=100
name (varchar)=100
description (varchar)=300

5== `feature` ===
sr_no (int) AI
name (varchar)=50

6== `settings` ===
sr_no (int) AI
site_title (varchar)=30
site_about (varchar)=250
shutdown (tinyint) default value: 0

7== `team_details` ===
sr_no (int) AI
name (varchar)=100
picture (varchar)=100

8== `user_cred` ===
sr_no (int) AI
name (varchar)=100
email (varchar)=150
cnic (bigint)
dob (date)
pn (varchar)=50
profile (varchar)=100
address (varchar)=150
pass (varchar)=250
cpass (varchar)=250
status (int) default value: 1
date_time (datetime) default value: current_timestamp()

9== `user_q` ===
sr_no (int) AI
name (varchar)=100
email (varchar)=150
subject (varchar)=150
message (varchar)=250
date (date) default value: current_timestamp()
seen (tinyint) default value:0

10== `vehicles` ===  (ideal size: 1920 x 1440 px)
sr_no (int) AI
name (varchar)=100
space (varchar)=100
price (int)
quantity (int)
status (tinyint) default value: 1
removed (int) default value: 0

11== `vehicles_features` ===
sr_no (int) AI
vehicle_sr_no (int) **foreign key with table `vehicles` sr_no (keyname: vehicle_id)** (unupdate: no action)
features_sr_no (int) **foreign key with table `feature` sr_no (keyname: features_id)** (unupdate: no action)

12== `vehicle_images` ===
sr_no (int) AI
vehicle_sr_no (int) **foreign key with table `vehicles` sr_no (keyname: vehicle_sr_no)** (unupdate: restrict)
image (varchar)=100
thumb (tinyint) default value: 0
