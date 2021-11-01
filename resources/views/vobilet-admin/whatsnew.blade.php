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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-491'>LANMS-491</a>] - Security Update</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-491'>LANMS-491</a>] - Security Update</li>
								</ul>
								<h4>Bug</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-494'>LANMS-494</a>] - Asset not found [plugins/datatable/responsive/js/datatables.responsive.min.js] in Theme [vobilet-admin]</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-492'>LANMS-492</a>] - Illuminate\Database\QueryException /app/User.php in LANMS\User::scopeActive</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-483'>LANMS-483</a>] - Add test email function in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-490'>LANMS-490</a>] - Check when schedule last ran</li>
								</ul>
									
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-487'>LANMS-487</a>] - Update birthday validation</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-479'>LANMS-479</a>] - &#39;Whats new&#39; has features from newer versions</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-481'>LANMS-481</a>] - Numbers on error pages are not readable when in dark mode</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-482'>LANMS-482</a>] - Twilio\Exceptions\ConfigurationException admin-sms</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-485'>LANMS-485</a>] - Cartalyst\Stripe\Exception\NotFoundException admin</li>
								</ul>
									
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-484'>LANMS-484</a>] - Add license last checked</li>
								</ul>
									
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-416'>LANMS-416</a>] - Clean up old address entries, translations and functions</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-486'>LANMS-486</a>] - Tone down the unlicenced front end</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-473'>LANMS-473</a>] - ErrorException admin-sms-create fatal SQLSTATE[HY000]: General error: 1525 Incorrect TIMESTAMP value</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-474'>LANMS-474</a>] - Sidebar in admin panel expands outside screen on mobile</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-475'>LANMS-475</a>] - ErrorException account-billing-card-store</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-477'>LANMS-477</a>] - Trying to get property &#39;id&#39; of non-object (View: /admin/crew/index.blade.php)</li>
								</ul>

								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-310'>LANMS-310</a>] - 2FA via Twilio</li>
								</ul>
								
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-478'>LANMS-478</a>] - Message when no ticket types</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-465'>LANMS-465</a>] - SQLSTATE[HY000]: General error: 1525 Incorrect TIMESTAMP value</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-466'>LANMS-466</a>] - Dashboard cards have scrollbar</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-467'>LANMS-467</a>] - Uncaught Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [609] second(s).</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-469'>LANMS-469</a>] - ErrorException consentform: Trying to access array offset on value of type null</li>
									</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-431'>LANMS-431</a>] - ID - Identification-page</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-468'>LANMS-468</a>] - Add user verifications in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-470'>LANMS-470</a>] - Change sorting on prev compos</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-471'>LANMS-471</a>] - Hide &quot;needs more attendees&quot; after finished for compos</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-472'>LANMS-472</a>] - Add system time to &quot;System Info&quot;</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-456'>LANMS-456</a>] - Default role is missing sms permission</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-445'>LANMS-445</a>] - Allow users to change username</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-452'>LANMS-452</a>] - Add previous compos page</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-461'>LANMS-461</a>] - Add restore &amp; duplicate to compos</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-455'>LANMS-455</a>] - Test and check the admin panel on mobile</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-359'>LANMS-359</a>] - Add possibility to add winners for compos</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-457'>LANMS-457</a>] - Add view buttons to compo in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-458'>LANMS-458</a>] - Add address fields to users in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-460'>LANMS-460</a>] - Show previous compos in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-462'>LANMS-462</a>] - Show signups for compos for admins</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-464'>LANMS-464</a>] - Add more info to the license page</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-448'>LANMS-448</a>] - Row sorting on print page does not work</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-450'>LANMS-450</a>] - Add age to edit user admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-451'>LANMS-451</a>] - Add match to toornament in compo</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-372'>LANMS-372</a>] - Merge stripecust and user</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-453'>LANMS-453</a>] - Remove sponsors from widget sidebar</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-249'>LANMS-249</a>] - Remember me-function does not appear to work</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-420'>LANMS-420</a>] - Another user reserved seat; cannot pay</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-423'>LANMS-423</a>] - Missing card info on Charges-page</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-425'>LANMS-425</a>] - When editing page; &quot;Show in menu&quot; is checked by the &quot;active&quot; option</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-430'>LANMS-430</a>] - When editing sponsor and not editing image, image dissapears when saving</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-433'>LANMS-433</a>] - Reservation emails does not show name for website</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-440'>LANMS-440</a>] - Invoice notifications spammed every hour</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-442'>LANMS-442</a>] - Edit profile should remember last input if validation fails</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-443'>LANMS-443</a>] - Phone Country does not save when editing user in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-444'>LANMS-444</a>] - When clicking view on a reservation it shows the reservation page</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-214'>LANMS-214</a>] - Create a own ticket system, with several types of tickets</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-301'>LANMS-301</a>] - Twilio SMS Integration</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-328'>LANMS-328</a>] - Self Check-in</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-421'>LANMS-421</a>] - Add Grasrotandelen widget</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-422'>LANMS-422</a>] - Add delete/void function to invoices</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-432'>LANMS-432</a>] - Add reserved statuses widgets to admin dashboard</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-319'>LANMS-319</a>] - Update Sentry SDK</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-311'>LANMS-311</a>] - Phone verification via Twilio</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-313'>LANMS-313</a>] - Sort menu in admin </li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-373'>LANMS-373</a>] - Create one setting for all currency</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-409'>LANMS-409</a>] - Renaming a row should reflect on seats</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-415'>LANMS-415</a>] - Merge address into user, only one address per user</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-418'>LANMS-418</a>] - Add &quot;Send&quot; to invoices</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-424'>LANMS-424</a>] - Sort pages by the alphabet in the menu</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-426'>LANMS-426</a>] - Remove &quot;User&quot;/&quot;Dashboard&quot;-page</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-427'>LANMS-427</a>] - Admin: Allow more than one reservation on one user</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-428'>LANMS-428</a>] - Enable days for google calendar</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-429'>LANMS-429</a>] - Add support for Toornament in compos</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-434'>LANMS-434</a>] - Remove old settings</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-437'>LANMS-437</a>] - Show deleted pages and add restore</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-441'>LANMS-441</a>] - Make pdf files download instead of stream</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-417'>LANMS-417</a>] - Seatmap in admin panel does not have sort order for rows</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-419'>LANMS-419</a>] - User gets notifications on voided invoices</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-406'>LANMS-406</a>] - Cartalyst\Stripe\Exception\InvalidRequestException: Your card does not support this type of purchase.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-407'>LANMS-407</a>] - User cannot reserve seat when a invoice is voided</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-408'>LANMS-408</a>] - Add sort order to rows in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-410'>LANMS-410</a>] - No red unpaid text on voided invoices</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-411'>LANMS-411</a>] - Allow signed integers for invoices</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-412'>LANMS-412</a>] - Send names to stripe</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-414'>LANMS-414</a>] - Add &quot;Reservations left&quot; in seating</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-403'>LANMS-403</a>] - Missing translation for invoice</li>
								</ul>
								    
								<h4>New Feature</h4>
									<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-399'>LANMS-399</a>] - Add first signup time to compo</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-401'>LANMS-401</a>] - Add preferred clothing size to users</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-402'>LANMS-402</a>] - Add allow entrance payment to ticket types</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-397'>LANMS-397</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Uncaught InvalidArgumentException: Route [home] not defined.</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-398'>LANMS-398</a>] - Add types of tickets
</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-400'>LANMS-400</a>] - Change consent form age
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-396'>LANMS-396</a>] - ErrorException: Call to a member function composignups() on null</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-308'>LANMS-308</a>] - Compo: Cancel Signup</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-281'>LANMS-281</a>] - Add max/min signups for compo</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-383'>LANMS-383</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;LANMS\Console\Commands\DB&#39; not found</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-384'>LANMS-384</a>] - ErrorException: Undefined variable: webpath_light</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-385'>LANMS-385</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;LANMS\Notifications\InvoiceUnPaid&#39; not found</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-386'>LANMS-386</a>] - Cannot reserve seat in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-387'>LANMS-387</a>] - Cannot reserve seat from frontend</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-391'>LANMS-391</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Call to a member function routeNotificationFor() on string</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-394'>LANMS-394</a>] - Change payment button is not showing</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-390'>LANMS-390</a>] - User API-endpoint with tickets, and more</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-381'>LANMS-381</a>] - Improve card design for articles</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-382'>LANMS-382</a>] - Improve design on all admin pages</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-388'>LANMS-388</a>] - Add logging to seat ticket and reservation</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-392'>LANMS-392</a>] - Update print seat pdf</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-349'>LANMS-349</a>] - Mass emails does not render HTML</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-350'>LANMS-350</a>] - ErrorException: Trying to get property &#39;firstname&#39; of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-351'>LANMS-351</a>] - ErrorException: Trying to get property &#39;firstname&#39; of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-361'>LANMS-361</a>] - ErrorException: Notice: Trying to get property &#39;name&#39; of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-363'>LANMS-363</a>] - Cartalyst\Stripe\Exception\MissingParameterException</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-364'>LANMS-364</a>] - You cannot use the test ID &#39;pm_card_visa&#39; in livemode</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-367'>LANMS-367</a>] - Light logo is shown on ticket (white bg)</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-375'>LANMS-375</a>] - ErrorException: Trying to get property &#39;id&#39; of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-376'>LANMS-376</a>] - ErrorException: Notice: Trying to get property &#39;id&#39; of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-379'>LANMS-379</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card was declined.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-380'>LANMS-380</a>] - ErrorException: Trying to get property &#39;theme&#39; of non-object</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-360'>LANMS-360</a>] - Notification system</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-369'>LANMS-369</a>] - Add support for dark and light images for sponsors</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-370'>LANMS-370</a>] - Add a easy way to toggle dark/light theme</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-371'>LANMS-371</a>] - Show sponsors from past year with dupe btn</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-344'>LANMS-344</a>] - Add prize pool to compo</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-346'>LANMS-346</a>] - Add automatic version update</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-347'>LANMS-347</a>] - Improvements on license checking</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-348'>LANMS-348</a>] - Refresh permissions should set permission to true for superadmin role</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-352'>LANMS-352</a>] - Add &quot;please wait&quot; on mass-email</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-355'>LANMS-355</a>] - Add validation for admin input to compo</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-357'>LANMS-357</a>] - User should not be able to delete or edit team if signed up to a compo</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-358'>LANMS-358</a>] - Unpaid invoices: Notification &amp; Reservations</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-362'>LANMS-362</a>] - Show deleted and add restore for rows and seats</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-365'>LANMS-365</a>] - Add description to settings</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-374'>LANMS-374</a>] - Improve address translation</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-377'>LANMS-377</a>] - Add setting for disabling consent form in header</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-378'>LANMS-378</a>] - Change the text on consent form about age restrictions</li>
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
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-336">LANMS-336</a>] - Send emails to users from admin panel</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-337">LANMS-337</a>] - System Info</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-342">LANMS-342</a>] - Update Sentry to version 1.3.0</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-333">LANMS-333</a>] - Implement news categories</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-338">LANMS-338</a>] - Add description to info items</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-339">LANMS-339</a>] - User already added to crew should not be listed on create crew page</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-340">LANMS-340</a>] - Add command to refresh permissions for roles</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-341">LANMS-341</a>] - Add warnings for env setting</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-345">LANMS-345</a>] - Add update command</li>
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
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-329">LANMS-329</a>] - General error: Field &#39;about&#39; doesn&#39;t have a default value</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-335">LANMS-335</a>] - Update translation for profile</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-272">LANMS-272</a>] - Add possibility to edit permissions for users</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-320">LANMS-320</a>] - Custom seating CSS from admin panel</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-321">LANMS-321</a>] - Add Stripe PaymentIntent (SCA)</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-323">LANMS-323</a>] - Update to L5.8</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-326">LANMS-326</a>] - Crew Skill Badge view in admin panel</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-327">LANMS-327</a>] - Improve dashboard design</li>
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
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-140">LANMS-140</a>] - InvalidArgumentException: Malformed UTF-8 characters, possibly incorrectly encoded</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-305">LANMS-305</a>] - ErrorException: Warning: unlink(/home/downlinkdg/repositories/lanms/storage/framework/down): No such file or dire...</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-312">LANMS-312</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-316">LANMS-316</a>] - News article does not throw 404 when article does not exist</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-322">LANMS-322</a>] - Reserving a seat is not working</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-273">LANMS-273</a>] - Rows; &quot;Create X amount of seats&quot; when creating a row</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-288">LANMS-288</a>] - Reset password for user via admin panel</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-240">LANMS-240</a>] - Add logging to more than just users</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-280">LANMS-280</a>] - Seatmap in checkin, with own colors for checked in seats</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-283">LANMS-283</a>] - Blank consent form more easily available</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-284">LANMS-284</a>] - Compo to be moved to public</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-306">LANMS-306</a>] - Add more user info in the adminpanel</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-307">LANMS-307</a>] - Resend activation email for user via admin panel</li>
									<li>[<a href="https://infihex.atlassian.net/browse/LANMS-309">LANMS-309</a>] - Add cleanup command for activity log</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-278'>LANMS-278</a>] - Email title not translated</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-282'>LANMS-282</a>] - Sometimes tickets gets 1970 year</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-285'>LANMS-285</a>] - Admin page for sponsors shows sponsors for prev year</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-290'>LANMS-290</a>] - Sponsors show all on admin page</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-294'>LANMS-294</a>] - Changing users phone, language or theme does not save</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-318'>LANMS-318</a>] - InvalidArgumentException: A two digit month could not be found</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-325'>LANMS-325</a>] - InvalidArgumentException: Trailing data</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-330'>LANMS-330</a>] - InvalidArgumentException: Data missing</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-289'>LANMS-289</a>] - Invoice system</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-279'>LANMS-279</a>] - Add addresses to users in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-292'>LANMS-292</a>] - Add anonymized badge to users in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-293'>LANMS-293</a>] - Make address2-field required</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-295'>LANMS-295</a>] - Add about-field to user in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-296'>LANMS-296</a>] - Improve order of tables in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-297'>LANMS-297</a>] - Implement Stripe Cards</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-300'>LANMS-300</a>] - Update the browser icon</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-304'>LANMS-304</a>] - Change dates in admin panel for table sorting</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-331'>LANMS-331</a>] - Allow spaces in names</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-247'>LANMS-247</a>] - Reserved status is not translated</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-248'>LANMS-248</a>] - Charge status from Stripe is not translated</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-269'>LANMS-269</a>] - Alert showing html in seating</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-271'>LANMS-271</a>] - Select2 has dark theme</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-274'>LANMS-274</a>] - Referral count does not show correctly</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-13'>LANMS-13</a>] - Create Team System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-18'>LANMS-18</a>] - Create Compo System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-270'>LANMS-270</a>] - Add a own sponsor page</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-275'>LANMS-275</a>] - Compo Signup System</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-254'>LANMS-254</a>] - Add &quot;admin buttons&quot; on news, pages etc</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-265'>LANMS-265</a>] - Autocomplete fields should be easier to use</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-267'>LANMS-267</a>] - Improve design of license page</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-251'>LANMS-251</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;Vsmoraes\Pdf\PdfFacade&#39; not found
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-252'>LANMS-252</a>] - Posting news to social media generates wrong link
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-261'>LANMS-261</a>] - If no birthdate is filled, it throws an error
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-262'>LANMS-262</a>] - Slugs isn&#39;t always created or updated
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-263'>LANMS-263</a>] - Seatmap is not sizing correctly
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-264'>LANMS-264</a>] - User can change payment after expiry
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-266'>LANMS-266</a>] - Phone is not being saved on signup page</li>
								</ul>

								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-257'>LANMS-257</a>] - Delete old themes and files
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-258'>LANMS-258</a>] - Change agreement when reserving
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-190'>LANMS-190</a>] - Update the Admin UI
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-238'>LANMS-238</a>] - Improve the check-in process for the person checking in attendees
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-250'>LANMS-250</a>] - Add chevron/caret down to user over menu
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-255'>LANMS-255</a>] - Improve crew and skill attachment
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-256'>LANMS-256</a>] - Change from label to class in crew skill
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-259'>LANMS-259</a>] - Add theme selection for users
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-260'>LANMS-260</a>] - Sort info pages on title
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-217'>LANMS-217</a>] - Chosen file does not appear in input field</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-221'>LANMS-221</a>] - Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-222'>LANMS-222</a>] - ErrorException: Route [home] not defined. (View: /home/downlinkdg/repositories/lanms/resources/views/vobilet/erro...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-223'>LANMS-223</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-241'>LANMS-241</a>] - Non-active, deleted, etc users is in ajax calls</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-242'>LANMS-242</a>] - AJAX is available without being logged in</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-211'>LANMS-211</a>] - Add Translation Support</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-219'>LANMS-219</a>] - Add calendar/schedule system</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-244'>LANMS-244</a>] - Add Discord widget</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-216'>LANMS-216</a>] - Add Norwegian translation</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-218'>LANMS-218</a>] - Update time/date formatting to use Carbon</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-226'>LANMS-226</a>] - Add phone number to users</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-227'>LANMS-227</a>] - Add last activity to members list</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-232'>LANMS-232</a>] - GDPR: Users with no activity for the last 3 years will be anonymized</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-235'>LANMS-235</a>] - Add user preference on language</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-239'>LANMS-239</a>] - Improve user input with old on profile</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-243'>LANMS-243</a>] - Add discord link to footer</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-245'>LANMS-245</a>] - Exception: DateTime::__construct(): Failed to parse time string (2004-28-05) at position 6 (8): Unexpected c...</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-229'>LANMS-229</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-231'>LANMS-231</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-236'>LANMS-236</a>] - Searching users does not work anymore</li>
								</ul>    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-230'>LANMS-230</a>] - Allow admins to view ticket</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-237'>LANMS-237</a>] - Add age check on birthdate fields</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-193'>LANMS-193</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;App\User&#39; not found</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-215'>LANMS-215</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-196'>LANMS-196</a>] - Post to social medias when posting news</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-212'>LANMS-212</a>] - Command for deleting non-activated users</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-191'>LANMS-191</a>] - ErrorException: Trying to get property of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-192'>LANMS-192</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/n...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-194'>LANMS-194</a>] - InvalidArgumentException: Route [account-recover] not defined.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-197'>LANMS-197</a>] - Randomly showing &quot;Could not find seat&quot; in seating</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-198'>LANMS-198</a>] - Some users can see other users charges</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-199'>LANMS-199</a>] - ErrorException: Missing required parameters for [Route: user-profile] [URI: user/profile/{username}]. (View: /hom...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-201'>LANMS-201</a>] - Crew Skills is showing wrongly</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-207'>LANMS-207</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/n...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-210'>LANMS-210</a>] - ErrorException: Undefined index: old</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-205'>LANMS-205</a>] - Add support for Facebook Messenger</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-195'>LANMS-195</a>] - Capture User in Sentry</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-202'>LANMS-202</a>] - Sort order for Sponsors</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-203'>LANMS-203</a>] - Rework the header on mobile</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-206'>LANMS-206</a>] - Add error pages to user UI</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-209'>LANMS-209</a>] - Pizza badge</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-213'>LANMS-213</a>] - Lastname cant contain spaces, it should be possible</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-155'>LANMS-155</a>] - Illuminate\Http\Exceptions\PostTooLargeException</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-174'>LANMS-174</a>] - When user has been on the login page for a while; the token expires</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-176'>LANMS-176</a>] - SignedInNotSupported Error from Google Maps API</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-178'>LANMS-178</a>] - Undefined variable: currentseat</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-179'>LANMS-179</a>] - Class &#39;Vsmoraes\Pdf\PdfFacade&#39; not found</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-186'>LANMS-186</a>] - Trying to get property &#39;username&#39; of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-188'>LANMS-188</a>] - When searching for users it shows inactive users</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-19'>LANMS-19</a>] - User administration</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-24'>LANMS-24</a>] - Receipt for ticket</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-88'>LANMS-88</a>] - Add system for rows and seats</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-158'>LANMS-158</a>] - Let users see payments and charges made</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-164'>LANMS-164</a>] - A list of reservations made</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-175'>LANMS-175</a>] - Add activity logging</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-71'>LANMS-71</a>] - Admin should be able to set payment to entrance for temp reserved seats</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-159'>LANMS-159</a>] - Cleanup routes for user/account</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-161'>LANMS-161</a>] - New account and dashboard pages</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-162'>LANMS-162</a>] - New design improvement for save buttons</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-163'>LANMS-163</a>] - Add a interactive card for payments</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-173'>LANMS-173</a>] - GDPR: Cookie Notice</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-180'>LANMS-180</a>] - GDPR: Users can easily request deletion of their personal data</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-181'>LANMS-181</a>] - GDPR: If you process children&#39;s personal data, verify their age and ask consent from their legal guardian</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-182'>LANMS-182</a>] - GDPR: Add a General Privacy Policy</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-183'>LANMS-183</a>] - GDPR: Add a General Terms and Conditions</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-184'>LANMS-184</a>] - Update the user UI</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-185'>LANMS-185</a>] - GDPR: Users can easily download their personal data</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-160'>LANMS-160</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card&#39;s security code is incorrect.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-167'>LANMS-167</a>] - DOMPDF_Exception: No block-level parent found.  Not good.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-168'>LANMS-168</a>] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [7...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-169'>LANMS-169</a>] - ErrorException: Trying to get property of non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-170'>LANMS-170</a>] - ErrorException: Undefined variable: currentseat</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-171'>LANMS-171</a>] - ErrorException: Undefined variable: currentseat</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-172'>LANMS-172</a>] - ErrorException: Undefined variable: currentseat</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-154'>LANMS-154</a>] - User could not change the payment</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-156'>LANMS-156</a>] - Payment takes &quot;Default Card&quot; and not the card that was entered</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-157'>LANMS-157</a>] - Reserve seat in admin panel has wrong name format</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-153'>LANMS-153</a>] - Pages does not appear in menu anymore</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-151'>LANMS-151</a>] - Payment does not proceed</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-152'>LANMS-152</a>] - Payment: ErrorException: Trying to get property of non-object</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-144'>LANMS-144</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-87'>LANMS-87</a>] - Timeline for profile</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-116'>LANMS-116</a>] - &quot;Pay now&quot;-button should have a loading animation</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-147'>LANMS-147</a>] - Names should be able contain norwegian letters</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-148'>LANMS-148</a>] - https setting is not enforcing https</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-97'>LANMS-97</a>] - Email logo needs fixing</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-134'>LANMS-134</a>] - UnexpectedValueException: The Response content must be a string or object implementing __toString(), &quot;boolean&quot; given.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-142'>LANMS-142</a>] - Swift_TransportException: Connection could not be established with host mani.infihex.com [ #0]</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-144'>LANMS-144</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-145'>LANMS-145</a>] - ErrorException: Argument 1 passed to Cartalyst\Sentinel\Reminders\IlluminateReminderRepository::complete() must i...</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-146'>LANMS-146</a>] - Remove &quot;Featured Image&quot; from news until it is implemented</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-141'>LANMS-141</a>] - User must have an birthday</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-143'>LANMS-143</a>] - Gender equality</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-108'>LANMS-108</a>] - ErrorException: Trying to get property of non-object (View: /lanms2/resources/views/neon-admin/seating/checkin/index.blade.php)</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-109'>LANMS-109</a>] - Ticket should not be deleted if user has checked in</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-113'>LANMS-113</a>] - One address, no primary</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-125'>LANMS-125</a>] - Other users can reserve seats on a user with a seat reserved</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-127'>LANMS-127</a>] - Reminder email for seat reservations does not send at 24 hours</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-131'>LANMS-131</a>] - Wrong format of names in seating</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-132'>LANMS-132</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-133'>LANMS-133</a>] - InvalidArgumentException: View [errors.500] not found.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-135'>LANMS-135</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Uncaught exception &#39;BadMethodCallException&#39; with message &#39;Method Cartalyst\Sentinel\Sentinel::has...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-136'>LANMS-136</a>] - Redirected to seating when i try to go to broken bands</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-138'>LANMS-138</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Class &#39;LANMS\Exceptions\HttpException&#39; not found</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-139'>LANMS-139</a>] - File-input covers the whole page</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-6'>LANMS-6</a>] - Create Sponsor System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-70'>LANMS-70</a>] - Reserve seats from admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-77'>LANMS-77</a>] - &quot;Broken band&quot; page</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-80'>LANMS-80</a>] - Crew system, with skills attached</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-85'>LANMS-85</a>] - Info system</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-119'>LANMS-119</a>] - Samtykkeskjema på nett</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-128'>LANMS-128</a>] - Add &quot;What&#39;s new?&quot; view</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-110'>LANMS-110</a>] - Upgrade Laravel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-123'>LANMS-123</a>] - Move &quot;Print&quot; under seating</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-124'>LANMS-124</a>] - Move settings, logs &amp; license under &quot;System&quot;</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-129'>LANMS-129</a>] - Move Logs into the admin panel design</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-61'>LANMS-61</a>] - Add Seatmap for seating in admin panel</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-75'>LANMS-75</a>] - Search for members userend</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-87'>LANMS-87</a>] - Timeline for profile</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-91'>LANMS-91</a>] - Admin Dashboard</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-101'>LANMS-101</a>] - Add ticket view for admin</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-104'>LANMS-104</a>] - Resend verification email</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-116'>LANMS-116</a>] - &quot;Pay now&quot;-button should have a loading animation</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-120'>LANMS-120</a>] - Remove 12yo requirement</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-126'>LANMS-126</a>] - Convert old cron_jobs to commands</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-97'>LANMS-97</a>] - Email logo needs fixing</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-98'>LANMS-98</a>] - Date field on mobile can be buggy</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-102'>LANMS-102</a>] - Kommer det opp &quot;you cant view this ticket&quot;</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-103'>LANMS-103</a>] - Design does not work on iPhone</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-105'>LANMS-105</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Call to a member function inRole() on a non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-106'>LANMS-106</a>] - Illuminate\Session\TokenMismatchException</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-99'>LANMS-99</a>] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [2...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-100'>LANMS-100</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card number is incorrect.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-107'>LANMS-107</a>] - You should be able to see seatmap when closed</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-98'>LANMS-98</a>] - Date field on mobile can be buggy</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-102'>LANMS-102</a>] - Kommer det opp &quot;you cant view this ticket&quot;</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-103'>LANMS-103</a>] - Design does not work on iPhone</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-105'>LANMS-105</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Call to a member function inRole() on a non-object</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-106'>LANMS-106</a>] - Illuminate\Session\TokenMismatchException</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-99'>LANMS-99</a>] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [2...</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-100'>LANMS-100</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card number is incorrect.</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-107'>LANMS-107</a>] - You should be able to see seatmap when closed</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-54'>LANMS-54</a>] - Members page should not show non active users</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-76'>LANMS-76</a>] - List for non-checkedin reservations</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-74'>LANMS-74</a>] - Ticket ID on reservation table</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-81'>LANMS-81</a>] - Add setting for disabling login for users</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-82'>LANMS-82</a>] - Need to hide seating from menu</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-72'>LANMS-72</a>] - Print outs for seats in admin panel</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-69'>LANMS-69</a>] - Reservation count for api is counting crew seats</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-68'>LANMS-68</a>] - Seating info, cant download ticket when closed and more</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-64'>LANMS-64</a>] - All Users have 30 reserved seats</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-65'>LANMS-65</a>] - Check-in</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-67'>LANMS-67</a>] - Output data in JSON</li>
								</ul>
								
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-61'>LANMS-61</a>] - Add Seatmap for seating in admin panel</li>
								</ul>
								    
								<h4>Sub-task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-66'>LANMS-66</a>] - Visitor check-in</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-63'>LANMS-63</a>] - Google Analytics</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-62'>LANMS-62</a>] - Delete reservations in admin panel</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-41'>LANMS-41</a>] - User registration/login problems in all browsers</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-36'>LANMS-36</a>] - Capital letters does not work in email on registration</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-55'>LANMS-55</a>] - Admin panel: Change reservations</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-56'>LANMS-56</a>] - Create ENV setting for stripe key</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-53'>LANMS-53</a>] - Update seat info about user</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-58'>LANMS-58</a>] - Add more info about rules for reservation</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-59'>LANMS-59</a>] - Frontend needs css improvements</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-29'>LANMS-29</a>] - Missing Assets</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-42'>LANMS-42</a>] - User should be able remove reservation if selected pay at entrance</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-37'>LANMS-37</a>] - Change mail settings for prod</li>
								</ul>
								   
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-52'>LANMS-52</a>] - Users should be able to see seats reserved to them</li>
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
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-14'>LANMS-14</a>] - User::hasAdminAccess-Scope does not work</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-21'>LANMS-21</a>] - News bug</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-22'>LANMS-22</a>] - Deleting primary adress does not set another primary</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-25'>LANMS-25</a>] - Profilepicturesmall does not save in db on upload</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-26'>LANMS-26</a>] - Fix userdetails request</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-30'>LANMS-30</a>] - Can&#39;t have spaces in address</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-32'>LANMS-32</a>] - Some dates does not work on registration (some browsers)</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-33'>LANMS-33</a>] - Addres cant understand special caracters like æøå</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-35'>LANMS-35</a>] - News and Article pages throw 500</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-38'>LANMS-38</a>] - On registration if email exists it gives 500</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-39'>LANMS-39</a>] - Wrong username in activation screen makes it not work</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-40'>LANMS-40</a>] - 2 Feil på &quot;Add address</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-44'>LANMS-44</a>] - Logout button gone on mobile</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-45'>LANMS-45</a>] - All users 46 years old</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-46'>LANMS-46</a>] - Location wrong</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-47'>LANMS-47</a>] - Admin Page-siden getUsernameByID needs to be removed</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-48'>LANMS-48</a>] - Refferal link does not work</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-49'>LANMS-49</a>] - Adressbook create does not rember input</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-50'>LANMS-50</a>] - Chrome says &quot;Please enter a valid date.&quot; when date is valid</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-51'>LANMS-51</a>] - Fix birthdate in db and templates</li>
								</ul>

								<h4>New Feature</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-2'>LANMS-2</a>] - Implement Frontend Design</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-3'>LANMS-3</a>] - Create Page System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-5'>LANMS-5</a>] - Create Seating System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-7'>LANMS-7</a>] - Create Addressbook for users</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-9'>LANMS-9</a>] - &quot;Now&quot;-button in Publish setting on news admin</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-10'>LANMS-10</a>] - Add unique ID for each user (random generated)</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-11'>LANMS-11</a>] - Migration from 1.0</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-15'>LANMS-15</a>] - Autocomplete Address</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-16'>LANMS-16</a>] - Ajax Usernames</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-17'>LANMS-17</a>] - Create Referral System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-28'>LANMS-28</a>] - Error Emails to Dev</li>
								</ul>

								<h4>Task</h4>
								<ul>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-4'>LANMS-4</a>] - Finish Settings System</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-20'>LANMS-20</a>] - Add error messages to form admin</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-27'>LANMS-27</a>] - Add relationships for author and news</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-31'>LANMS-31</a>] - Check thru DB changes from 1.0 to 2.0</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-34'>LANMS-34</a>] - Terms of Service &amp; Privacy Policy</li>
									<li>[<a href='https://infihex.atlassian.net/browse/LANMS-43'>LANMS-43</a>] - Update and test email templates</li>
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