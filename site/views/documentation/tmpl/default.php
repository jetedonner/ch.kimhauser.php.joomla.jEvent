<?php // no direct access
defined('_JEXEC') or die('Restricted access');
require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'helperFunctions.php');
?>
<h2>Table of Content</h2>
<ol>
<li>Introduction</li>
<li>Back-End (Administrator)</li>
<ol>
<li>Access rights</li>
<li>Options</li>
<li>Mailtexts</li>
</ol>
<li>Front-End</li>
<ol>
<li>Admin-View / User-View</li>
<li>List of events</li>
<li>Application form</li>
<li>Mail-Function</li>
<li>List of applications</li>
</ol></ol>
<p> </p>
<h2>Introduction</h2>
<p>The Jommla component jEvent was initially developed for a driving school for presenting and managing the individual lessons or events online. At this time jEvent 0.91 allows you to enter and manage specific events with attributes like a category, a detailed description ,'a place' where this event is going to happen (google-maps link possible), number of seats available for this event and price as well.</p>
<p>The management of this event takes place at the Front-End therfore you have to define a permited user/group in the admin section of jEvent. The jEvent "Admins" have a different view of the pages with more controls (Add, edit,...). As Admin you also have the ability to view all applications for a specific event. You also can resend the application mail or cancel the application (Cancel Mail sent). The user view only displays all future events with an Join button, where the admin also can see past events and all management buttons</p>
<p> </p>
<table>
<tbody>
<tr>
<td valign="top">
<h2>Back-End (Administrator)</h2>
<p>This is the jEvent menu in the backend admin area. You can select each group of the admin options seperatly or just start at the beginning by clicking the parent menu "jevent".</p>
<p>You should start by defining admin users or groups by selecting them from the joomla users tables. If they not yet exist in joomla start by adding them via the joomla user management console. All users and groups from joomla also show up in jEvent access management. Now you can add the access right to jEvent simply by selecting them in "access-rights".</p>
<p>Now the most important part of the configuration is done and you can fill out the options, adjust the email templates or start adding events.</p>
</td>
<td valign="top">
<p><img src="<?php echo $sroot;?>/images/documentation/01_backend_menu.png" border="0" alt="" /><br />(pic. <a href="<?php echo $sroot;?>/images/documentation/01_backend_menu.png" title="jEvent backend menu">jEvent backend menu</a>)</p>
</td>
</tr>
</tbody>
</table>
<p> </p>
<table>
<tbody>
<tr>
<td valign="top">
<h3>Access rights</h3>
<p>To administrate the events and applications at the front-end of jEvent you need to act as admin user. To work with jEvent you have to define at least one Admin-User or Admin-Group. The user/group table are based on the ones from the joomla installation. You can check/ uncheck them as you need it. jEvent won´t let you save changes unless at least one user or group is selected.</p>
<p>This user/usergroup selection is based on the current joomla user/group tables. If you need more hirarchies or want to add users you have to do this first within the joomla user management and after that you select the user or group in jEvent admin area to enable this as an admin user or group for jEvent.</p>
<p>Be carefull if you want to delete an users from joomla. Make sure you first deselect it in jEvent and then delete it from joomla. Otherwise the delete may fail. jEvent is working with referencing integrities to the joomla system tables.</p>
<p>Because jEvent uses a link to the joomla user tables you can use the same username you do in other components or parts of your joomla website. This is also a lightweight usermanagement solution for all other joomla components in need of such functionalities.</p>
</td>
<td valign="top"><img src="<?php echo $sroot;?>/images/documentation/02_backend_accessrights.png" border="0" width="421" height="671" style="border: 0;" />
<p>(pic. <a href="<?php echo $sroot;?>/images/documentation/02_backend_accessrights.png" title="jEvent backend access rights">jEvent backend access rights</a>)</p>
</td>
</tr>
</tbody>
</table>
<p> </p>
<table>
<tbody>
<tr>
<td valign="top">
<p><img src="<?php echo $sroot;?>/images/documentation/03_backend_options.png" border="0" width="334" height="340" style="border: 0;" /><br />(pic. <a href="<?php echo $sroot;?>/images/documentation/03_backend_options.png" title="jEvent backend options">jEvent backend options</a></p>
</td>
<td valign="top">
<h3>Options</h3>
<h4>Redlight</h4>
<p>You can choose to show wether a redlight signal or numbers for the indication of available seats for an event. You can replace the images in the package with your custom ones, just use the same name.</p>
<h4>Debug info</h4>
<p>This option is for developers only. You can show several debug information such as ID´s and distinctiv values. Use this only if your developing at jEvent and need more information in case of debugging.</p>
<h4>Contact phone number</h4>
<p>This phone number is used in the application / cancel mails as contact phone number. It´s intend for any kind of question or request respecting the application to an event. To access this value from the mail templates use the <em><strong>{s_ourphone}</strong> </em>variable.</p>
</td>
</tr>
</tbody>
</table>
<p> </p>
<table>
<tbody>
<tr>
<td valign="top"><br />
<h3>Mailtexts</h3>
<p>jEvent can send two types of mails to the applicants of an event. These is either an application email on signup for an specific event or a cancel email if the participant cancels his application.</p>
<p>In the admin area you can create a template email for each type of mail. You can define a mail subject and text. For flexebility you also can use variables (placeholder for dynamic data) to personalize the mail template for every purpose.</p>
<p>Please see the table below for a detailed definition of the available variables. You can use all variables in the mail subject as well as the actual mail text.</p>
<p>This mail function is realized by using the built-in mail functions of joomla. For the mails to be delivered in the right way be sure to setup the mail functions (specialy smtp) of joomla correctly.</p>
<p>Here you see an example of an application mail sent from jEvent.</p>
</td>
<td valign="top">
<h2><img src="<?php echo $sroot;?>/images/documentation/04_backend_mailtexts.png" border="0" width="426" height="456" style="border: 0;" /></h2>
<p>(pic. <a href="<?php echo $sroot;?>/images/documentation/04_backend_mailtexts.png" title="jEvent backend mailtexts">jEvent backend mailtexts</a>)</p>
</td>
</tr>
</tbody>
</table>
<h4>Mail variables</h4>
<table width="621">
<tbody>
<tr>
<td valign="top"><span style="text-decoration: underline;"><strong>Variable</strong></span></td>
<td valign="top"><span style="text-decoration: underline;"><strong>Description</strong></span></td>
<td valign="top"><span style="text-decoration: underline;"><strong>Example</strong></span></td>
</tr>
<tr>
<td valign="top">{s_event_category}</td>
<td valign="top">Category of the specific event</td>
<td valign="top">Traffic school</td>
</tr>
<tr>
<td valign="top">{s_event_date}</td>
<td valign="top">Date of the event</td>
<td valign="top">24.12.2012</td>
</tr>
<tr>
<td valign="top">{s_event_timefrom}</td>
<td valign="top">The start time of the event</td>
<td valign="top">12:30</td>
</tr>
<tr>
<td valign="top">{s_event_timeto}</td>
<td valign="top">The end time of the event</td>
<td valign="top">16:30</td>
</tr>
<tr>
<td valign="top">{s_event_address}</td>
<td valign="top">Address of the event</td>
<td valign="top">Bahnhostrasse 101, 8001 Zürich</td>
</tr>
<tr>
<td valign="top">{s_event_price}</td>
<td valign="top">Price of the event</td>
<td valign="top">i.e. 123.- CHF, Free, ...</td>
</tr>
<tr>
<td valign="top">{s_title}</td>
<td valign="top">Title of the applicant</td>
<td valign="top">Mr.</td>
</tr>
<tr>
<td valign="top">{s_prename}</td>
<td valign="top">Prename of the applicant</td>
<td valign="top">John</td>
</tr>
<tr>
<td valign="top">{s_name}</td>
<td valign="top">Name of the applicant</td>
<td valign="top">Doe</td>
</tr>
<tr>
<td valign="top">{s_address}</td>
<td valign="top">Address of the applicant</td>
<td valign="top">Lagerstrasse 46</td>
</tr>
<tr>
<td valign="top">{s_plz}</td>
<td valign="top">ZIP of the applicant</td>
<td valign="top">8004</td>
</tr>
<tr>
<td valign="top">{s_city}</td>
<td valign="top">City of the applicant</td>
<td valign="top">Zürich</td>
</tr>
<tr>
<td valign="top">{s_ourname}</td>
<td valign="top">Name your website (change in joomla config)</td>
<td valign="top">kimhauser.ch</td>
</tr>
<tr>
<td valign="top">{s_ourphone}</td>
<td valign="top">Contact phone number from the jEvent config (options)</td>
<td valign="top">076 689 69 69</td>
</tr>
</tbody>
</table>
<p> </p>
<h2>Front-End</h2>
<h3>User-View</h3>
<h2><img src="<?php echo $sroot;?>/images/documentation/jevent_events_user_view.png" border="0" alt="" width="469" height="136" /></h2>
<p>This view presents all events to the user. Normal users see all upcoming events an can signup to them while the admins also see past events an have further control ability over the event an application management in jEvent. Here you see the user view of the eventlist</p>
<p> </p>
<h3>Admin-View</h3>
<h2><img src="<?php echo $sroot;?>/images/documentation/jevent_events_admin_view.png" border="0" alt="" width="468" height="231" /></h2>
<p>In this example you see the admin view of the eventlist. Notice the additional column "Manage" with more functionalities for event and application management. The admin view also presents you past events and enables you to manipulate them.</p>
<p> </p>
<p>Admin controls</p>
<p>These are the available admin controls for the list of events. To access this controls make sure you are logged in as an jEvent admin.</p>
<table width="641">
<tbody>
<tr>
<td valign="top">
<h2><img src="<?php echo $sroot;?>/images/list.png" border="0" alt="" /></h2>
</td>
<td valign="top">List applications for an event. Also let´s you cancel an application</td>
</tr>
<tr>
<td valign="top">
<h2><img src="<?php echo $sroot;?>/images/edit.png" border="0" alt="" /></h2>
</td>
<td valign="top">Edit event</td>
</tr>
<tr>
<td valign="top">
<h2><img src="<?php echo $sroot;?>/images/delete.png" border="0" alt="" /></h2>
</td>
<td valign="top">Delete event (only available if there are no applications)</td>
</tr>
</tbody>
</table>
<p> </p>
<h3>Application form</h3>
<h2><img src="<?php echo $sroot;?>/images/documentation/jevent_apply_form.png" border="0" alt="" width="385" height="300" /></h2>
<p>This is the application form for an event as it is presented for all users. Her a registered, public or admin-user can apply for a specific event. At this time there is no need to bee registered with joomla to use this feature.</p>
<p>All fields have to be filled and the agreement checkbox has to be ticked to proceed with the application for the event. Once this step has completed successfully, a message indicating that will appear and you will receive an application email sent to the provided email address.</p>
<p> </p>
<h3>Mail-Function</h3>
<h2><img src="<?php echo $sroot;?>/images/documentation/jevent_application_mail.png" border="0" alt="" width="496" height="420" /></h2>
<p>This is the application mail sent to the applicant upon signup to an event. If the admin or user cancels the application the system automatically sends an cancel email. The admins have the ability to resend this emails if needed (maybe after correction of details). The template of the mails can be edited in the admin area of jEvent. You can create a dynamic email with the use of html fix text and variable text fields.</p>
<p> </p>
<h3>List of applications</h3>
<h2><img src="<?php echo $sroot;?>/images/documentation/jevent_list_of_applications.png" border="0" alt="" width="518" height="254" /></h2>
<p>Here you see the list of all applications to an event. It presents the current applications as well as all aborted applications. This view is accessible for jEvent admins only. The admin has the possibility to edit the application data, cancel the application if needed or resend the application or cancel email to the applicant. The addresses in this view are also linked with google maps so you easily can find the given spot online.</p>