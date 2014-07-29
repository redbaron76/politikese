<ul class="nav nav-pills menu">
	<li class="{{ (Request::is('espressioni*') ? 'active' : '') }}"><a href="{{ route('espressioni.index') }}">Espressioni</a></li>
	<li class="{{ (Request::is('verbi*') ? 'active' : '') }}"><a href="{{ route('verbi.index') }}">Verbi</a></li>
	<li class="{{ (Request::is('avverbi*') ? 'active' : '') }}"><a href="{{ route('avverbi.index') }}">Avverbi</a></li>
	<li class="{{ (Request::is('tag*') ? 'active' : '') }}"><a href="{{ route('tags.index') }}">Tags</a></li>
</ul>