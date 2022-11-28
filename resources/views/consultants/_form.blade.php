<div class="form-group">
    <label>First Name</label>
    <input type="text" name="first_name" class="form-control"
        value="{{ old('first_name', $consultant->first_name ?? null) }}"/>
</div>
@error('first_name')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control"
        value="{{ old('last_name', $consultant->last_name ?? null) }}"/>
</div>
@error('last_name')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control"
        value="{{ old('phone', $consultant->phone ?? null) }}"/>
</div>
@error('phone')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control"
        value="{{ old('email', $consultant->email ?? null) }}"/>
</div>
@error('email')
    <span style="color: red">{{ $message }}</span>
@enderror