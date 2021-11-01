@extends('layouts.main')
@section('title', 'What\'s New? - Admin')
   
@section('content')

<div class="page-header">
	<h4 class="page-title">What's new?</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">What's new?</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="panel-group" id="releasenotes">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2114" aria-expanded="true">Version 21.1.4</a>
							</h4>
						</div>
						<div id="2114" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<ul>
									<li>- Updated license checker url</li>
									<li>- Updated dependencies</li>
									<li>- Updated checks for https</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2113" aria-expanded="true">Version 21.1.3</a>
							</h4>
						</div>
						<div id="2113" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li><strong>#19</strong> - UnexpectedValueException /app/Exceptions/Handler.php in LANMS\Exceptions\Handler::report</li>
									<li><strong>#15</strong> - Call to a member function setCookie() on null</li>
									<li><strong>#13</strong> - View::send does not exist</li>
								</ul>
								<h4>Other</h4>
								<ul>
									<li>- Added missing 419 error page</li>
									<li>- Updated 503 (maintenance mode) error page</li>
									<li>- Updated maintenance mode class</li>
									<li>- Other minor code improvements</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2112" aria-expanded="true">Version 21.1.2</a>
							</h4>
						</div>
						<div id="2112" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li><strong>#18</strong> - Undefined variable: errors (View: /vobilet/layouts/main.blade.php)</li>
									<li><strong>#15</strong> - Call to a member function setCookie() on null</li>
									<li><strong>#13</strong> - View::send does not exist</li>
								</ul>
								<h4>Notice</h4>
								<p>Bugs cannot be reported directly in the issue tracker anymore, we switched to Github. Got a issue, feature request or bug report? Contact us directly.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2111" aria-expanded="true">Version 21.1.1</a>
							</h4>
						</div>
						<div id="2111" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-491] - Security Update</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2110" aria-expanded="true">Version 21.1.0</a>
							</h4>
						</div>
						<div id="2110" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-491] - Security Update</li>
								</ul>
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-494] - Asset not found [plugins/datatable/responsive/js/datatables.responsive.min.js] in Theme [vobilet-admin]</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2027" aria-expanded="true">Version 20.2.7</a>
							</h4>
						</div>
						<div id="2027" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-492] - Illuminate\Database\QueryException /app/User.php in LANMS\User::scopeActive</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2026" aria-expanded="true">Version 20.2.6</a>
							</h4>
						</div>
						<div id="2026" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-483] - Add test email function in admin panel</li>
									<li>[LANMS-490] - Check when schedule last ran</li>
								</ul>
									
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-487] - Update birthday validation</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2025" aria-expanded="true">Version 20.2.5</a>
							</h4>
						</div>
						<div id="2025" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-479] - &#39;Whats new&#39; has features from newer versions</li>
									<li>[LANMS-481] - Numbers on error pages are not readable when in dark mode</li>
									<li>[LANMS-482] - Twilio\Exceptions\ConfigurationException admin-sms</li>
									<li>[LANMS-485] - Cartalyst\Stripe\Exception\NotFoundException admin</li>
								</ul>
									
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-484] - Add license last checked</li>
								</ul>
									
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-416] - Clean up old address entries, translations and functions</li>
									<li>[LANMS-486] - Tone down the unlicenced front end</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2024" aria-expanded="true">Version 20.2.4</a>
							</h4>
						</div>
						<div id="2024" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-473] - ErrorException admin-sms-create fatal SQLSTATE[HY000]: General error: 1525 Incorrect TIMESTAMP value</li>
									<li>[LANMS-474] - Sidebar in admin panel expands outside screen on mobile</li>
									<li>[LANMS-475] - ErrorException account-billing-card-store</li>
									<li>[LANMS-477] - Trying to get property &#39;id&#39; of non-object (View: /admin/crew/index.blade.php)</li>
								</ul>

								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-310] - 2FA via Twilio</li>
								</ul>
								
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-478] - Message when no ticket types</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#263" aria-expanded="true">Version 2.6.3</a>
							</h4>
						</div>
						<div id="263" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-465] - SQLSTATE[HY000]: General error: 1525 Incorrect TIMESTAMP value</li>
									<li>[LANMS-466] - Dashboard cards have scrollbar</li>
									<li>[LANMS-467] - Uncaught Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [609] second(s).</li>
									<li>[LANMS-469] - ErrorException consentform: Trying to access array offset on value of type null</li>
									</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-431] - ID - Identification-page</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-468] - Add user verifications in admin panel</li>
									<li>[LANMS-470] - Change sorting on prev compos</li>
									<li>[LANMS-471] - Hide &quot;needs more attendees&quot; after finished for compos</li>
									<li>[LANMS-472] - Add system time to &quot;System Info&quot;</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#262" aria-expanded="true">Version 2.6.2</a>
							</h4>
						</div>
						<div id="262" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-456] - Default role is missing sms permission</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-445] - Allow users to change username</li>
									<li>[LANMS-452] - Add previous compos page</li>
									<li>[LANMS-461] - Add restore &amp; duplicate to compos</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-455] - Test and check the admin panel on mobile</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-359] - Add possibility to add winners for compos</li>
									<li>[LANMS-457] - Add view buttons to compo in admin panel</li>
									<li>[LANMS-458] - Add address fields to users in admin panel</li>
									<li>[LANMS-460] - Show previous compos in admin panel</li>
									<li>[LANMS-462] - Show signups for compos for admins</li>
									<li>[LANMS-464] - Add more info to the license page</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#261" aria-expanded="true">Version 2.6.1</a>
							</h4>
						</div>
						<div id="261" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-448] - Row sorting on print page does not work</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-450] - Add age to edit user admin panel</li>
									<li>[LANMS-451] - Add match to toornament in compo</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-372] - Merge stripecust and user</li>
									<li>[LANMS-453] - Remove sponsors from widget sidebar</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#260" aria-expanded="true">Version 2.6.0</a>
							</h4>
						</div>
						<div id="260" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-249] - Remember me-function does not appear to work</li>
									<li>[LANMS-420] - Another user reserved seat; cannot pay</li>
									<li>[LANMS-423] - Missing card info on Charges-page</li>
									<li>[LANMS-425] - When editing page; &quot;Show in menu&quot; is checked by the &quot;active&quot; option</li>
									<li>[LANMS-430] - When editing sponsor and not editing image, image dissapears when saving</li>
									<li>[LANMS-433] - Reservation emails does not show name for website</li>
									<li>[LANMS-440] - Invoice notifications spammed every hour</li>
									<li>[LANMS-442] - Edit profile should remember last input if validation fails</li>
									<li>[LANMS-443] - Phone Country does not save when editing user in admin panel</li>
									<li>[LANMS-444] - When clicking view on a reservation it shows the reservation page</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-214] - Create a own ticket system, with several types of tickets</li>
									<li>[LANMS-301] - Twilio SMS Integration</li>
									<li>[LANMS-328] - Self Check-in</li>
									<li>[LANMS-421] - Add Grasrotandelen widget</li>
									<li>[LANMS-422] - Add delete/void function to invoices</li>
									<li>[LANMS-432] - Add reserved statuses widgets to admin dashboard</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-319] - Update Sentry SDK</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-311] - Phone verification via Twilio</li>
									<li>[LANMS-313] - Sort menu in admin </li>
									<li>[LANMS-373] - Create one setting for all currency</li>
									<li>[LANMS-409] - Renaming a row should reflect on seats</li>
									<li>[LANMS-415] - Merge address into user, only one address per user</li>
									<li>[LANMS-418] - Add &quot;Send&quot; to invoices</li>
									<li>[LANMS-424] - Sort pages by the alphabet in the menu</li>
									<li>[LANMS-426] - Remove &quot;User&quot;/&quot;Dashboard&quot;-page</li>
									<li>[LANMS-427] - Admin: Allow more than one reservation on one user</li>
									<li>[LANMS-428] - Enable days for google calendar</li>
									<li>[LANMS-429] - Add support for Toornament in compos</li>
									<li>[LANMS-434] - Remove old settings</li>
									<li>[LANMS-437] - Show deleted pages and add restore</li>
									<li>[LANMS-441] - Make pdf files download instead of stream</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2513" aria-expanded="true">Version 2.5.13</a>
							</h4>
						</div>
						<div id="2513" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-417] - Seatmap in admin panel does not have sort order for rows</li>
									<li>[LANMS-419] - User gets notifications on voided invoices</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2512" aria-expanded="true">Version 2.5.12</a>
							</h4>
						</div>
						<div id="2512" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-406] - Cartalyst\Stripe\Exception\InvalidRequestException: Your card does not support this type of purchase.</li>
									<li>[LANMS-407] - User cannot reserve seat when a invoice is voided</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-408] - Add sort order to rows in admin panel</li>
									<li>[LANMS-410] - No red unpaid text on voided invoices</li>
									<li>[LANMS-411] - Allow signed integers for invoices</li>
									<li>[LANMS-412] - Send names to stripe</li>
									<li>[LANMS-414] - Add &quot;Reservations left&quot; in seating</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2511" aria-expanded="true">Version 2.5.11</a>
							</h4>
						</div>
						<div id="2511" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-403] - Missing translation for invoice</li>
								</ul>
								    
								<h4>New Feature</h4>
									<ul>
									<li>[LANMS-399] - Add first signup time to compo</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-401] - Add preferred clothing size to users</li>
									<li>[LANMS-402] - Add allow entrance payment to ticket types</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#2510" aria-expanded="true">Version 2.5.10</a>
							</h4>
						</div>
						<div id="2510" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-397] - Symfony\Component\Debug\Exception\FatalErrorException: Uncaught InvalidArgumentException: Route [home] not defined.</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-398] - Add types of tickets
</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-400] - Change consent form age
</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#259" aria-expanded="true">Version 2.5.9</a>
							</h4>
						</div>
						<div id="259" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-396] - ErrorException: Call to a member function composignups() on null</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-308] - Compo: Cancel Signup</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-281] - Add max/min signups for compo</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#258" aria-expanded="true">Version 2.5.8</a>
							</h4>
						</div>
						<div id="258" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-383] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;LANMS\Console\Commands\DB&#39; not found</li>
									<li>[LANMS-384] - ErrorException: Undefined variable: webpath_light</li>
									<li>[LANMS-385] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;LANMS\Notifications\InvoiceUnPaid&#39; not found</li>
									<li>[LANMS-386] - Cannot reserve seat in admin panel</li>
									<li>[LANMS-387] - Cannot reserve seat from frontend</li>
									<li>[LANMS-391] - Symfony\Component\Debug\Exception\FatalThrowableError: Call to a member function routeNotificationFor() on string</li>
									<li>[LANMS-394] - Change payment button is not showing</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-390] - User API-endpoint with tickets, and more</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-381] - Improve card design for articles</li>
									<li>[LANMS-382] - Improve design on all admin pages</li>
									<li>[LANMS-388] - Add logging to seat ticket and reservation</li>
									<li>[LANMS-392] - Update print seat pdf</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#257" aria-expanded="true">Version 2.5.7</a>
							</h4>
						</div>
						<div id="257" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-349] - Mass emails does not render HTML</li>
									<li>[LANMS-350] - ErrorException: Trying to get property &#39;firstname&#39; of non-object</li>
									<li>[LANMS-351] - ErrorException: Trying to get property &#39;firstname&#39; of non-object</li>
									<li>[LANMS-361] - ErrorException: Notice: Trying to get property &#39;name&#39; of non-object</li>
									<li>[LANMS-363] - Cartalyst\Stripe\Exception\MissingParameterException</li>
									<li>[LANMS-364] - You cannot use the test ID &#39;pm_card_visa&#39; in livemode</li>
									<li>[LANMS-367] - Light logo is shown on ticket (white bg)</li>
									<li>[LANMS-375] - ErrorException: Trying to get property &#39;id&#39; of non-object</li>
									<li>[LANMS-376] - ErrorException: Notice: Trying to get property &#39;id&#39; of non-object</li>
									<li>[LANMS-379] - Cartalyst\Stripe\Exception\CardErrorException: Your card was declined.</li>
									<li>[LANMS-380] - ErrorException: Trying to get property &#39;theme&#39; of non-object</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-360] - Notification system</li>
									<li>[LANMS-369] - Add support for dark and light images for sponsors</li>
									<li>[LANMS-370] - Add a easy way to toggle dark/light theme</li>
									<li>[LANMS-371] - Show sponsors from past year with dupe btn</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-344] - Add prize pool to compo</li>
									<li>[LANMS-346] - Add automatic version update</li>
									<li>[LANMS-347] - Improvements on license checking</li>
									<li>[LANMS-348] - Refresh permissions should set permission to true for superadmin role</li>
									<li>[LANMS-352] - Add &quot;please wait&quot; on mass-email</li>
									<li>[LANMS-355] - Add validation for admin input to compo</li>
									<li>[LANMS-357] - User should not be able to delete or edit team if signed up to a compo</li>
									<li>[LANMS-358] - Unpaid invoices: Notification &amp; Reservations</li>
									<li>[LANMS-362] - Show deleted and add restore for rows and seats</li>
									<li>[LANMS-365] - Add description to settings</li>
									<li>[LANMS-374] - Improve address translation</li>
									<li>[LANMS-377] - Add setting for disabling consent form in header</li>
									<li>[LANMS-378] - Change the text on consent form about age restrictions</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#256" aria-expanded="true">Version 2.5.6</a>
							</h4>
						</div>
						<div id="256" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-336] - Send emails to users from admin panel</li>
									<li>[LANMS-337] - System Info</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-342] - Update Sentry to version 1.3.0</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-333] - Implement news categories</li>
									<li>[LANMS-338] - Add description to info items</li>
									<li>[LANMS-339] - User already added to crew should not be listed on create crew page</li>
									<li>[LANMS-340] - Add command to refresh permissions for roles</li>
									<li>[LANMS-341] - Add warnings for env setting</li>
									<li>[LANMS-345] - Add update command</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#255" aria-expanded="true">Version 2.5.5</a>
							</h4>
						</div>
						<div id="255" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-329] - General error: Field &#39;about&#39; doesn&#39;t have a default value</li>
									<li>[LANMS-335] - Update translation for profile</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-272] - Add possibility to edit permissions for users</li>
									<li>[LANMS-320] - Custom seating CSS from admin panel</li>
									<li>[LANMS-321] - Add Stripe PaymentIntent (SCA)</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-323] - Update to L5.8</li>
									<li>[LANMS-326] - Crew Skill Badge view in admin panel</li>
									<li>[LANMS-327] - Improve dashboard design</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#254" aria-expanded="true">Version 2.5.4</a>
							</h4>
						</div>
						<div id="254" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-140] - InvalidArgumentException: Malformed UTF-8 characters, possibly incorrectly encoded</li>
									<li>[LANMS-305] - ErrorException: Warning: unlink(/home/downlinkdg/repositories/lanms/storage/framework/down): No such file or dire...</li>
									<li>[LANMS-312] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[LANMS-316] - News article does not throw 404 when article does not exist</li>
									<li>[LANMS-322] - Reserving a seat is not working</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-273] - Rows; &quot;Create X amount of seats&quot; when creating a row</li>
									<li>[LANMS-288] - Reset password for user via admin panel</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-240] - Add logging to more than just users</li>
									<li>[LANMS-280] - Seatmap in checkin, with own colors for checked in seats</li>
									<li>[LANMS-283] - Blank consent form more easily available</li>
									<li>[LANMS-284] - Compo to be moved to public</li>
									<li>[LANMS-306] - Add more user info in the adminpanel</li>
									<li>[LANMS-307] - Resend activation email for user via admin panel</li>
									<li>[LANMS-309] - Add cleanup command for activity log</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#253" aria-expanded="true">Version 2.5.3</a>
							</h4>
						</div>
						<div id="253" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-278] - Email title not translated</li>
									<li>[LANMS-282] - Sometimes tickets gets 1970 year</li>
									<li>[LANMS-285] - Admin page for sponsors shows sponsors for prev year</li>
									<li>[LANMS-290] - Sponsors show all on admin page</li>
									<li>[LANMS-294] - Changing users phone, language or theme does not save</li>
									<li>[LANMS-318] - InvalidArgumentException: A two digit month could not be found</li>
									<li>[LANMS-325] - InvalidArgumentException: Trailing data</li>
									<li>[LANMS-330] - InvalidArgumentException: Data missing</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-289] - Invoice system</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-279] - Add addresses to users in admin panel</li>
									<li>[LANMS-292] - Add anonymized badge to users in admin panel</li>
									<li>[LANMS-293] - Make address2-field required</li>
									<li>[LANMS-295] - Add about-field to user in admin panel</li>
									<li>[LANMS-296] - Improve order of tables in admin panel</li>
									<li>[LANMS-297] - Implement Stripe Cards</li>
									<li>[LANMS-300] - Update the browser icon</li>
									<li>[LANMS-304] - Change dates in admin panel for table sorting</li>
									<li>[LANMS-331] - Allow spaces in names</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#252" aria-expanded="true">Version 2.5.2</a>
							</h4>
						</div>
						<div id="252" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-247] - Reserved status is not translated</li>
									<li>[LANMS-248] - Charge status from Stripe is not translated</li>
									<li>[LANMS-269] - Alert showing html in seating</li>
									<li>[LANMS-271] - Select2 has dark theme</li>
									<li>[LANMS-274] - Referral count does not show correctly</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-13] - Create Team System</li>
									<li>[LANMS-18] - Create Compo System</li>
									<li>[LANMS-270] - Add a own sponsor page</li>
									<li>[LANMS-275] - Compo Signup System</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-254] - Add &quot;admin buttons&quot; on news, pages etc</li>
									<li>[LANMS-265] - Autocomplete fields should be easier to use</li>
									<li>[LANMS-267] - Improve design of license page</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#251">Version 2.5.1</a>
							</h4>
						</div>
						<div id="251" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-251] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;Vsmoraes\Pdf\PdfFacade&#39; not found
									<li>[LANMS-252] - Posting news to social media generates wrong link
									<li>[LANMS-261] - If no birthdate is filled, it throws an error
									<li>[LANMS-262] - Slugs isn&#39;t always created or updated
									<li>[LANMS-263] - Seatmap is not sizing correctly
									<li>[LANMS-264] - User can change payment after expiry
									<li>[LANMS-266] - Phone is not being saved on signup page</li>
								</ul>

								<h4>Task</h4>
								<ul>
									<li>[LANMS-257] - Delete old themes and files
									<li>[LANMS-258] - Change agreement when reserving
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-190] - Update the Admin UI
									<li>[LANMS-238] - Improve the check-in process for the person checking in attendees
									<li>[LANMS-250] - Add chevron/caret down to user over menu
									<li>[LANMS-255] - Improve crew and skill attachment
									<li>[LANMS-256] - Change from label to class in crew skill
									<li>[LANMS-259] - Add theme selection for users
									<li>[LANMS-260] - Sort info pages on title
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#250">Version 2.5.0</a>
							</h4>
						</div>
						<div id="250" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-217] - Chosen file does not appear in input field</li>
									<li>[LANMS-221] - Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry</li>
									<li>[LANMS-222] - ErrorException: Route [home] not defined. (View: /home/downlinkdg/repositories/lanms/resources/views/vobilet/erro...</li>
									<li>[LANMS-223] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[LANMS-241] - Non-active, deleted, etc users is in ajax calls</li>
									<li>[LANMS-242] - AJAX is available without being logged in</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-211] - Add Translation Support</li>
									<li>[LANMS-219] - Add calendar/schedule system</li>
									<li>[LANMS-244] - Add Discord widget</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-216] - Add Norwegian translation</li>
									<li>[LANMS-218] - Update time/date formatting to use Carbon</li>
									<li>[LANMS-226] - Add phone number to users</li>
									<li>[LANMS-227] - Add last activity to members list</li>
									<li>[LANMS-232] - GDPR: Users with no activity for the last 3 years will be anonymized</li>
									<li>[LANMS-235] - Add user preference on language</li>
									<li>[LANMS-239] - Improve user input with old on profile</li>
									<li>[LANMS-243] - Add discord link to footer</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#244">Version 2.4.4</a>
							</h4>
						</div>
						<div id="244" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-245] - Exception: DateTime::__construct(): Failed to parse time string (2004-28-05) at position 6 (8): Unexpected c...</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#243">Version 2.4.3</a>
							</h4>
						</div>
						<div id="243" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-229] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[LANMS-231] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[LANMS-236] - Searching users does not work anymore</li>
								</ul>    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-230] - Allow admins to view ticket</li>
									<li>[LANMS-237] - Add age check on birthdate fields</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#242">Version 2.4.2</a>
							</h4>
						</div>
						<div id="242" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-193] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;App\User&#39; not found</li>
									<li>[LANMS-215] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-196] - Post to social medias when posting news</li>
									<li>[LANMS-212] - Command for deleting non-activated users</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#241">Version 2.4.1</a>
							</h4>
						</div>
						<div id="241" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-191] - ErrorException: Trying to get property of non-object</li>
									<li>[LANMS-192] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/n...</li>
									<li>[LANMS-194] - InvalidArgumentException: Route [account-recover] not defined.</li>
									<li>[LANMS-197] - Randomly showing &quot;Could not find seat&quot; in seating</li>
									<li>[LANMS-198] - Some users can see other users charges</li>
									<li>[LANMS-199] - ErrorException: Missing required parameters for [Route: user-profile] [URI: user/profile/{username}]. (View: /hom...</li>
									<li>[LANMS-201] - Crew Skills is showing wrongly</li>
									<li>[LANMS-207] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/n...</li>
									<li>[LANMS-210] - ErrorException: Undefined index: old</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-205] - Add support for Facebook Messenger</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-195] - Capture User in Sentry</li>
									<li>[LANMS-202] - Sort order for Sponsors</li>
									<li>[LANMS-203] - Rework the header on mobile</li>
									<li>[LANMS-206] - Add error pages to user UI</li>
									<li>[LANMS-209] - Pizza badge</li>
									<li>[LANMS-213] - Lastname cant contain spaces, it should be possible</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#240">Version 2.4.0</a>
							</h4>
						</div>
						<div id="240" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-155] - Illuminate\Http\Exceptions\PostTooLargeException</li>
									<li>[LANMS-174] - When user has been on the login page for a while; the token expires</li>
									<li>[LANMS-176] - SignedInNotSupported Error from Google Maps API</li>
									<li>[LANMS-178] - Undefined variable: currentseat</li>
									<li>[LANMS-179] - Class &#39;Vsmoraes\Pdf\PdfFacade&#39; not found</li>
									<li>[LANMS-186] - Trying to get property &#39;username&#39; of non-object</li>
									<li>[LANMS-188] - When searching for users it shows inactive users</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-19] - User administration</li>
									<li>[LANMS-24] - Receipt for ticket</li>
									<li>[LANMS-88] - Add system for rows and seats</li>
									<li>[LANMS-111] - License Checker</li>
									<li>[LANMS-158] - Let users see payments and charges made</li>
									<li>[LANMS-164] - A list of reservations made</li>
									<li>[LANMS-175] - Add activity logging</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-71] - Admin should be able to set payment to entrance for temp reserved seats</li>
									<li>[LANMS-159] - Cleanup routes for user/account</li>
									<li>[LANMS-161] - New account and dashboard pages</li>
									<li>[LANMS-162] - New design improvement for save buttons</li>
									<li>[LANMS-163] - Add a interactive card for payments</li>
									<li>[LANMS-173] - GDPR: Cookie Notice</li>
									<li>[LANMS-180] - GDPR: Users can easily request deletion of their personal data</li>
									<li>[LANMS-181] - GDPR: If you process children&#39;s personal data, verify their age and ask consent from their legal guardian</li>
									<li>[LANMS-182] - GDPR: Add a General Privacy Policy</li>
									<li>[LANMS-183] - GDPR: Add a General Terms and Conditions</li>
									<li>[LANMS-184] - Update the user UI</li>
									<li>[LANMS-185] - GDPR: Users can easily download their personal data</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#236">Version 2.3.6</a>
							</h4>
						</div>
						<div id="236" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-160] - Cartalyst\Stripe\Exception\CardErrorException: Your card&#39;s security code is incorrect.</li>
									<li>[LANMS-167] - DOMPDF_Exception: No block-level parent found.  Not good.</li>
									<li>[LANMS-168] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [7...</li>
									<li>[LANMS-169] - ErrorException: Trying to get property of non-object</li>
									<li>[LANMS-170] - ErrorException: Undefined variable: currentseat</li>
									<li>[LANMS-171] - ErrorException: Undefined variable: currentseat</li>
									<li>[LANMS-172] - ErrorException: Undefined variable: currentseat</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#235">Version 2.3.5</a>
							</h4>
						</div>
						<div id="235" class="panel-collapse collapse">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-154] - User could not change the payment</li>
									<li>[LANMS-156] - Payment takes &quot;Default Card&quot; and not the card that was entered</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-111] - License Checker</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-157] - Reserve seat in admin panel has wrong name format</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#234" aria-expanded="true">Version 2.3.4</a>
							</h4>
						</div>
						<div id="234" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-153] - Pages does not appear in menu anymore</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#233" aria-expanded="true">Version 2.3.3</a>
							</h4>
						</div>
						<div id="233" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-151] - Payment does not proceed</li>
									<li>[LANMS-152] - Payment: ErrorException: Trying to get property of non-object</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#232" aria-expanded="true">Version 2.3.2</a>
							</h4>
						</div>
						<div id="232" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-144] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-87] - Timeline for profile</li>
									<li>[LANMS-116] - &quot;Pay now&quot;-button should have a loading animation</li>
									<li>[LANMS-147] - Names should be able contain norwegian letters</li>
									<li>[LANMS-148] - https setting is not enforcing https</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#231" aria-expanded="true">Version 2.3.1</a>
							</h4>
						</div>
						<div id="231" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-97] - Email logo needs fixing</li>
									<li>[LANMS-134] - UnexpectedValueException: The Response content must be a string or object implementing __toString(), &quot;boolean&quot; given.</li>
									<li>[LANMS-142] - Swift_TransportException: Connection could not be established with host mani.infihex.com [ #0]</li>
									<li>[LANMS-144] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
									<li>[LANMS-145] - ErrorException: Argument 1 passed to Cartalyst\Sentinel\Reminders\IlluminateReminderRepository::complete() must i...</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-146] - Remove &quot;Featured Image&quot; from news until it is implemented</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-141] - User must have an birthday</li>
									<li>[LANMS-143] - Gender equality</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#230" aria-expanded="true">Version 2.3.0</a>
							</h4>
						</div>
						<div id="230" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-108] - ErrorException: Trying to get property of non-object (View: /lanms2/resources/views/neon-admin/seating/checkin/index.blade.php)</li>
									<li>[LANMS-109] - Ticket should not be deleted if user has checked in</li>
									<li>[LANMS-113] - One address, no primary</li>
									<li>[LANMS-125] - Other users can reserve seats on a user with a seat reserved</li>
									<li>[LANMS-127] - Reminder email for seat reservations does not send at 24 hours</li>
									<li>[LANMS-131] - Wrong format of names in seating</li>
									<li>[LANMS-132] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
									<li>[LANMS-133] - InvalidArgumentException: View [errors.500] not found.</li>
									<li>[LANMS-135] - Symfony\Component\Debug\Exception\FatalErrorException: Uncaught exception &#39;BadMethodCallException&#39; with message &#39;Method Cartalyst\Sentinel\Sentinel::has...</li>
									<li>[LANMS-136] - Redirected to seating when i try to go to broken bands</li>
									<li>[LANMS-138] - Symfony\Component\Debug\Exception\FatalErrorException: Class &#39;LANMS\Exceptions\HttpException&#39; not found</li>
									<li>[LANMS-139] - File-input covers the whole page</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-6] - Create Sponsor System</li>
									<li>[LANMS-70] - Reserve seats from admin panel</li>
									<li>[LANMS-77] - &quot;Broken band&quot; page</li>
									<li>[LANMS-80] - Crew system, with skills attached</li>
									<li>[LANMS-85] - Info system</li>
									<li>[LANMS-111] - License Checker</li>
									<li>[LANMS-119] - Samtykkeskjema på nett</li>
									<li>[LANMS-128] - Add &quot;What&#39;s new?&quot; view</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-110] - Upgrade Laravel</li>
									<li>[LANMS-123] - Move &quot;Print&quot; under seating</li>
									<li>[LANMS-124] - Move settings, logs &amp; license under &quot;System&quot;</li>
									<li>[LANMS-129] - Move Logs into the admin panel design</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-61] - Add Seatmap for seating in admin panel</li>
									<li>[LANMS-75] - Search for members userend</li>
									<li>[LANMS-87] - Timeline for profile</li>
									<li>[LANMS-91] - Admin Dashboard</li>
									<li>[LANMS-101] - Add ticket view for admin</li>
									<li>[LANMS-104] - Resend verification email</li>
									<li>[LANMS-116] - &quot;Pay now&quot;-button should have a loading animation</li>
									<li>[LANMS-120] - Remove 12yo requirement</li>
									<li>[LANMS-126] - Convert old cron_jobs to commands</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#221" aria-expanded="true">Version 2.2.1</a>
							</h4>
						</div>
						<div id="221" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-97] - Email logo needs fixing</li>
									<li>[LANMS-98] - Date field on mobile can be buggy</li>
									<li>[LANMS-102] - Kommer det opp &quot;you cant view this ticket&quot;</li>
									<li>[LANMS-103] - Design does not work on iPhone</li>
									<li>[LANMS-105] - Symfony\Component\Debug\Exception\FatalErrorException: Call to a member function inRole() on a non-object</li>
									<li>[LANMS-106] - Illuminate\Session\TokenMismatchException</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-99] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [2...</li>
									<li>[LANMS-100] - Cartalyst\Stripe\Exception\CardErrorException: Your card number is incorrect.</li>
									<li>[LANMS-107] - You should be able to see seatmap when closed</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#220" aria-expanded="true">Version 2.2.0</a>
							</h4>
						</div>
						<div id="220" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-98] - Date field on mobile can be buggy</li>
									<li>[LANMS-102] - Kommer det opp &quot;you cant view this ticket&quot;</li>
									<li>[LANMS-103] - Design does not work on iPhone</li>
									<li>[LANMS-105] - Symfony\Component\Debug\Exception\FatalErrorException: Call to a member function inRole() on a non-object</li>
									<li>[LANMS-106] - Illuminate\Session\TokenMismatchException</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-99] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [2...</li>
									<li>[LANMS-100] - Cartalyst\Stripe\Exception\CardErrorException: Your card number is incorrect.</li>
									<li>[LANMS-107] - You should be able to see seatmap when closed</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#215" aria-expanded="true">Version 2.1.5</a>
							</h4>
						</div>
						<div id="215" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-54] - Members page should not show non active users</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-76] - List for non-checkedin reservations</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#214" aria-expanded="true">Version 2.1.4</a>
							</h4>
						</div>
						<div id="214" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-74] - Ticket ID on reservation table</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-81] - Add setting for disabling login for users</li>
									<li>[LANMS-82] - Need to hide seating from menu</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#213" aria-expanded="true">Version 2.1.3</a>
							</h4>
						</div>
						<div id="213" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-72] - Print outs for seats in admin panel</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#212" aria-expanded="true">Version 2.1.2</a>
							</h4>
						</div>
						<div id="212" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-69] - Reservation count for api is counting crew seats</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#211" aria-expanded="true">Version 2.1.1</a>
							</h4>
						</div>
						<div id="211" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-68] - Seating info, cant download ticket when closed and more</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#210" aria-expanded="true">Version 2.1.0</a>
							</h4>
						</div>
						<div id="210" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-64] - All Users have 30 reserved seats</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-65] - Check-in</li>
									<li>[LANMS-67] - Output data in JSON</li>
								</ul>
								
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-61] - Add Seatmap for seating in admin panel</li>
								</ul>
								    
								<h4>Sub-task</h4>
								<ul>
									<li>[LANMS-66] - Visitor check-in</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#205" aria-expanded="true">Version 2.0.5</a>
							</h4>
						</div>
						<div id="205" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-63] - Google Analytics</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#204" aria-expanded="true">Version 2.0.4</a>
							</h4>
						</div>
						<div id="204" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-62] - Delete reservations in admin panel</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#203" aria-expanded="true">Version 2.0.3</a>
							</h4>
						</div>
						<div id="203" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-41] - User registration/login problems in all browsers</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#202" aria-expanded="true">Version 2.0.2</a>
							</h4>
						</div>
						<div id="202" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-36] - Capital letters does not work in email on registration</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-55] - Admin panel: Change reservations</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-56] - Create ENV setting for stripe key</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-53] - Update seat info about user</li>
									<li>[LANMS-58] - Add more info about rules for reservation</li>
									<li>[LANMS-59] - Frontend needs css improvements</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#201" aria-expanded="true">Version 2.0.1</a>
							</h4>
						</div>
						<div id="201" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-29] - Missing Assets</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-42] - User should be able remove reservation if selected pay at entrance</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[LANMS-37] - Change mail settings for prod</li>
								</ul>
								   
								<h4>Improvement</h4>
								<ul>
									<li>[LANMS-52] - Users should be able to see seats reserved to them</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#releasenotes" href="#200" aria-expanded="true">Version 2.0.0</a>
							</h4>
						</div>
						<div id="200" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[LANMS-14] - User::hasAdminAccess-Scope does not work</li>
									<li>[LANMS-21] - News bug</li>
									<li>[LANMS-22] - Deleting primary adress does not set another primary</li>
									<li>[LANMS-25] - Profilepicturesmall does not save in db on upload</li>
									<li>[LANMS-26] - Fix userdetails request</li>
									<li>[LANMS-30] - Can&#39;t have spaces in address</li>
									<li>[LANMS-32] - Some dates does not work on registration (some browsers)</li>
									<li>[LANMS-33] - Addres cant understand special caracters like æøå</li>
									<li>[LANMS-35] - News and Article pages throw 500</li>
									<li>[LANMS-38] - On registration if email exists it gives 500</li>
									<li>[LANMS-39] - Wrong username in activation screen makes it not work</li>
									<li>[LANMS-40] - 2 Feil på &quot;Add address</li>
									<li>[LANMS-44] - Logout button gone on mobile</li>
									<li>[LANMS-45] - All users 46 years old</li>
									<li>[LANMS-46] - Location wrong</li>
									<li>[LANMS-47] - Admin Page-siden getUsernameByID needs to be removed</li>
									<li>[LANMS-48] - Refferal link does not work</li>
									<li>[LANMS-49] - Adressbook create does not rember input</li>
									<li>[LANMS-50] - Chrome says &quot;Please enter a valid date.&quot; when date is valid</li>
									<li>[LANMS-51] - Fix birthdate in db and templates</li>
								</ul>

								<h4>New Feature</h4>
								<ul>
									<li>[LANMS-2] - Implement Frontend Design</li>
									<li>[LANMS-3] - Create Page System</li>
									<li>[LANMS-5] - Create Seating System</li>
									<li>[LANMS-7] - Create Addressbook for users</li>
									<li>[LANMS-9] - &quot;Now&quot;-button in Publish setting on news admin</li>
									<li>[LANMS-10] - Add unique ID for each user (random generated)</li>
									<li>[LANMS-11] - Migration from 1.0</li>
									<li>[LANMS-15] - Autocomplete Address</li>
									<li>[LANMS-16] - Ajax Usernames</li>
									<li>[LANMS-17] - Create Referral System</li>
									<li>[LANMS-28] - Error Emails to Dev</li>
								</ul>

								<h4>Task</h4>
								<ul>
									<li>[LANMS-4] - Finish Settings System</li>
									<li>[LANMS-20] - Add error messages to form admin</li>
									<li>[LANMS-27] - Add relationships for author and news</li>
									<li>[LANMS-31] - Check thru DB changes from 1.0 to 2.0</li>
									<li>[LANMS-34] - Terms of Service &amp; Privacy Policy</li>
									<li>[LANMS-43] - Update and test email templates</li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@stop