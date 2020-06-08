1. Enable CDR API on Grandstream

TLS Bind Address : 192.168.1.28:8443
Username: cdrapi
Password: cdrapi123
Permitted IP (s): 192.168.100.0 / 255.255.255.0

2. Install WAMP Server
3. Create Database (dbgrand) and table (rawcdr) - refer "rawcdr.sql" file
4. Configure sendmail for windows/wamp/localhost http://blog.techwheels.net/send-email-from-localhost-wamp-server-using-sendmail/
5. configure above step with Gmail

---------------------------------------
data.php will fetch and encode the json. (provide the cdr ap credentials here)
save-to-db.php will collect data from data.php and insert into the table rawcdr
sendmail.php will send email the data and mark sent data on db.

Make cron for header("refresh: 3;"); for save-to-db.php and sendmail.php

Note: Disable "Show Error" wamp php error

-----------------------
Make a call from any extension and cut. These missed call will send to mail.

Error/Troubleshooting:

 - Make sure data.php is outputting the json
 - make sure $url is poinitng to data.php
 
