<div class="form-group">
    <label>First Name</label>
    <input type="text" name="first_name" class="form-control"
        value="{{ old('first_name', $client->first_name ?? null) }}"/>
</div>
@error('first_name')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control"
        value="{{ old('last_name', $client->last_name ?? null) }}"/>
</div>
@error('last_name')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Country</label>
    <input type="text" name="country" class="form-control"
        value="{{ old('country', $client->country ?? null) }}"/>
</div>
@error('country')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>State</label>
    <input type="text" name="state" class="form-control"
        value="{{ old('state', $client->state ?? null) }}"/>
</div>
@error('state')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>City</label>
    <input type="text" name="city" class="form-control"
        value="{{ old('city', $client->city ?? null) }}"/>
</div>
@error('city')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Address</label>
    <input type="text" name="address" class="form-control"
        value="{{ old('address', $client->address ?? null) }}"/>
</div>
@error('address')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control"
        value="{{ old('phone', $client->phone ?? null) }}"/>
</div>
@error('phone')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control"
        value="{{ old('email', $client->email ?? null) }}"/>
</div>
@error('email')
    <span style="color: red">{{ $message }}</span>
@enderror