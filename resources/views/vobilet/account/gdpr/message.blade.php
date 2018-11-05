@extends('layouts.main')
@section('title', 'GDPR Agreement')
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">GDPR Agreement</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Account</li>
            <li class="breadcrumb-item active" aria-current="page">GDPR Agreement</li>
        </ol>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<p>Probably you've heard about GDPR, but what does the regulation mean to you as a member? Here you can read about what the privacy reform implies for your member relationship on this website.</p>

                    <p><strong>What is GDPR?</strong></p>
                    <p>The EU's new privacy reform, better known as the GDPR (General Data Protection Regulation), is created to improve your data security across European land borders in EU and EEA countries. Privacy is prioritized on this website, and in this article you will find information about how we work to comply with the new Privacy Policy.</p>

                    <p><strong>A safer community for you as a member</strong></p>
                    <p>The new regulation becomes part of the Norwegian legislation, and is an additional assurance that your personal information is processed legally. There will be greater responsibility on this website for processing and securing your member data, while at the same time you will be able to conduct your online shopping in the same way as before. In other words, GDPR is only an advantage to you as a member.</p>

                    <p><strong>Your consent is ready</strong></p>
                    <p>Your current consent is still valid. What's new is that you can now choose whether you want to receive offers and news via email and that the information about your consent and what it implies is up to date.</p>
                    <p>You may withdraw your consent at any time. To get an overview or make changes to your consent, you can easily go to "My Account". You can also unsubscribe from emails.</p>

                    <p><strong>Coordinator and third party</strong></p>
                    <p>The chairman of this event of this  is generally responsible for the event's processing of personal data. To provide a tailor-made acquisition experience for you, this website uses external partners, but your personal data is in no way neglected or sold to third parties. Here you can read more about our processing of personal data.</p>

                    <p><strong>Privacy Policy</strong></p>
                    <p>In connection with GDPR, we have adapted and simplified our privacy statement. Here you can read in detail how we process your personal information and what types of information it concerns. The declaration informs you of the customer data you provide during usage of this website and the contact points for the information internally in our system.</p>

                    <p><strong>Increased security for your customer data</strong></p>
                    <p>The new directive requires this website to have a full overview of all the event's personal data and to demand security for these. In the event of a data break, which may affect your personal information, this website follows the rules for reporting duty stated in the GDPR.</p>
				</div>
				<div class="card-footer">
					<form class="form-inline float-left" role="form" method="POST" action="{{ route('gdpr-terms-accepted') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success"><i class="fas fa-vote-yea"></i> I Accept</button>
                    </form>
                    <form class="form-inline float-right" role="form" method="POST" action="{{ route('gdpr-terms-denied') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-times"></i> Deny</button>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop