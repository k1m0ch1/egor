<label for="name">Name</label><br/>
<input type="text" name="name" id="name" value="{{ $name }}" class="text ui-widget-content ui-corner-all"><br/>
<label for="href">Email</label><br/>
<input type="text" name="href" id="email" value="{{ $email }}" class="text ui-widget-content ui-corner-all"><br/>
<label for="image">Password</label>
<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all"><br/>
kosongkan jika tidak akan diubah
<br/>
<input type='hidden' id='idnyah' value='{{ $idnyah }}' />
<br/>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">