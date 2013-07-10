CREATE TABLE IF NOT EXISTS `#__jevent_admin_options` (
  `idt_jevent_admin_options` int(11) NOT NULL AUTO_INCREMENT,
  `showRedLight` tinyint(1) NOT NULL,
  `showDebugInfo` tinyint(1) NOT NULL,
  `applicationEmail` varchar(4000) DEFAULT NULL,
  `cancelEmail` varchar(4000) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL,
  `applicationSubject` varchar(200) DEFAULT NULL,
  `cancelSubject` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idt_jevent_admin_options`)
);

INSERT INTO `#__jevent_admin_options` (`showRedLight`, `showDebugInfo`, `applicationEmail`, `cancelEmail`,`phonenumber`, `applicationSubject`, `cancelSubject`) VALUES (1, 0, '<h2>Application for event: \'{s_event_category}\'</h2>
<div class="moz-text-html" lang="x-unicode">Dear {s_title} {s_prename} {s_name},<br /><br /> Thank you very much for your application at {s_ourname}! We confirm your application as follows:<br /><br />
<table>
<tbody>
<tr>
<td><strong>Event:</strong></td>
<td><strong>{s_event_category}</strong></td>
</tr>
<tr>
<td>Date:</td>
<td>{s_event_date}</td>
</tr>
<tr>
<td>Time:</td>
<td>{s_event_timefrom} - {s_event_timeto}</td>
</tr>
<tr>
<td>Place:</td>
<td>{s_event_address}</td>
</tr>
<tr>
<td>Price:</td>
<td>{s_event_price}</td>
</tr>
</tbody>
</table>
<br /> Your Information:<br />
<table>
<tbody>
<tr>
<td>Surname:</td>
<td>{s_prename}</td>
</tr>
<tr>
<td>Name</td>
<td>{s_name}</td>
</tr>
<tr>
<td>Address/Nr.:</td>
<td>{s_address}</td>
</tr>
<tr>
<td>ZIP/Place:</td>
<td>{s_zip} {s_city}</td>
</tr>
<tr>
<td>Phone:</td>
<td>{s_phone}</td>
</tr>
<tr>
<td>Email:</td>
<td><a href="mailto:{s_email}">{s_email}</a></td>
</tr>
</tbody>
</table>
<br /><br /> This application is binding, if here is an error or anything is in doubt please don´t hesitate to contact us immediately via mail at <a href="mailto:{s_ouremail}">{s_ouremail}</a> or by phonecall to {s_ourphone}. Thank you!<br /><br /> Sincerely Yours<br /> {s_oursignature}</div>
<p> </p>', '<h2>Deregistration from event: \'{s_event_category}\'</h2>
<div class="moz-text-html" lang="x-unicode">Dear {s_title} {s_prename} {s_name},<br /><br /> Thank You for your deregistration from the event at {s_ourname}! We confirm your deregistration as follows:<br /><br />
<table>
<tbody>
<tr>
<td><strong>Event:</strong></td>
<td><strong>{s_event_category}</strong></td>
</tr>
<tr>
<td>Date:</td>
<td>{s_event_date}</td>
</tr>
<tr>
<td>Time:</td>
<td>{s_event_timefrom} - {s_event_timeto}</td>
</tr>
<tr>
<td>Place:</td>
<td>{s_event_address}</td>
</tr>
<tr>
<td>Price:</td>
<td>{s_event_price}</td>
</tr>
</tbody>
</table>
<br /> Your Information:<br />
<table>
<tbody>
<tr>
<td>Surname:</td>
<td>{s_prename}</td>
</tr>
<tr>
<td>Name</td>
<td>{s_name}</td>
</tr>
<tr>
<td>Address/Nr.:</td>
<td>{s_address}</td>
</tr>
<tr>
<td>ZIP/Ort:</td>
<td>{s_zip} {s_city}</td>
</tr>
<tr>
<td>Phone:</td>
<td>{s_phone}</td>
</tr>
<tr>
<td>Email:</td>
<td><a href="mailto:{s_email}">{s_email}</a></td>
</tr>
</tbody>
</table>
<br /><br /> This deregistration is binding. If you find an error or have any question please don´t hesitate to contact us immediately via email at <a href="mailto:{s_ouremail}">{s_ouremail}</a> or by phonecall to {s_ourphone}. Thank you!<br /><br /> Sincerely Yours<br /> {s_oursignature}</div>
<p> </p>','076 689 69 69', 'Application for event: {s_event_category} at {s_event_date} {s_event_timefrom} - {s_event_timeto}', 'Deregistration from event: {s_event_category} at {s_event_date} {s_event_timefrom} - {s_event_timeto}');



CREATE TABLE IF NOT EXISTS `#__jevent_admin_user` (
  `idt_jevent_adminuser` int(11) NOT NULL AUTO_INCREMENT,
  `idt_user` int(11) NOT NULL,
  PRIMARY KEY (`idt_jevent_adminuser`),
  KEY `#__fk_jevent_adminuser` (`idt_user`),
  CONSTRAINT `#__fk_jevent_adminuser` FOREIGN KEY (`idt_user`) REFERENCES `#__users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE  IF NOT EXISTS `#__jevent_admin_usergroup` (
  `idt_jevent_adminusergroup` int(11) NOT NULL AUTO_INCREMENT,
  `idt_usergroup` int(11) NOT NULL,
  PRIMARY KEY (`idt_jevent_adminusergroup`)
); 

CREATE TABLE IF NOT EXISTS `#__jevent_events` (
  `idt_drivin_event` int(11) NOT NULL AUTO_INCREMENT,
  `dt_event_time` datetime DEFAULT NULL,
  `dt_event_end` datetime DEFAULT NULL,
  `s_category` varchar(50) DEFAULT NULL,
  `s_description` varchar(4000) DEFAULT NULL,
  `s_place` varchar(200) DEFAULT NULL,
  `n_num_part` int(11) DEFAULT NULL,
  `s_price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idt_drivin_event`),
  UNIQUE KEY `idt_drivin_event_UNIQUE` (`idt_drivin_event`)
);

CREATE TABLE IF NOT EXISTS `#__jevent_events_apply` (
  `idt_drivin_event_apply` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(200) NOT NULL,
  `s_prename` varchar(200) NOT NULL,
  `s_address` varchar(200) NOT NULL,
  `s_plz` varchar(20) NOT NULL,
  `s_city` varchar(200) NOT NULL,
  `s_phone` varchar(45) NOT NULL,
  `s_email` varchar(200) NOT NULL,
  `idt_drivin_event` int(11) NOT NULL,
  `dt_cancel` timestamp NULL DEFAULT NULL,
  `s_title` varchar(45) DEFAULT NULL,
  `dt_ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idt_drivin_event_apply`),
  UNIQUE KEY `idt_drivin_event_apply_UNIQUE` (`idt_drivin_event_apply`),
  KEY `#__idt_drivin_event` (`idt_drivin_event`),
  CONSTRAINT `#__idt_drivin_event` FOREIGN KEY (`idt_drivin_event`) REFERENCES `#__jevent_events` (`idt_drivin_event`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

INSERT INTO `#__jevent_admin_usergroup`
(`idt_usergroup`)
VALUES
((Select id From `#__usergroups` WHERE title = 'Super Users'));
