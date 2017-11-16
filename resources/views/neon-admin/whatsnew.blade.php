@extends('layouts.main')
@section('title', 'What\'s New? - Admin')
   
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- 2.3.0 -->
		<h1>Release Notes - LANMS - Version 2.3.0</h1>
		<h2>Bug</h2>
		<ul>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-108'>LANMS-108</a>] - ErrorException: Trying to get property of non-object (View: /lanms2/resources/views/neon-admin/seating/checkin/index.blade.php)</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-109'>LANMS-109</a>] - Ticket should not be deleted if user has checked in</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-113'>LANMS-113</a>] - One address, no primary</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-125'>LANMS-125</a>] - Other users can reserve seats on a user with a seat reserved</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-127'>LANMS-127</a>] - Reminder email for seat reservations does not send at 24 hours</li>
		</ul>
		<h2>New Feature</h2>
		<ul>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-6'>LANMS-6</a>] - Create Sponsor System</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-19'>LANMS-19</a>] - User administration</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-24'>LANMS-24</a>] - Receipt for ticket</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-70'>LANMS-70</a>] - Reserve seats from admin panel</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-77'>LANMS-77</a>] - &quot;Broken band&quot; page</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-80'>LANMS-80</a>] - Crew system, with skills attached</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-85'>LANMS-85</a>] - Info system</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-118'>LANMS-118</a>] - Merch salg med billett kjøp</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-119'>LANMS-119</a>] - Samtykkeskjema på nett</li>
		</ul>
		<h2>Task</h2>
		<ul>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-110'>LANMS-110</a>] - Upgrade Laravel</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-123'>LANMS-123</a>] - Move &quot;Print&quot; under seating</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-124'>LANMS-124</a>] - Move settings, logs &amp; license under &quot;System&quot;</li>
		</ul>
		<h2>Improvement</h2>
		<ul>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-71'>LANMS-71</a>] - Admin should be able to set payment to entrance for temp reserved seats</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-75'>LANMS-75</a>] - Search for members userend</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-87'>LANMS-87</a>] - Timeline for profile</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-101'>LANMS-101</a>] - Add ticket view for admin</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-104'>LANMS-104</a>] - Resend verification email</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-116'>LANMS-116</a>] - &quot;Pay now&quot;-button should have a loading animation</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-120'>LANMS-120</a>] - Remove 12yo requirement</li>
			<li>[<a href='http://jira.infihex.com/browse/LANMS-126'>LANMS-126</a>] - Convert old cron_jobs to commands</li>
		</ul>
		<!-- /2.3.0 -->
	</div>
</div>
@stop