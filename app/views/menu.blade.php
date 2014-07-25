<ul class="nav nav-pills menu">
	<li class="{{ (Request::is('espressioni*') ? 'active' : '') }}"><a href="{{ route('espressioni.index') }}">Espressioni</a></li>
	<li class="{{ (Request::is('verbi*') ? 'active' : '') }}"><a href="#">Verbi</a></li>
	<li class="{{ (Request::is('avverbi*') ? 'active' : '') }}"><a href="#">Avverbi</a></li>
	<li class="{{ (Request::is('tags*') ? 'active' : '') }}"><a href="#">Tags</a></li>
</ul>