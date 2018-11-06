<?php 

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

use Dialect\Gdpr\Anonymizable;

class StripeCustomer extends Model
{

	use Anonymizable;
	
	protected $table = 'stripe_customers';

	protected $fillable = [
		'cus',
		'user_id',
	];

	function user() {
		return $this->hasOne('LANMS\User', 'id', 'user_id');
	}

}
