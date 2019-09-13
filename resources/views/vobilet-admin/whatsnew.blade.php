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
								<a data-toggle="collapse" data-parent="#releasenotes" href="#254" aria-expanded="true">Version 2.5.4</a>
							</h4>
						</div>
						<div id="254" class="panel-collapse collapse" aria-expanded="true">
							<div class="panel-body">
								<h4>Bug</h4>
								<ul>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-140">LANMS-140</a>] - InvalidArgumentException: Malformed UTF-8 characters, possibly incorrectly encoded</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-305">LANMS-305</a>] - ErrorException: Warning: unlink(/home/downlinkdg/repositories/lanms/storage/framework/down): No such file or dire...</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-312">LANMS-312</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-316">LANMS-316</a>] - News article does not throw 404 when article does not exist</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-322">LANMS-322</a>] - Reserving a seat is not working</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-273">LANMS-273</a>] - Rows; &quot;Create X amount of seats&quot; when creating a row</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-288">LANMS-288</a>] - Reset password for user via admin panel</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-240">LANMS-240</a>] - Add logging to more than just users</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-280">LANMS-280</a>] - Seatmap in checkin, with own colors for checked in seats</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-283">LANMS-283</a>] - Blank consent form more easily available</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-284">LANMS-284</a>] - Compo to be moved to public</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-306">LANMS-306</a>] - Add more user info in the adminpanel</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-307">LANMS-307</a>] - Resend activation email for user via admin panel</li>
									<li>[<a href="http://jira.infihex.com/browse/LANMS-309">LANMS-309</a>] - Add cleanup command for activity log</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-278'>LANMS-278</a>] - Email title not translated</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-282'>LANMS-282</a>] - Sometimes tickets gets 1970 year</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-285'>LANMS-285</a>] - Admin page for sponsors shows sponsors for prev year</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-290'>LANMS-290</a>] - Sponsors show all on admin page</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-294'>LANMS-294</a>] - Changing users phone, language or theme does not save</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-289'>LANMS-289</a>] - Invoice system</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-279'>LANMS-279</a>] - Add addresses to users in admin panel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-292'>LANMS-292</a>] - Add anonymized badge to users in admin panel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-293'>LANMS-293</a>] - Make address2-field required</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-295'>LANMS-295</a>] - Add about-field to user in admin panel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-296'>LANMS-296</a>] - Improve order of tables in admin panel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-297'>LANMS-297</a>] - Implement Stripe Cards</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-300'>LANMS-300</a>] - Update the browser icon</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-304'>LANMS-304</a>] - Change dates in admin panel for table sorting</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-247'>LANMS-247</a>] - Reserved status is not translated</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-248'>LANMS-248</a>] - Charge status from Stripe is not translated</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-269'>LANMS-269</a>] - Alert showing html in seating</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-271'>LANMS-271</a>] - Select2 has dark theme</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-274'>LANMS-274</a>] - Referral count does not show correctly</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-13'>LANMS-13</a>] - Create Team System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-18'>LANMS-18</a>] - Create Compo System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-270'>LANMS-270</a>] - Add a own sponsor page</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-275'>LANMS-275</a>] - Compo Signup System</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-254'>LANMS-254</a>] - Add &quot;admin buttons&quot; on news, pages etc</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-265'>LANMS-265</a>] - Autocomplete fields should be easier to use</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-267'>LANMS-267</a>] - Improve design of license page</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-251'>LANMS-251</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;Vsmoraes\Pdf\PdfFacade&#39; not found
									<li>[<a href='http://jira.infihex.com/browse/LANMS-252'>LANMS-252</a>] - Posting news to social media generates wrong link
									<li>[<a href='http://jira.infihex.com/browse/LANMS-261'>LANMS-261</a>] - If no birthdate is filled, it throws an error
									<li>[<a href='http://jira.infihex.com/browse/LANMS-262'>LANMS-262</a>] - Slugs isn&#39;t always created or updated
									<li>[<a href='http://jira.infihex.com/browse/LANMS-263'>LANMS-263</a>] - Seatmap is not sizing correctly
									<li>[<a href='http://jira.infihex.com/browse/LANMS-264'>LANMS-264</a>] - User can change payment after expiry
									<li>[<a href='http://jira.infihex.com/browse/LANMS-266'>LANMS-266</a>] - Phone is not being saved on signup page</li>
								</ul>

								<h4>Task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-257'>LANMS-257</a>] - Delete old themes and files
									<li>[<a href='http://jira.infihex.com/browse/LANMS-258'>LANMS-258</a>] - Change agreement when reserving
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-190'>LANMS-190</a>] - Update the Admin UI
									<li>[<a href='http://jira.infihex.com/browse/LANMS-238'>LANMS-238</a>] - Improve the check-in process for the person checking in attendees
									<li>[<a href='http://jira.infihex.com/browse/LANMS-250'>LANMS-250</a>] - Add chevron/caret down to user over menu
									<li>[<a href='http://jira.infihex.com/browse/LANMS-255'>LANMS-255</a>] - Improve crew and skill attachment
									<li>[<a href='http://jira.infihex.com/browse/LANMS-256'>LANMS-256</a>] - Change from label to class in crew skill
									<li>[<a href='http://jira.infihex.com/browse/LANMS-259'>LANMS-259</a>] - Add theme selection for users
									<li>[<a href='http://jira.infihex.com/browse/LANMS-260'>LANMS-260</a>] - Sort info pages on title
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-217'>LANMS-217</a>] - Chosen file does not appear in input field</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-221'>LANMS-221</a>] - Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-222'>LANMS-222</a>] - ErrorException: Route [home] not defined. (View: /home/downlinkdg/repositories/lanms/resources/views/vobilet/erro...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-223'>LANMS-223</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-241'>LANMS-241</a>] - Non-active, deleted, etc users is in ajax calls</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-242'>LANMS-242</a>] - AJAX is available without being logged in</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-211'>LANMS-211</a>] - Add Translation Support</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-219'>LANMS-219</a>] - Add calendar/schedule system</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-244'>LANMS-244</a>] - Add Discord widget</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-216'>LANMS-216</a>] - Add Norwegian translation</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-218'>LANMS-218</a>] - Update time/date formatting to use Carbon</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-226'>LANMS-226</a>] - Add phone number to users</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-227'>LANMS-227</a>] - Add last activity to members list</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-232'>LANMS-232</a>] - GDPR: Users with no activity for the last 3 years will be anonymized</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-235'>LANMS-235</a>] - Add user preference on language</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-239'>LANMS-239</a>] - Improve user input with old on profile</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-243'>LANMS-243</a>] - Add discord link to footer</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-245'>LANMS-245</a>] - Exception: DateTime::__construct(): Failed to parse time string (2004-28-05) at position 6 (8): Unexpected c...</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-229'>LANMS-229</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-231'>LANMS-231</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-236'>LANMS-236</a>] - Searching users does not work anymore</li>
								</ul>    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-230'>LANMS-230</a>] - Allow admins to view ticket</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-237'>LANMS-237</a>] - Add age check on birthdate fields</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-193'>LANMS-193</a>] - Symfony\Component\Debug\Exception\FatalThrowableError: Class &#39;App\User&#39; not found</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-215'>LANMS-215</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/v...</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-196'>LANMS-196</a>] - Post to social medias when posting news</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-212'>LANMS-212</a>] - Command for deleting non-activated users</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-191'>LANMS-191</a>] - ErrorException: Trying to get property of non-object</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-192'>LANMS-192</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/n...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-194'>LANMS-194</a>] - InvalidArgumentException: Route [account-recover] not defined.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-197'>LANMS-197</a>] - Randomly showing &quot;Could not find seat&quot; in seating</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-198'>LANMS-198</a>] - Some users can see other users charges</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-199'>LANMS-199</a>] - ErrorException: Missing required parameters for [Route: user-profile] [URI: user/profile/{username}]. (View: /hom...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-201'>LANMS-201</a>] - Crew Skills is showing wrongly</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-207'>LANMS-207</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/repositories/lanms/resources/views/n...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-210'>LANMS-210</a>] - ErrorException: Undefined index: old</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-205'>LANMS-205</a>] - Add support for Facebook Messenger</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-195'>LANMS-195</a>] - Capture User in Sentry</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-202'>LANMS-202</a>] - Sort order for Sponsors</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-203'>LANMS-203</a>] - Rework the header on mobile</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-206'>LANMS-206</a>] - Add error pages to user UI</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-209'>LANMS-209</a>] - Pizza badge</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-213'>LANMS-213</a>] - Lastname cant contain spaces, it should be possible</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-155'>LANMS-155</a>] - Illuminate\Http\Exceptions\PostTooLargeException</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-174'>LANMS-174</a>] - When user has been on the login page for a while; the token expires</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-176'>LANMS-176</a>] - SignedInNotSupported Error from Google Maps API</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-178'>LANMS-178</a>] - Undefined variable: currentseat</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-179'>LANMS-179</a>] - Class &#39;Vsmoraes\Pdf\PdfFacade&#39; not found</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-186'>LANMS-186</a>] - Trying to get property &#39;username&#39; of non-object</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-188'>LANMS-188</a>] - When searching for users it shows inactive users</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-19'>LANMS-19</a>] - User administration</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-24'>LANMS-24</a>] - Receipt for ticket</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-88'>LANMS-88</a>] - Add system for rows and seats</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-158'>LANMS-158</a>] - Let users see payments and charges made</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-164'>LANMS-164</a>] - A list of reservations made</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-175'>LANMS-175</a>] - Add activity logging</li>
								</ul>

								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-71'>LANMS-71</a>] - Admin should be able to set payment to entrance for temp reserved seats</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-159'>LANMS-159</a>] - Cleanup routes for user/account</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-161'>LANMS-161</a>] - New account and dashboard pages</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-162'>LANMS-162</a>] - New design improvement for save buttons</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-163'>LANMS-163</a>] - Add a interactive card for payments</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-173'>LANMS-173</a>] - GDPR: Cookie Notice</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-180'>LANMS-180</a>] - GDPR: Users can easily request deletion of their personal data</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-181'>LANMS-181</a>] - GDPR: If you process children&#39;s personal data, verify their age and ask consent from their legal guardian</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-182'>LANMS-182</a>] - GDPR: Add a General Privacy Policy</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-183'>LANMS-183</a>] - GDPR: Add a General Terms and Conditions</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-184'>LANMS-184</a>] - Update the user UI</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-185'>LANMS-185</a>] - GDPR: Users can easily download their personal data</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-160'>LANMS-160</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card&#39;s security code is incorrect.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-167'>LANMS-167</a>] - DOMPDF_Exception: No block-level parent found.  Not good.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-168'>LANMS-168</a>] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [7...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-169'>LANMS-169</a>] - ErrorException: Trying to get property of non-object</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-170'>LANMS-170</a>] - ErrorException: Undefined variable: currentseat</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-171'>LANMS-171</a>] - ErrorException: Undefined variable: currentseat</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-172'>LANMS-172</a>] - ErrorException: Undefined variable: currentseat</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-154'>LANMS-154</a>] - User could not change the payment</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-156'>LANMS-156</a>] - Payment takes &quot;Default Card&quot; and not the card that was entered</li>
								</ul>
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
								</ul>
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-157'>LANMS-157</a>] - Reserve seat in admin panel has wrong name format</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-153'>LANMS-153</a>] - Pages does not appear in menu anymore</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-151'>LANMS-151</a>] - Payment does not proceed</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-152'>LANMS-152</a>] - Payment: ErrorException: Trying to get property of non-object</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-144'>LANMS-144</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-87'>LANMS-87</a>] - Timeline for profile</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-116'>LANMS-116</a>] - &quot;Pay now&quot;-button should have a loading animation</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-147'>LANMS-147</a>] - Names should be able contain norwegian letters</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-148'>LANMS-148</a>] - https setting is not enforcing https</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-97'>LANMS-97</a>] - Email logo needs fixing</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-134'>LANMS-134</a>] - UnexpectedValueException: The Response content must be a string or object implementing __toString(), &quot;boolean&quot; given.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-142'>LANMS-142</a>] - Swift_TransportException: Connection could not be established with host mani.infihex.com [ #0]</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-144'>LANMS-144</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-145'>LANMS-145</a>] - ErrorException: Argument 1 passed to Cartalyst\Sentinel\Reminders\IlluminateReminderRepository::complete() must i...</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-146'>LANMS-146</a>] - Remove &quot;Featured Image&quot; from news until it is implemented</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-141'>LANMS-141</a>] - User must have an birthday</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-143'>LANMS-143</a>] - Gender equality</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-108'>LANMS-108</a>] - ErrorException: Trying to get property of non-object (View: /lanms2/resources/views/neon-admin/seating/checkin/index.blade.php)</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-109'>LANMS-109</a>] - Ticket should not be deleted if user has checked in</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-113'>LANMS-113</a>] - One address, no primary</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-125'>LANMS-125</a>] - Other users can reserve seats on a user with a seat reserved</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-127'>LANMS-127</a>] - Reminder email for seat reservations does not send at 24 hours</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-131'>LANMS-131</a>] - Wrong format of names in seating</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-132'>LANMS-132</a>] - ErrorException: Trying to get property of non-object (View: /home/downlinkdg/public_html/resources/views/neon-adm...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-133'>LANMS-133</a>] - InvalidArgumentException: View [errors.500] not found.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-135'>LANMS-135</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Uncaught exception &#39;BadMethodCallException&#39; with message &#39;Method Cartalyst\Sentinel\Sentinel::has...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-136'>LANMS-136</a>] - Redirected to seating when i try to go to broken bands</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-138'>LANMS-138</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Class &#39;LANMS\Exceptions\HttpException&#39; not found</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-139'>LANMS-139</a>] - File-input covers the whole page</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-6'>LANMS-6</a>] - Create Sponsor System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-70'>LANMS-70</a>] - Reserve seats from admin panel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-77'>LANMS-77</a>] - &quot;Broken band&quot; page</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-80'>LANMS-80</a>] - Crew system, with skills attached</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-85'>LANMS-85</a>] - Info system</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-111'>LANMS-111</a>] - License Checker</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-119'>LANMS-119</a>] - Samtykkeskjema på nett</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-128'>LANMS-128</a>] - Add &quot;What&#39;s new?&quot; view</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-110'>LANMS-110</a>] - Upgrade Laravel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-123'>LANMS-123</a>] - Move &quot;Print&quot; under seating</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-124'>LANMS-124</a>] - Move settings, logs &amp; license under &quot;System&quot;</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-129'>LANMS-129</a>] - Move Logs into the admin panel design</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-61'>LANMS-61</a>] - Add Seatmap for seating in admin panel</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-75'>LANMS-75</a>] - Search for members userend</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-87'>LANMS-87</a>] - Timeline for profile</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-91'>LANMS-91</a>] - Admin Dashboard</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-101'>LANMS-101</a>] - Add ticket view for admin</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-104'>LANMS-104</a>] - Resend verification email</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-116'>LANMS-116</a>] - &quot;Pay now&quot;-button should have a loading animation</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-120'>LANMS-120</a>] - Remove 12yo requirement</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-126'>LANMS-126</a>] - Convert old cron_jobs to commands</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-97'>LANMS-97</a>] - Email logo needs fixing</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-98'>LANMS-98</a>] - Date field on mobile can be buggy</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-102'>LANMS-102</a>] - Kommer det opp &quot;you cant view this ticket&quot;</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-103'>LANMS-103</a>] - Design does not work on iPhone</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-105'>LANMS-105</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Call to a member function inRole() on a non-object</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-106'>LANMS-106</a>] - Illuminate\Session\TokenMismatchException</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-99'>LANMS-99</a>] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [2...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-100'>LANMS-100</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card number is incorrect.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-107'>LANMS-107</a>] - You should be able to see seatmap when closed</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-98'>LANMS-98</a>] - Date field on mobile can be buggy</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-102'>LANMS-102</a>] - Kommer det opp &quot;you cant view this ticket&quot;</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-103'>LANMS-103</a>] - Design does not work on iPhone</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-105'>LANMS-105</a>] - Symfony\Component\Debug\Exception\FatalErrorException: Call to a member function inRole() on a non-object</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-106'>LANMS-106</a>] - Illuminate\Session\TokenMismatchException</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-99'>LANMS-99</a>] - Cartalyst\Sentinel\Checkpoints\ThrottlingException: Suspicious activity has occured on your IP address and you have been denied access for another [2...</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-100'>LANMS-100</a>] - Cartalyst\Stripe\Exception\CardErrorException: Your card number is incorrect.</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-107'>LANMS-107</a>] - You should be able to see seatmap when closed</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-54'>LANMS-54</a>] - Members page should not show non active users</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-76'>LANMS-76</a>] - List for non-checkedin reservations</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-74'>LANMS-74</a>] - Ticket ID on reservation table</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-81'>LANMS-81</a>] - Add setting for disabling login for users</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-82'>LANMS-82</a>] - Need to hide seating from menu</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-72'>LANMS-72</a>] - Print outs for seats in admin panel</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-69'>LANMS-69</a>] - Reservation count for api is counting crew seats</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-68'>LANMS-68</a>] - Seating info, cant download ticket when closed and more</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-64'>LANMS-64</a>] - All Users have 30 reserved seats</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-65'>LANMS-65</a>] - Check-in</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-67'>LANMS-67</a>] - Output data in JSON</li>
								</ul>
								
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-61'>LANMS-61</a>] - Add Seatmap for seating in admin panel</li>
								</ul>
								    
								<h4>Sub-task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-66'>LANMS-66</a>] - Visitor check-in</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-63'>LANMS-63</a>] - Google Analytics</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-62'>LANMS-62</a>] - Delete reservations in admin panel</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-41'>LANMS-41</a>] - User registration/login problems in all browsers</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-36'>LANMS-36</a>] - Capital letters does not work in email on registration</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-55'>LANMS-55</a>] - Admin panel: Change reservations</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-56'>LANMS-56</a>] - Create ENV setting for stripe key</li>
								</ul>
								    
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-53'>LANMS-53</a>] - Update seat info about user</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-58'>LANMS-58</a>] - Add more info about rules for reservation</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-59'>LANMS-59</a>] - Frontend needs css improvements</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-29'>LANMS-29</a>] - Missing Assets</li>
								</ul>
								    
								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-42'>LANMS-42</a>] - User should be able remove reservation if selected pay at entrance</li>
								</ul>
								    
								<h4>Task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-37'>LANMS-37</a>] - Change mail settings for prod</li>
								</ul>
								   
								<h4>Improvement</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-52'>LANMS-52</a>] - Users should be able to see seats reserved to them</li>
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
									<li>[<a href='http://jira.infihex.com/browse/LANMS-14'>LANMS-14</a>] - User::hasAdminAccess-Scope does not work</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-21'>LANMS-21</a>] - News bug</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-22'>LANMS-22</a>] - Deleting primary adress does not set another primary</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-25'>LANMS-25</a>] - Profilepicturesmall does not save in db on upload</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-26'>LANMS-26</a>] - Fix userdetails request</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-30'>LANMS-30</a>] - Can&#39;t have spaces in address</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-32'>LANMS-32</a>] - Some dates does not work on registration (some browsers)</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-33'>LANMS-33</a>] - Addres cant understand special caracters like æøå</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-35'>LANMS-35</a>] - News and Article pages throw 500</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-38'>LANMS-38</a>] - On registration if email exists it gives 500</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-39'>LANMS-39</a>] - Wrong username in activation screen makes it not work</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-40'>LANMS-40</a>] - 2 Feil på &quot;Add address</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-44'>LANMS-44</a>] - Logout button gone on mobile</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-45'>LANMS-45</a>] - All users 46 years old</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-46'>LANMS-46</a>] - Location wrong</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-47'>LANMS-47</a>] - Admin Page-siden getUsernameByID needs to be removed</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-48'>LANMS-48</a>] - Refferal link does not work</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-49'>LANMS-49</a>] - Adressbook create does not rember input</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-50'>LANMS-50</a>] - Chrome says &quot;Please enter a valid date.&quot; when date is valid</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-51'>LANMS-51</a>] - Fix birthdate in db and templates</li>
								</ul>

								<h4>New Feature</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-2'>LANMS-2</a>] - Implement Frontend Design</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-3'>LANMS-3</a>] - Create Page System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-5'>LANMS-5</a>] - Create Seating System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-7'>LANMS-7</a>] - Create Addressbook for users</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-9'>LANMS-9</a>] - &quot;Now&quot;-button in Publish setting on news admin</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-10'>LANMS-10</a>] - Add unique ID for each user (random generated)</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-11'>LANMS-11</a>] - Migration from 1.0</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-15'>LANMS-15</a>] - Autocomplete Address</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-16'>LANMS-16</a>] - Ajax Usernames</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-17'>LANMS-17</a>] - Create Referral System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-28'>LANMS-28</a>] - Error Emails to Dev</li>
								</ul>

								<h4>Task</h4>
								<ul>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-4'>LANMS-4</a>] - Finish Settings System</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-20'>LANMS-20</a>] - Add error messages to form admin</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-27'>LANMS-27</a>] - Add relationships for author and news</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-31'>LANMS-31</a>] - Check thru DB changes from 1.0 to 2.0</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-34'>LANMS-34</a>] - Terms of Service &amp; Privacy Policy</li>
									<li>[<a href='http://jira.infihex.com/browse/LANMS-43'>LANMS-43</a>] - Update and test email templates</li>
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