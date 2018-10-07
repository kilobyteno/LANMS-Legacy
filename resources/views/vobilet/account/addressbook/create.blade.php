<div class="card">
				<div class="card-header">
					<h3 class="card-title">Address</h3>
				</div>
				<div class="card-body">
					
					<div class="form-group @if($errors->has('address1')) has-error @endif">
						<label class="form-label">Address</label>
						<input class="form-control" type="text" name="address1" placeholder="Jernbanegata 15" value="{{ $address1 }}">
						@if($errors->has('address1'))
							<p class="text-danger">{{ $errors->first('address1') }}</p>
						@endif
					</div>

					<div class="form-group @if($errors->has('address2')) has-error @endif">
						<label class="form-label">Address 2</label>
						<input class="form-control" type="text" name="address2" value="{{ $address2 }}">
						@if($errors->has('address2'))
							<p class="text-danger">{{ $errors->first('address2') }}</p>
						@endif
					</div>

					<div class="col-md-6 form-group @if($errors->has('postalcode')) has-error @endif">
						<label class="form-label">Postal Code</label>
						<input class="form-control" type="text" name="postalcode" placeholder="2609" value="{{ $postalcode }}">
						@if($errors->has('postalcode'))
							<p class="text-danger">{{ $errors->first('postalcode') }}</p>
						@endif
					</div>

					<div class="col-md-6 form-group @if($errors->has('city')) has-error @endif">
						<label class="form-label">City</label>
						<input class="form-control" type="text" name="city" placeholder="Lillehammer" value="{{ $city }}">
						@if($errors->has('city'))
							<p class="text-danger">{{ $errors->first('city') }}</p>
						@endif
					</div>
							
					<div class="col-md-6 form-group @if($errors->has('county')) has-error @endif">
						<label class="form-label">County</label>
						<input class="form-control" type="text" name="county" placeholder="Oppland" value="{{ $county }}">
						@if($errors->has('county'))
							<p class="text-danger">{{ $errors->first('county') }}</p>
						@endif
					</div>

					<div class="col-md-6 form-group @if($errors->has('country')) has-error @endif">
						<label class="form-label">Country</label>
						<input class="form-control" type="text" name="country" placeholder="Norway" value="{{ $country }}">
						@if($errors->has('country'))
							<p class="text-danger">{{ $errors->first('country') }}</p>
						@endif
					</div>

				</div>
			</div>